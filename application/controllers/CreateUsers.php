<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateUsers extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
		$this->load->helper('url');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->lang->load('auth');
        $this->load->library('cart');
        $this->load->library('form_validation');
        $this->load->helper('form');
	}

	public function index() {
		if ($this->ion_auth->logged_in()) {
			$this->data["user_group"] = $this->Shop_model->get_user_group($this->ion_auth->user()->row()->id);
		}

		if (!$this->ion_auth->logged_in() OR (!$this->ion_auth->is_admin() AND $this->data["user_group"]["id"] != 2)) {
            redirect('', 'refresh');
		}

        if($_SERVER["SSL_CLIENT_VERIFY"] === null OR $_SERVER["SSL_CLIENT_VERIFY"] != "SUCCESS") {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->lang->line('create_user_heading');
		$this->data["logged_in"] = $this->ion_auth->logged_in();
		$this->data['products'] = $this->Shop_model->get_products();

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email') {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('street', $this->lang->line('create_user_validation_address_street_label'), 'trim');
        $this->form_validation->set_rules('street_number', $this->lang->line('create_user_validation_address_street_number_label'), 'trim');
        $this->form_validation->set_rules('city', $this->lang->line('create_user_validation_address_city_label'), 'trim');
        $this->form_validation->set_rules('postcode', $this->lang->line('create_user_validation_address_postcode_label'), 'trim');
        $this->form_validation->set_rules('country', $this->lang->line('create_user_validation_address_country_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' 	=> $this->input->post('first_name'),
                'last_name'  	=> $this->input->post('last_name'),
                'street'		=> $this->input->post('street'),
                'street_number'	=> $this->input->post('street_number'),
                'city'			=> $this->input->post('city'),
                'postcode'		=> $this->input->post('postcode'),
                'country'		=> $this->input->post('country'),
                'phone'      	=> $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            if($this->ion_auth->in_group(array(1, 2))) {
                $user = $this->ion_auth->user()->row();
                $group = $this->Shop_model->get_user_group_by_name($user->username);
                log_message('error', 'New user was successfully created by '.$user->username.' ['.$group["name"].'] from IP: '.$_SERVER['REMOTE_ADDR']);
            }
            redirect('edit-users', 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
                'class' => 'form-control',
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
                'class' => 'form-control',
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => 'form-control',
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control',
            );
            $this->data['street'] = array(
                'name'  => 'street',
                'id'    => 'street',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('street'),
                'class' => 'form-control',
            );
            $this->data['street_number'] = array(
                'name'  => 'street_number',
                'id'    => 'street_number',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('street_number'),
                'class' => 'form-control',
            );
            $this->data['city'] = array(
                'name'  => 'city',
                'id'    => 'city',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('city'),
                'class' => 'form-control',
            );
            $this->data['postcode'] = array(
                'name'  => 'postcode',
                'id'    => 'postcode',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('postcode'),
                'class' => 'form-control',
            );
            $this->data['country'] = array(
                'name'  => 'country',
                'id'    => 'country',
                'type'  => 'country',
                'value' => $this->form_validation->set_value('country'),
                'class' => 'form-control',
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
                'class' => 'form-control',
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control',
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
                'class' => 'form-control',
            );

            $this->load->view('templates/header');
			$this->load->view('templates/nav', $this->data);
			$this->load->view('auth/register', $this->data);
			$this->load->view('templates/shopping-cart', $this->data);
			$this->load->view('templates/footer');
        }
	}

}