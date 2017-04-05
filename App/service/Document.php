<?php

namespace App\Service;

use Slim\Http\Response;
use Slim\Views\Twig;

class Document {
	private $view;
	private $template;

	private $variable = [];
	private $style = [];
	private $script = [];
	private $meta = [];
	private $link = [];
	private $keyword = [];
	private $title = '';
	private $description = '';
	public function __construct($view) {
		$this->view = $view;
	}
	const DOCUMENT_ASSETS_TYPES = ['style', 'script', 'meta', 'link',  'keyword', 'title', 'description', 'variable'];
	/**
	 * @param $asset array|string
	 * @param string $type
	 * @throws \Exception
	 */
	public function setAsset($asset, string $type) {
		$type = strtolower($type);
		if (!in_array($type, self::DOCUMENT_ASSETS_TYPES)) {
			throw new \Exception("Wrong Asset Type given: {$type}");
		}
		if (is_array($asset)) {
			$must_exist_one_of_property = ['src', 'href', 'name', 'property'];
			$key = false;
			foreach ($must_exist_one_of_property as $property) {
				if (!empty($asset[$property])) {
					$key = $asset[$property];
				}
			}
			if ($key === FALSE) {
				throw new \Exception("Given none of defined properties : " . implode(", ", $defined_properties));
			}
			$this->{$type}[md5($key)] = $asset;
		} elseif (is_string($asset) && in_array($type, ['title', 'description'])) {
			$this->{$type} = $asset;
		}

	}

	/**
	 * @param $types
	 * @return \Generator
	 */
	public function getAssets($types) : \Generator {
		foreach ($types as $type) {
			yield $type => $this->{$type};
		}
	}

	public function setTemplate(string $template) {
		$this->template = $template;
	}
	public function setKeyword(string $keyword) {
		$this->keyword[] = $keyword;
		$this->keyword = array_unique($this->keyword);
	}
	public function setKeywords(array $keywords) {
		$this->keyword = array_unique(array_merge($this->keyword, $keywords));
	}
	public function getDocumentProperties():array {
		$properties = [];
		foreach ($this->getAssets(self::DOCUMENT_ASSETS_TYPES) as $type => $asset) {
			$properties[$type] = $asset;
		}
		return $properties;
	}
	public function setVariables(array $variables) {
		$this->variable = array_merge($this->variable, $variables);
	}
	public function setVariable($variable, $type) {
		$this->variable[$type] = $variable;
	}
	public function render($variables = [], $template = null) {
		if (!empty($template)) {
			$this->setTemplate($template);
		}
		if (empty($this->template)) {
			throw new \Exception("Template not defined!");
		}
		return $this->view->render($this->template, array_merge($this->getDocumentProperties(), $variables));
	}
	public function errorNotFound(Response $response) {
		return $response
			->withStatus(404)
			->withHeader('Content-Type', 'text/html')
			->write('Page not found');
	}
}