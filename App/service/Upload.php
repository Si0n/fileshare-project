<?php

namespace App\Service;

use App\Model\File;
use Slim\Container;
use Slim\Http\UploadedFile;

class Upload {
	protected $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	/**
	 * @param $request
	 * @return array of file objects
	 */
	public function files($request) {
		$uploaded_files = [];

		$files = $request->getUploadedFiles();
		if (!empty($files['file'])) {
			foreach ($files['file'] as $file) {
				$uploaded_files[] = $this->file($file);
			}
		}

		return $uploaded_files;
	}

	private function file(UploadedFile $file):array {
		if ($file->getError() === UPLOAD_ERR_OK) {
			$directory = $this->container->get('directory');
			$directory->makeDirs($directory->getPath());


			$generated_filename = $this->generateFileName($file->getClientFilename());

			$file_model = new File();
			$file_model->filename_original = $file->getClientFilename();
			$file_model->filename = $directory->getPath($generated_filename);
			$file_model->status = File::FILE_STATUS_UPLOADED;
			$file_model->size = $file->getSize();

			$file->moveTo($directory->getFullPath($generated_filename));
			/*security*/
			$password = Password::generatePassword(6);
			$encrypted_password = Password::encryptPassword($password);
			$file_model->password = $encrypted_password;
			$file_model->save();
			return ['file' => $file_model, 'password' => $password];
		} else {
			Throw new Exception("Error while uploading File: {$file->getClientFilename()}, Error: {$file->getError()}");
		}

	}
	public function generateFileName(string $original_filename):string {
		$filename_parts = [];
		$filename_parts[] = md5($original_filename . md5(date('Y-m-d H:i:s')));
		$file_info = pathinfo($original_filename);
		if (!empty($file_info['extension'])) {
			$filename_parts[] = $file_info['extension'];
		}

		return implode(".", $filename_parts);
	}
}