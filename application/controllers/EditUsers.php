<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditUsers extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
		$this->load->helper('url');
		$this->load->library('ion_auth');
		$this->load->library('cart');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->lang->load('auth');
	}

	public function index() {
        $data["user_group"] = $this->Shop_model->get_user_group($this->ion_auth->user()->row()->id);
        if (!$this->ion_auth->logged_in() OR (!$this->ion_auth->is_admin() AND $data["user_group"]["id"] != 2)) {
            redirect('', 'refresh');
        }

        $data["user"] = $this->Shop_model->get_user($this->ion_auth->user()->row()->id);
		if(!$data["user"]["isCertified"]) {
            redirect('', 'refresh');
        }

		$data["logged_in"] = $this->ion_auth->logged_in();
		$data['products'] = $this->Shop_model->get_products();
        $data["users"] = $this->Shop_model->get_user();
		
        $this->load->view('templates/header');
		$this->load->view('templates/nav', $data);
		$this->load->view('edit-users', $data);
		$this->load->view('templates/shopping-cart', $data);
		$this->load->view('templates/footer');
	}

}