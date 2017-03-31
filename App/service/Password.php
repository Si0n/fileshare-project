<?php

namespace App\Service;

class Password {
	/**
	 * @param $encrypted_password
	 * @param $password
	 * @return bool
	 */
	static public function isValid($password, $encrypted_password) {
		return password_verify($password, $encrypted_password);
	}

	/**
	 * @param $password
	 * @return bool|string
	 */
	static public function encryptPassword($password) {
		return password_hash($password, PASSWORD_DEFAULT);
	}

	static public function generatePassword(int $length = 6): string {
		$string = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$string_length = strlen($string);
		$password = '';
		for ($i = 0; $i < $length; $i++) {
			$password .= $string[mt_rand(0, $string_length - 1)];
		}
		return $password;
	}
}