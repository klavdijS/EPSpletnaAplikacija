<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {
	
	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
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

}