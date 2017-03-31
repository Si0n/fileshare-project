<?php

namespace App\Service;

class Directory {
	private $path;
	private $root;
	private $full_path;

	/**
	 * Directory constructor.
	 * @param string $root
	 * @method define root, getting path
	 */
	public function __construct(string $root) {
		$this->root = $root;
		$this->path = $this->getFileDir();
	}

	public function setPath(string $path) {
		$this->path = $path;
		return $this;
	}

	/**
	 * @return string
	 * @method: returns any rule of path building
	 */
	private function getFileDir() {
		return date('Y-m-d');
	}

	public function getPath($part = null) {
		if (empty($part))
			return $this->path;
		else
			return "{$this->path}/{$part}";
	}

	public function setRoot(string $root) {
		$this->root = $root;
		return $this;
	}

	public function getFullPath($directory) {
		return "{$this->full_path}/{$directory}";
	}

	/**
	 * @param $path string|array
	 * @return $this
	 */
	public function makeDirs($path) {
		if (is_string($path)) {
			$path = explode("/", $path);
		}
		if (!is_array($path)) {
			Throw new Exception("Wrong type of \"path\" value");
		}
		$this->full_path = $this->root;
		foreach ($path as $dir) {
			$this->full_path .= "{$dir}/";
			if (!is_dir($this->full_path)) {
				$result = mkdir($this->full_path, 0755); //not recursively mkdir coz want to give exact rights on each dir
				if (!$result) {
					Throw new Exception("Something went wrong with creating dir: {$dir} in path: {$this->full_path}");
				}
			}
		}
		return $this;
	}

}