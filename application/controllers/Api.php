<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {
	
	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function index_get() {
		redirect('home', 'refresh');
	}

	public function product_get() {
		// Če ni naveden ID, javi napako.
		if(!$this->get('id')) {
			$this->response(NULL, 400);
		}

		$product = $this->Shop_model->get_products( $this->get('id') );

		// Sporoči, če produkt z navedenim ID-jem obstaja ali ne.
		if ($product) {
			$this->response($product, 200);
		} else {
			$this->response(NULL, 404);
		}
	}

	public function products_get() {
		$products = $this->Shop_model->get_products();

		if ($products) {
			$this->response($products, 200);
		} else {
			$this->response(NULL, 404);
		}
	}

	public function login_post() {
		if ($this->ion_auth->login($this->post('username'), $this->post('password'))) {
			$this->response(array('status' => 'success'));
		} else {
			$this->response(array('status' => 'failed'));
		}
	}

	public function register_post() {
		$identity = $this->post('username');
		$password = $this->post('password');
		$email = $this->post('email');
		$additional_data = array(
			'first_name' 	=> $this->post('first_name'),
			'last_name'  	=> $this->post('last_name'),
			'street'		=> $this->post('street'),
			'street_number'	=> $this->post('street_number'),
			'city'			=> $this->post('city'),
			'postcode'		=> $this->post('postcode'),
			'country'		=> $this->post('country'),
			'phone'      	=> $this->post('phone'),
		);
		if ($this->ion_auth->register($identity, $password, $email, $additional_data)) {
			$this->response(array('status' => 'success'));
		} else {
			$this->response(array('status' => 'failed'));
		}
	}

}