<?php

namespace App\Local;

final class File {
	const FILE_STATUS_UPLOADED = 0;
	const FILE_STATUS_APPROVED = 1;
	const FILE_STATUS_DISABLED = 2;

	private $file_id;
	private $path;
	private $original;
	private $filename;
	private $user_id;
	private $description;
	private $created_at;
	private $updated_at;
	private $status;
	private $password;
	private $original_password;

	/*setters*/
	public function setFileId(int $file_id) {
		$this->file_id = $file_id;
	}

	public function setDescription(string $description) {
		$this->description = $description;
	}

	public function setLocalPath(string $path) {
		$this->path = $path;
		return $this;
	}

	public function setOriginalName(string $original) {
		$this->original = $original;
		$this->filename = $this->generateFileName();
		return $this;
	}

	public function setOwner(int $user_id) {
		$this->user_id = $user_id;
	}



	public function setStatus(int $status) {
		$this->status = $status;
	}

	public function setUserId(int $user_id) {
		$this->user_id = $user_id;
	}

	public function setPassword(string $password) {
		$this->password = $password;
	}

	public function setOriginalPassword(string $original_password) {
		$this->original_password = $original_password;
	}

	/*getters*/
	public function getProperties($properties) {
		foreach ($properties as $property) {
			if (property_exists($this, $property) && !is_null($this->{$property})) {
				yield $property => $this->{$property};
			}
		}
	}

	public function getPath() {
		return $this->path;
	}

	public function getOriginal() {
		return $this->original;
	}

	public function getFilename() {
		return $this->filename;
	}
	public function getDescription() : string {
		return $this->description ?? '';
	}

	public function getOwner() {
		return $this->user_id;
	}

	public function getCreatedAt() {
		return $this->created_at;
	}

	public function getUpdatedAt() {
		return $this->updated_at;
	}

	public function getStatus() {
		return $this->status ?? 0;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getFileId() {
		return $this->file_id;
	}

	public function getUserId() {
		return $this->user_id;
	}

	/*utils*/
	private function generateFileName() {
		$file_info = pathinfo($this->original);
		$file_name = md5($this->original . md5(date('Y-m-d H:i:s')));
		return "{$file_name}.{$file_info['extension']}";
	}

}