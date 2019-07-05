<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;

class Transc extends CI_Controller {

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
		$this->load->model('Temporary');
		$this->API="http://demo.var-x.id/api/auth/";
		if ((!$this->session->has_userdata('name')) && (!$this->session->has_userdata('token'))) {
			return redirect('welcome/login','refresh');
		}
	}
	
	public function index()
	{
		$tmp = $this->Temporary;
		$data['tmp'] = $tmp->getAll();
		$data['product'] = array();
		try {
			$client = new Client();
			$token  =  $this->session->userdata('token');
			$response = $client->request('GET','http://demo.var-x.id/api/product/get',
			[
				'headers' => [
					'Accept'     => 'application/json',
					'Authorization' => 'Bearer '.$token, 
					'Content-Type' => 'application/json'
					]
			]);
			$result =  json_decode($response->getBody(),true);
			$data['satus'] = "200";
			$data['product'] = $result['data'];
		} catch (GuzzleHttp\Exception\BadResponseException $e) {
			$this->session->set_flashdata('alert', 'failed');
		}
		$this->template->load('back/layout','back/page/transaction/index',$data); 
	}

	public function add(){
		$temporary = $this->Temporary;
        $validation = $this->form_validation;
        $validation->set_rules($temporary->rules());

        if ($validation->run()) {
            $temporary->insert();
            $this->session->set_flashdata('success', 'Success');
		}else{
            $this->session->set_flashdata('alert', 'Failed');
		}
		return redirect('transc/index');
	}

	public function submit(){
		$tmp = $this->Temporary;
		$data['tmp'] = $tmp->getAll();
		$sum = 0;
		foreach ($data['tmp'] as $data1) {
			$sum += ($data1['quantity']*$data1['price']);
		}
		
			try {
				if ($this->input->post('cash')<$sum) {
					$this->session->set_flashdata('alert', 'Kurang bayar coy');
					return redirect('transc');
				}
				$ins = array(
					'transaction' => array(
						'customer_name' => $this->input->post('name'),
					),
					'transaction_products' => $data['tmp'],
				);

				$client = new Client();
				$token  =  $this->session->userdata('token');
				$response = $client->request('POST','http://demo.var-x.id/api/transaction',
				[
					'query'	  => $ins,
					'headers' => [
						'Accept'     => 'application/json',
						'Authorization' => 'Bearer '.$token, 
						'Content-Type' => 'application/json',
						]
				]);

				if ($response->getStatusCode()=="200") {
					$this->session->set_flashdata('succes', 'data has been added');
					$tmp->empty();
					return redirect('transc/index');
				}else{
					$this->session->set_flashdata('alert', ' Failed');
				}
					return redirect('transc/index');

				
			} catch (GuzzleHttp\Exception\BadResponseException $e) {
				$this->session->set_flashdata('alert', 'failed');
			}
			return redirect('transc/index');

	}

	public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Temporary->delete($id)) {
            redirect(site_url('transc/index'));
        }
    }

	
}
