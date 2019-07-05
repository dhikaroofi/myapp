<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Product extends CI_Controller {

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
		$this->API="http://demo.var-x.id/api/product";
		if ((!$this->session->has_userdata('name')) && (!$this->session->has_userdata('token'))) {
			return redirect('welcome/login','refresh');
		}
	}

	private function validation(){
		$this->form_validation->set_rules('name','name','required');
		$this->form_validation->set_rules('brand','brand','required');
		$this->form_validation->set_rules('price','price','required');
		$this->form_validation->set_rules('category_id','category_id','required');
		$this->form_validation->set_rules('quantity','quantity','required');
		$this->form_validation->set_rules('quantity_unit','quantity_unit','required');
		$this->form_validation->set_rules('purchase_date','purchase_date','required');
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
		$this->template->load('back/layout','back/page/product/index',$data); 
	}
	public function add(){
		if (isset($_POST['submit'])) {
			try {
				if ($this->validation()) {
					redirect('product/add');
				}
				$client = new Client();
				$token  =  $this->session->userdata('token');
				$response = $client->request('POST',$this->API,
				[
					'query'	  => [
						'name' => $this->input->post('name'),
						'brand' => $this->input->post('brand'),
						'price' => $this->input->post('price'),
						'category_id' => $this->input->post('category_id'),
						'quantity' => $this->input->post('quantity'),
						'quantity_unit' => $this->input->post('quantity_unit'),
						'purchase_date' => $this->input->post('purchase_date'),
					],
					'headers' => [
						'Accept'     => 'application/json',
						'Authorization' => 'Bearer '.$token, 
						'Content-Type' => 'application/json',
						]
				]);
				if ($response->getStatusCode()=="200") {
					$this->session->set_flashdata('succes', 'data has been added');
					return redirect('product/index');
				}else{
					$this->session->set_flashdata('succes', 'data has been added');
				}

				
			} catch (GuzzleHttp\Exception\BadResponseException $e) {
				$this->session->set_flashdata('alert', 'failed');
			}
			return redirect('product/add');
		}else{
				$client = new Client();
				$token  =  $this->session->userdata('token');
				$response = $client->request('GET','http://demo.var-x.id/api/category'.'/get',
				[
					'headers' => [
						'Accept'     => 'application/json',
						'Authorization' => 'Bearer '.$token, 
						'Content-Type' => 'application/json',
						]
				]);
				$result = json_decode($response->getBody(),true);
				$data['result'] = $result['data'];
			$this->template->load('back/layout','back/page/product/input',$data); 
		}
	}
	public function show(){
			if (!isset($_POST['submit'])) {
				return redirect('product/index');
			}
				$client = new Client();
				$token  =  $this->session->userdata('token');
				$response = $client->request('GET','http://demo.var-x.id/api/category'.'/get',
				[
					'headers' => [
						'Accept'     => 'application/json',
						'Authorization' => 'Bearer '.$token, 
						'Content-Type' => 'application/json',
						]
				]);
				$result = json_decode($response->getBody(),true);
				$data['result'] = $result['data'];
			$data['id'] = $this->input->post('id');
			$data['name'] = $this->input->post('name');
			$data['brand'] = $this->input->post('brand');
			$data['price'] = $this->input->post('price');
			$data['category_id'] = $this->input->post('category_id');
			$data['quantity'] = $this->input->post('quantity');
			$data['quantity_unit'] = $this->input->post('quantity_unit');
			$data['purchase_date'] = $this->input->post('purchase_date');
			$this->template->load('back/layout','back/page/product/show',$data); 
	}
	public function update(){
		if (isset($_POST['submit'])) {
			try {
				if ($this->validation()) {
					redirect('product/index');
				}
				$client = new Client();
				$token  =  $this->session->userdata('token');
				echo $this->API.'/'.$this->input->post('id');
				$response = $client->request('PUT',$this->API.'/'.$this->input->post('id'),
				[
					'query'	  => [
						'name' => $this->input->post('name'),
						'brand' => $this->input->post('brand'),
						'price' => $this->input->post('price'),
						'category_id' => $this->input->post('category_id'),
						'quantity' => $this->input->post('quantity'),
						'quantity_unit' => $this->input->post('quantity_unit'),
						'purchase_date' => $this->input->post('purchase_date'),
					],
					'headers' => [
						'Accept'     => 'application/json',
						'Authorization' => 'Bearer '.$token, 
						'Content-Type' => 'application/json'
					],
				]);
				print_r($response);
				if ($response->getStatusCode()=="200") {
					$this->session->set_flashdata('succes', 'data has been updated');
					return redirect('product/index');
				}else{
					$this->session->set_flashdata('failed', 'failed to update');
				}
			} catch (GuzzleHttp\Exception\BadResponseException $e) {
				$this->session->set_flashdata('alert', 'failed');
			}
			return redirect('product/');
		}
	}
	public function delete($id){
		try {
			$client = new Client();
			$token  =  $this->session->userdata('token');
			echo $this->API.'/'.$id;
			$response = $client->request('DELETE',$this->API.'/'.$id,
			[
				'headers' => [
					'Authorization' => 'Bearer '.$token, 
					]
			]);

			if ($response->getStatusCode()=='200') {
				$this->session->set_flashdata('succes', 'data has been removed');
			}else{
				$this->session->set_flashdata('alert', 'failed to delet data');
			}
		} catch (GuzzleHttp\Exception\BadResponseException $e) {
			$this->session->set_flashdata('alert', 'failed');
		}
		return redirect('product/index');

	}
	
}
