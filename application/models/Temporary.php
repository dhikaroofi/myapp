<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temporary extends CI_Model{

	private $_table = "temporary";

    public $id;
    public $name;
	public $product_id;
	public $quantity;
    public $quantity_unit;
	public $price;
	public $user;
    public $date;
		
	function __construct()
    {
        parent::__construct();
	}
	

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
			'rules' => 'required'],

			['field' => 'product_id',
            'label' => 'product_id',
			'rules' => 'required'],
			
			['field' => 'quantity',
            'label' => 'Quantity',
			'rules' => 'required|numeric'],

			['field' => 'quantity_unit',
            'label' => 'Quantity Unit',
			'rules' => 'required'],
			
			['field' => 'price',
            'label' => 'price',
			'rules' => 'required|numeric'],
			
	
			
        ];
	}
	
    public function getAll(){
		$email = $this->session->userdata('email');
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->where('user',$email);
		$query = $this->db->get();
        return $query->result_array();
	}

	public function insert(){
		$email	= $this->session->userdata('email');
		$post 	= $this->input->post();
        $this->name 			= $post['name'];
		$this->product_id 		= $post['product_id'];
		$this->quantity 		= $post['quantity'];
    	$this->quantity_unit 	= $post['quantity_unit'];
		$this->price 	=  $post['price'];
		$this->user 	= $email;
    	$this->date 	= date('Y-m-d H:i:s');
        $this->db->insert($this->_table, $this);
	}

	public function empty()
    {
		$email = $this->session->userdata('email');
        return $this->db->delete($this->_table, array("user" => $email));
	}
	
	public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}
?>
