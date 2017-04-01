<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
	protected $table = 'user';
	protected $primaryKey = 'user_id';
	protected $fillable = ['*'];

	public function validateUserName(string $name) : bool {
		$length = mb_strlen($name);
		return $length > 3 && $length < 75;
	}
	public function validateUserEmail(string $email) : bool {
		$length = mb_strlen($email);
		return $length > 3 && $length < 75 && filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	public function validateUserPassword(string $password) : bool {
		$length = mb_strlen($password);
		return $length > 3 && $length < 20;
	}

}