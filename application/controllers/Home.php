<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('url');		
	}

	public function index() {
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('home');
		$this->load->view('templates/footer');
	}

}