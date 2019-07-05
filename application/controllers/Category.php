<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Category extends CI_Controller {

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
		$this->API="http://demo.var-x.id/api/category";
		if ((!$this->session->has_userdata('name')) && (!$this->session->has_userdata('token'))) {
			return redirect('welcome/login','refresh');
		}
	}

	private function validation(){
		$this->form_validation->set_rules('name','name','required');
		if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('alert', 'Fill the blank space');
				return true;
		}else{
			return false;
		}
	}
	
	public function index()
	{
		$data['satus'] = "0";
		$data['data'] = "";
		try {
			$client = new Client();
			$token  =  $this->session->userdata('token');
			$response = $client->request('GET',$this->API.'/get',
			[
				'headers' => [
					'Accept'     => 'application/json',
					'Authorization' => 'Bearer '.$token, 
					'Content-Type' => 'application/json'
					]
			]);
			$result =  json_decode($response->getBody(),true);
			$data['satus'] = "200";
			$data['result'] = $result['data'];
		} catch (GuzzleHttp\Exception\BadResponseException $e) {
			$this->session->set_flashdata('alert', 'failed');
		}
		$this->template->load('back/layout','back/page/category/index',$data); 
	}
	public function add(){
		if (isset($_POST['submit'])) {
			try {
				if ($this->validation()) {
					redirect('category/add');
				}
				$client = new Client();

				$token  =  $this->session->userdata('token');

				$response = $client->request('POST',$this->API,
				[
					'query'	  => [
						'name' => $this->input->post('name'),
					],
					'headers' => [
						'Accept'     => 'application/json',
						'Authorization' => 'Bearer '.$token, 
						'Content-Type' => 'application/json',
						]
				]);
					echo "asd";

				if ($response->getStatusCode()=="200") {

					$this->session->set_flashdata('succes', 'data has been added');
					return redirect('category/index');
				}else{
					$this->session->set_flashdata('succes', 'data has been added');
				}

				
			} catch (GuzzleHttp\Exception\BadResponseException $e) {
				$this->session->set_flashdata('alert', 'failed');
			}
			return redirect('category/add');
		}else{
			$this->template->load('back/layout','back/page/category/input'); 
		}
	}
	public function show($id,$name){
	
			if ($id=="" && $name=="") {
				redirect('category/index','refresh');
			}
			$data['name'] = $name;
			$data['id'] = $id;
			$this->template->load('back/layout','back/page/category/show',$data); 
	
	}
	public function update(){
		if (isset($_POST['submit'])) {
			try {
				if ($this->validation()) {
					redirect('category/add');
				}
				$client = new Client();
				$token  =  $this->session->userdata('token');
				$response = $client->request('PUT',$this->API.'/'.$this->input->post('id'),
				[
					'query'	  => [
						'name' => $this->input->post('name'),
					],
					'headers' => [
						'Accept'     => 'application/json',
						'Authorization' => 'Bearer '.$token, 
						'Content-Type' => 'application/json'
						]
				]);
				if ($response->getStatusCode()=="200") {
					$this->session->set_flashdata('succes', 'data has been added');
					return redirect('category/index');
				}else{
					$this->session->set_flashdata('succes', 'data has been added');
				}
				
			} catch (GuzzleHttp\Exception\BadResponseException $e) {
				$this->session->set_flashdata('alert', 'failed');
			}
			return redirect('category/add');
		}
	}
	public function delete($id){
		try {
			$client = new Client();
			$token  =  $this->session->userdata('token');
			$response = $client->request('DELETE',$this->API.'/'.$id,
			[
				'headers' => [
					'Accept'     => 'application/json',
					'Authorization' => 'Bearer '.$token, 
					'Content-Type' => 'application/json'
					]
			]);
			if ($response->getStatusCode()=='200') {
				$this->session->set_flashdata('succes', 'data has been removed');
			}
		} catch (GuzzleHttp\Exception\BadResponseException $e) {
			$this->session->set_flashdata('alert', 'failed');
		}
		return redirect('category/index');

	}
	
}
