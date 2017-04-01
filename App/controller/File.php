<?php

namespace App\Controller;

use App\Service\Password;
use Slim\Http\Request;
use Slim\Http\Response;

class File extends Controller {
	public function __invoke(Request $request, Response $response, $args) {
		$x = 0;
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param $args
	 * @return static
	 * @method: can be used to upload not only a single file but also a few files
	 */
	public function upload(Request $request, Response $response, $args) {
		$upload = $this->container->get('upload');
		$document = $this->container->get('document');
		$files = $upload->files($request);
		if (empty($files)) {
			return $response->withStatus(302)->withHeader('Location', '/');
		}
		$document->setAsset(["href" => "/js/app.js", "attributes" => ["async" => true]], "script");
		$document->setAsset(["href" => "/css/files.css", "rel" => "stylesheet"], "style");
		$document->setAsset("Files edit page", "title");
		$document->setAsset(["name" => "description", "content" => "You just downloaded files, some files. Here you can edit their settings "], "meta");
		$files_info = [];
		foreach ($files as $file_data) {
			$files_info[$file_data['file']->file_id] = [
				'filename' => $file_data['file']->filename_original,
				'password' => $file_data['password'],
				'size' => $file_data['file']->size];
		}
		$document->setVariable($files_info, "files");
		$document->setTemplate("file.twig");
		$document->render($response);
	}

	public function list(Request $request, Response $response, $args) {

	}

	public function item(Request $request, Response $response, $args) {
		$document = $this->container->get('document');
		$directory = $this->container->get('directory');

		$file_id = (int)($args['file_id'] ?? null);
		$file = \App\Model\File::find($file_id);
		if (empty($file)) {
			return $document->errorNotFound($response);
		}
		$password = $request->getParsedBodyParam("password");
		if (!empty($password)) {
			if (!Password::isValid($password, $file->password)) {
				$document->setVariable(["action" => $request->getUri()->getPath(), "method" => "POST", "state" => "error", "state_code" => "Wrong password!"], "form");
			} else {
				$file_name = $directory->getPathRoot($file->filename);
				if (is_file($file_name)) {
					return $this->returnFile($response, $file_name, $file->filename_original);
				} else {
					return $document->errorNotFound($response); //Will change in future (file lost case)
				}
			}
		} else {
			$document->setVariable(["action" => $request->getUri()->getPath(), "method" => "POST"], "form");
		}
		$document->setAsset(["href" => "/js/app.js", "attributes" => ["async" => true]], "script");
		$document->setAsset(["href" => "/css/file.css"], "style");
		$document->setAsset("File inspect page", "title");
		$document->setAsset(["name" => "description", "content" => "Here you can inspect the file #{$args['file_id']}"], "meta");
		$document->setTemplate("file.twig");
		$document->render($response);
	}
	public function returnFile(Response $response, $file, $filename = null) {
		$filename = $filename ?? $file;
		$response = $response->withHeader('Content-Description', 'File Transfer')
			->withHeader('Content-Type', 'application/octet-stream')
			->withHeader('Content-Disposition', 'attachment;filename="'.basename($filename).'"')
			->withHeader('Expires', '0')
			->withHeader('Cache-Control', 'must-revalidate')
			->withHeader('Pragma', 'public')
			->withHeader('Content-Length', filesize($file));
		readfile($file);
		return $response;
	}
}