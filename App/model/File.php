<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class File extends Model {
	const FILE_STATUS_UPLOADED = 0;
	const FILE_STATUS_APPROVED = 1;
	const FILE_STATUS_DISABLED = 2;
	protected $table = 'file';
	protected $primaryKey = 'file_id';
	protected $fillable = ['*'];


}