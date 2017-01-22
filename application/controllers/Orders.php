<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('ion_auth');
		$this->load->library('cart');
		$this->load->library('session');
		$this->load->helper('form');
	}

	public function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}
		
		$data["logged_in"] = $this->ion_auth->logged_in();

		$this->load->view('templates/header');
		$this->load->view('templates/nav', $data);
		$this->load->view('orders', $data);
		$this->load->view('templates/shopping-cart', $data);
		$this->load->view('templates/footer');
	}

}