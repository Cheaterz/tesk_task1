<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel //extends Model
{
	private $file = null;
	private $json_data = null;

	public function dbExists() {
		try {
			$this->file = new \CodeIgniter\Files\File(APPPATH . 'Models\\userdata.json', true);
		} catch(\CodeIgniter\Files\Exceptions\FileNotFoundException $e) {
			return false;
		}

		return true;
	}

	public function readData() {
		$user_data = file_get_contents($this->file->getPathname());
		$this->json_data = json_decode($user_data);

		return true;
	}

	public function userBlocked() {
		if($this->json_data->failed_logins >= 3) {
			if (time() - $this->json_data->last_login_try < 5 * 60) {
				return true;
			}
		}

		return false;
	}

	public function getLoginTime() {
		return 5*60 - (time() - $this->json_data->last_login_try);
	}

	public function userAuthenticated($username, $password) {
		return ($username == $this->json_data->username) && ($password == $this->json_data->password);
	}

	public function resetFields() {
		$this->json_data->failed_logins = 0;
		$this->json_data->last_login_try = 0;
	}

	public function incLoginAttempts() {
		$this->json_data->failed_logins += 1;
		$this->json_data->last_login_try = time();
	}

	public function saveData() {
		file_put_contents($this->file->getPathname(), json_encode($this->json_data));
	}
}