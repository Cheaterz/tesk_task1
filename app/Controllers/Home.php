<?php namespace App\Controllers;

class Home extends BaseController
{
	protected $validation;

	public function __construct() {
		helper('form', 'validation');
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		return $this->login_page();
	}

	public function login() {
		$userModel = model('App\Models\UserModel');

		if(!$userModel->dbExists()) {
			return $this->response->setStatusCode(500)
               ->setBody('<h1>Maintenance mode, server-side error. Try again later</h1>');
		}


		$this->validation->setRule('username', 'Логин', 'required|alpha_dash|min_length[3]|max_length[20]');
		$this->validation->setRule('password', 'Пароль', 'required|alpha_dash|min_length[6]|max_length[20]');

		if (!$this->validation->withRequest($this->request)->run()) {
			return $this->login_page();
		}

		$userModel->readData();
		
		if($userModel->userBlocked()) {
			return $this->login_page(['extra' => sprintf("Попробуйте еще раз через %d секунд", $userModel->getLoginTime())]);
		}

		if(!$userModel->userAuthenticated($this->request->getPost('username'), $this->request->getPost('password'))) {
			return $this->creds_incorrect($userModel);
		}

		$this->loginUser($userModel);
		
		return redirect()->to('/user/cabinet');
	}

	protected function login_page($data = []) {
		helper('html');
		$defaults = ['validation' => $this->validation];
		$params = array_merge($data, $defaults);
		return view('home/login', $params);
	}


	protected function creds_incorrect($model) {
		$model->incLoginAttempts();
		$model->saveData();

		return $this->login_page(['creds_error' => true]);
	}

	protected function loginUser($model) {
		$model->resetFields();
		$model->saveData();

		$session = \Config\Services::session();
		$session->set('username', $this->request->getPost('username'));
	}
}
