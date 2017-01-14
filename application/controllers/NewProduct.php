<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewProduct extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->library('ion_auth');
		$this->load->library('form_validation');
	}

	public function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}
		
		$data["logged_in"] = $this->ion_auth->logged_in();

		// Validacija poslanih podatkov
		$this->form_validation->set_rules('product', 'product', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('price', 'price', 'numeric', 'required');

		// Določanje parametrov, katerim mora ustrezati naložena slika.
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 1000;
		$config['max_width'] = 2048;
		$config['max_height'] = 1536;

		// Nalaganje slike na strežnik.
		$this->load->library('upload', $config);

		// Če je pri nalaganju prišlo do napake (npr. slika ne ustreza podanim parametrom),
		// sporoči uporabniku napako.
		$data["upload_errors"] = ( ! $this->upload->do_upload('photo') && $_SERVER['REQUEST_METHOD'] == 'POST' ) ? $this->upload->display_errors() : '';

		// Če validacija ni uspela, to sporoči uporabniku, sicer dodaj
		// izdelek v bazo in ga preusmeri na uvodno stran.
		if ($this->form_validation->run() === FALSE OR ! empty($data["upload_errors"])) {
			
			// Inputi
			$data['product'] = array(
				'type'	=> 'text', 
				'class'	=> 'form-control',
				'name'	=> 'product',
				'value'	=> $this->form_validation->set_value('product')
			);

			$data['description'] = array(
				'class'	=> 'form-control',
				'rows'	=> 5,
				'name'	=> 'description',
				'value'	=> $this->form_validation->set_value('description')
			);

			$data['photo'] = array(
				'name'	=> 'photo',
				'value'	=> $this->form_validation->set_value('photo')
			);

			$data['price'] = array(
				'type'	=> 'text', 
				'class'	=> 'form-control',
				'name'	=> 'price',
				'value'	=> $this->form_validation->set_value('price')
			);

			$this->load->view('templates/header');
			$this->load->view('templates/nav', $data);
			$this->load->view('new-product', $data);
			$this->load->view('templates/shopping-cart', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Shop_model->set_product();
			redirect('home', 'refresh');
		}
	}

}