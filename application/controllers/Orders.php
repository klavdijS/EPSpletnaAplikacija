<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
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
		$data["user_group"] = $this->Shop_model->get_user_group($this->ion_auth->user()->row()->id);
		$data['orders'] = $this->Shop_model->get_orders($this->ion_auth->user()->row()->id, $data["user_group"]['group_id']);

		$this->load->view('templates/header');
		$this->load->view('templates/nav', $data);
		$this->load->view('orders', $data);
		$this->load->view('templates/shopping-cart', $data);
		$this->load->view('templates/footer');
	}

	public function approveOrder() {
		$id = $this->input->post('id');
		$this->Shop_model->approve_order($id);
		redirect('orders');
	}
	public function cancelOrder() {
		$id = $this->input->post('id');
		$this->Shop_model->cancel_order($id);
		redirect('orders');
	}
	public function removeOrder() {
		$id = $this->input->post('id');
		$this->Shop_model->remove_order($id);
		redirect('orders');
	}
}