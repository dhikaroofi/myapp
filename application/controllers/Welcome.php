<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	private $API ="";
	
	function __construct() {
        parent::__construct();
		$this->API="http://demo.var-x.id/api/auth/";
		if (($this->session->has_userdata('email')) && ($this->session->has_userdata('token'))) {
			return redirect('Dashboard/index','refresh');
		}
    }
	public function index()
	{
		$data['breadcrumb'] = "
			<li class='breadcrumb-item active' >
			<a href='#'>Dashboard</a>
			</li>
			";
		$this->template->load('front/layout','front/page/register',$data); 
	}

	public function login()
	{
		$data['breadcrumb'] = "
			<li class='breadcrumb-item active' >
			<a href='#'>Login</a>
			</li>
			";
		$this->template->load('front/layout','front/page/login',$data); 
	}

	public function loginact()
	{
		
		if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])){
			try {
				$this->form_validation->set_rules('email','email','required|valid_email');
				$this->form_validation->set_rules('password','password','required|min_length[8]');
				if ($this->form_validation->run() == FALSE){
					$this->session->set_flashdata('alert', 'Sorry your email or password might be wrong');
				}

				$client = new Client();
				$response = $client->request('POST','http://demo.var-x.id/api/auth/login',
				[
					'query' =>  [
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),
					],
				]);
				
				if ($response->getStatusCode()=="200") {
					$result = json_decode($response->getBody(),true);
					$this->session->set_userdata('email',  $result['data']['email']);
					$this->session->set_userdata('token', $result['token']);
					return redirect('/dashboard');
					
				}
			} catch (GuzzleHttp\Exception\BadResponseException $e) {
				$this->session->set_flashdata('alert', 'Sorry your email or password might be wrong');
			}
        }
		return redirect('/welcome/login');

	}

	public function registerAct(){
		if(isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['cpassword'])){
			
			try {

				$this->form_validation->set_rules('name','name','required');
				$this->form_validation->set_rules('email','email','required|valid_email');
				$this->form_validation->set_rules('password','password','required|min_length[8]');
				$this->form_validation->set_rules('cpassword','cpassword','required|min_length[8]');

				if ($this->form_validation->run() == FALSE){
					$this->session->set_flashdata('alert', 'Sorry you need to fill the form');
				}
				if ($this->input->post('password')!=$this->input->post('password')) {

					$this->session->set_flashdata('alert', 'Sorry your password and confirmation password not match');
				}

				$client = new Client();
				$response = $client->request('POST','http://demo.var-x.id/api/auth/register',
				[
					'query' =>  [
						'name' => $this->input->post('email'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),
						'password_confirmation' => $this->input->post('cpassword'),
					],
				]);

				echo $response->getStatusCode()."asd";
				if ($response->getStatusCode()=="200") {
					$result = json_decode($response->getBody(),true);
					$this->session->set_userdata('email',  $result['data']['email']);
					$this->session->set_userdata('token', $result['token']);
					return redirect('/dashboard');
				}else{
					$this->session->set_flashdata('alert', 'Sorry your email or password might be wrong');
				}

			} catch (GuzzleHttp\Exception\BadResponseException $e) {
				$this->session->set_flashdata('alert', 'Sorry your email or password might be wrong');
			}
		}
		return redirect('/welcome/index');
	}


}
