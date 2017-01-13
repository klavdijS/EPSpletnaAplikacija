<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('url');		
	}

	public function view( $productId ) {
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('product');
		$this->load->view('templates/shopping-cart');
		$this->load->view('templates/footer');
	}

}