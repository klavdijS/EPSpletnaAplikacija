<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
		$this->load->helper('url');
		$this->load->library('ion_auth');
	}

	public function index() {
		$data["logged_in"] = $this->ion_auth->logged_in();
		$data['products'] = $this->Shop_model->get_products();
		if ($this->ion_auth->logged_in())
			$data["user_group"] = $this->Shop_model->get_user_group($this->ion_auth->user()->row()->id);

		$this->load->view('templates/header');
		$this->load->view('templates/nav', $data);
		$this->load->view('home', $data);
		$this->load->view('templates/shopping-cart', $data);
		$this->load->view('templates/footer');
	}

}