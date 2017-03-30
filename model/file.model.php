<?php

namespace App\Model;
use App\Local\File as FileController;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $table = 'file';
	protected $primaryKey = 'file_id';
	protected $fillable = ['*'];
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	/**
	 * @param FileController $file
	 */
	public function setFile(FileController $file) {
		$this->user_id = $file->getUserId();
		$this->filename = $file->getFilename();
		$this->filename_original = $file->getOriginal();
		$this->description = $file->getDescription();
		$this->path = $file->getPath();
		$this->status = $file->getStatus();
		$this->password = $file->getPassword();
	}
}