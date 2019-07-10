<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller {

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
	
	function __construct() {
		parent::__construct();
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		if ((!$this->session->has_userdata('name')) && (!$this->session->has_userdata('token'))) {
			return redirect('welcome/login','refresh');
		}

	}
	public function index(){
			$data['breadcrumb'] = "
			<li class='breadcrumb-item active' >
			<a href='#'>Dashboard</a>
			</li>
			";
		$this->template->load('back/layout','back/page/dashboard',$data); 
	}
	public function signoutact(){
			session_destroy();
			return redirect('welcome/login','refresh');
	}


}
