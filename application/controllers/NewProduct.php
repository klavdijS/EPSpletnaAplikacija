<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewProduct extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Določanje parametrov, katerim mora ustrezati naložena slika.
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 1000;
		$config['max_width'] = 2048;
		$config['max_height'] = 1536;

		$this->load->model('Shop_model');

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('upload', $config);
		$this->load->library('cart');
		$this->load->library('session');
	}

	public function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$data["logged_in"] = $this->ion_auth->logged_in();
		$data["user_group"] = $this->Shop_model->get_user_group($this->ion_auth->user()->row()->id);

		if ($data["user_group"]["group_id"] != 1 && $data["user_group"]["group_id"] != 2) {
			redirect('');
		}

		$data["title"] = "Add New Product";
		$data["btn"] = "Add new product";
		$data["action"] = "new-product";

		// Validacija poslanih podatkov
		$this->form_validation->set_rules('name', 'product', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('price', 'price', 'numeric', 'required');

		// Naloži preostale slike na strežnik
		$this->upload->do_upload('image1');
		$this->upload->do_upload('image2');
		$this->upload->do_upload('image3');

		// Če je pri nalaganju prišlo do napake (npr. slika ne ustreza podanim parametrom),
		// sporoči uporabniku napako.
		$data["upload_errors"] = ( ! $this->upload->do_upload('featuredImage') && $_SERVER['REQUEST_METHOD'] == 'POST' ) ? $this->upload->display_errors() : '';

		// Če validacija ni uspela, to sporoči uporabniku, sicer dodaj
		// izdelek v bazo in ga preusmeri na uvodno stran.
		if ($this->form_validation->run() === FALSE OR ! empty($data["upload_errors"])) {

			// Inputi
			$data['name'] = array(
				'type'	=> 'text', 
				'class'	=> 'form-control',
				'name'	=> 'name',
				'value'	=> $this->form_validation->set_value('name')
			);

			$data['description'] = array(
				'class'	=> 'form-control',
				'rows'	=> 5,
				'name'	=> 'description',
				'value'	=> $this->form_validation->set_value('description')
			);

			$data['featuredImage'] = array(
				'name'	=> 'featuredImage',
				'value'	=> $this->form_validation->set_value('featuredImage')
			);

			$data['price'] = array(
				'type'	=> 'text', 
				'class'	=> 'form-control',
				'name'	=> 'price',
				'value'	=> $this->form_validation->set_value('price')
			);

			$data['image1'] = array(
				'name'	=> 'image1',
				'value'	=> $this->form_validation->set_value('image1')
			);

			$data['image2'] = array(
				'name'	=> 'image2',
				'value'	=> $this->form_validation->set_value('image2')
			);

			$data['image3'] = array(
				'name'	=> 'image3',
				'value'	=> $this->form_validation->set_value('image3')
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