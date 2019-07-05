<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Report extends CI_Controller {

	private $API ="";
	
	function __construct() {
        parent::__construct();
		$this->API="http://demo.var-x.id/api/product";
		if ((!$this->session->has_userdata('name')) && (!$this->session->has_userdata('token'))) {
			return redirect('welcome/login','refresh');
		}
	}

	
	public function index()
	{
		$data['satus'] = "0";
		$data['data'] = "";
		try {
			$client = new Client();
			$token  =  $this->session->userdata('token');
			$response = $client->request('GET','http://demo.var-x.id/api/transaction/get',
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
		$this->template->load('back/layout','back/page/report/index',$data); 
	}
	
}
