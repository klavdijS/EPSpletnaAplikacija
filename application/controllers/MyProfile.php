<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyProfile extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
		$this->load->helper('url');
		$this->load->library('ion_auth');
		$this->load->library('cart');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		} else {
			$data["user"] = $this->Shop_model->get_user($this->ion_auth->user()->row()->id);
		}

		$data["user_group"] = $this->Shop_model->get_user_group($this->ion_auth->user()->row()->id);
		if ($data["user_group"]["group_id"] != 1 && $data["user_group"]["group_id"] != 2) {
			redirect('');
		}

		$data["logged_in"] = $this->ion_auth->logged_in();
		
		$user = $this->Shop_model->get_user($this->ion_auth->user()->row()->id);

		$data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $user["first_name"],
			'class' => 'form-control',
		);
		$data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $user["last_name"],
			'class' => 'form-control',
		);
		$data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'value' => $user['email'],
			'class' => 'form-control',
		);
		$data['street'] = array(
			'name'  => 'street',
			'id'    => 'street',
			'type'  => 'text',
			'value' => $user['street'],
			'class' => 'form-control',
		);
		$data['street_number'] = array(
			'name'  => 'street_number',
			'id'    => 'street_number',
			'type'  => 'text',
			'value' => $user['street_number'],
			'class' => 'form-control',
		);
		$data['city'] = array(
			'name'  => 'city',
			'id'    => 'city',
			'type'  => 'text',
			'value' => $user['city'],
			'class' => 'form-control',
		);
		$data['postcode'] = array(
			'name'  => 'postcode',
			'id'    => 'postcode',
			'type'  => 'text',
			'value' => $user['postcode'],
			'class' => 'form-control',
		);
		$data['country'] = array(
			'name'  => 'country',
			'id'    => 'country',
			'type'  => 'country',
			'value' => $user['country'],
			'class' => 'form-control',
		);
		$data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $user['phone'],
			'class' => 'form-control',
		);

		// validate form input
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim');
		$this->form_validation->set_rules('street', 'Street', 'trim');
		$this->form_validation->set_rules('street_number', 'Street number', 'trim');
		$this->form_validation->set_rules('city', 'City', 'trim');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim');
		$this->form_validation->set_rules('country', 'Country', 'trim');
		
		if ($this->form_validation->run() == true) {
			$this->Shop_model->update_user($user["id"]);
			$this->session->set_flashdata('success', 'Your profile is successfully updated.');
		}

		$this->load->view('templates/header');
		$this->load->view('templates/nav', $data);
		$this->load->view('my-profile', $data);
		$this->load->view('templates/shopping-cart', $data);
		$this->load->view('templates/footer');
	}

}