<?php

namespace App\Controllers;

class User extends BaseController
{
	protected $session;

	public function __construct() {
		$this->session = \Config\Services::session();

		helper('html');
	}

	public function index()
	{
		return redirect()->to('/user/cabinet');
	}

	public function cabinet() {
		return view('user/cabinet', ['username' => $this->session->get('username')]);
	}

	public function logout() {
		$this->session->destroy();
		return redirect()->to('/home');
	}
}
