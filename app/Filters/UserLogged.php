<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserLogged implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();

        $user_logged = $session->get('username') !== null;

        if($request->uri->getSegment(1) == 'home') {
        	if($user_logged) {
        		return redirect()->to('/user');
        	}
        }

        if($request->uri->getSegment(1) == 'user') {
        	if(!$user_logged) {
        		return redirect()->to('/home');
        	}
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}