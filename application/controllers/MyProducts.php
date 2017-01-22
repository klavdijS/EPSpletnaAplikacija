<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyProducts extends CI_Controller {

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
		$this->load->library('ion_auth');
		$this->load->library('cart');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('upload', $config);
	}

	public function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}
		
		$userId = $this->ion_auth->user()->row()->id;
		$data["logged_in"] = $this->ion_auth->logged_in();
		$data["user_group"] = $this->Shop_model->get_user_group($userId);
		$data["products"] = $this->Shop_model->get_products($userId);

		if ($data["user_group"]["group_id"] != 1 && $data["user_group"]["id"] != 2) {
			redirect('');
		}

		$this->load->view('templates/header');
		$this->load->view('templates/nav', $data);
		$this->load->view('my-products', $data);
		$this->load->view('templates/shopping-cart', $data);
		$this->load->view('templates/footer');
	}

	public function edit($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$userId = $this->ion_auth->user()->row()->id;
		$data["logged_in"] = $this->ion_auth->logged_in();
		$data["user_group"] = $this->Shop_model->get_user_group($userId);
		$data["product"] = $this->Shop_model->get_product($id);

		if (!$data["product"] OR ($data["user_group"]["id"] != 1 AND $data["user_group"]["id"] != 2) OR $userId != $data["product"]["users_id"]) {
			redirect('');
		}

		$data["title"] = "Edit Product";
		$data["btn"] = "Update product";
		$data["action"] = "my-products/edit/".$id;
		$data["photos"] = $this->Shop_model->get_product_gallery($id);

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
		$data["upload_errors"] = "";
		if ( $_FILES AND $_FILES['featuredImage']['name'] ) {
			$data["upload_errors"] = ( ! $this->upload->do_upload('featuredImage') && $_SERVER['REQUEST_METHOD'] == 'POST' ) ? $this->upload->display_errors() : '';
		}

		// Če validacija ni uspela, to sporoči uporabniku, sicer dodaj
		// izdelek v bazo in ga preusmeri na uvodno stran.
		if ($this->form_validation->run() === FALSE OR ! empty($data["upload_errors"])) {

			// Inputi
			$data['name'] = array(
				'type'	=> 'text', 
				'class'	=> 'form-control',
				'name'	=> 'name',
				'value'	=> $data["product"]["name"]
			);

			$data['description'] = array(
				'class'	=> 'form-control',
				'rows'	=> 5,
				'name'	=> 'description',
				'value'	=> $data["product"]["description"]
			);

			$data['featuredImage'] = array(
				'name'	=> 'featuredImage'
			);

			$data['price'] = array(
				'type'	=> 'text', 
				'class'	=> 'form-control',
				'name'	=> 'price',
				'value'	=> $data["product"]["price"]
			);

			$data['image1'] = array(
				'name'	=> 'image1'
			);

			$data['image2'] = array(
				'name'	=> 'image2'
			);

			$data['image3'] = array(
				'name'	=> 'image3'
			);

			$this->load->view('templates/header');
			$this->load->view('templates/nav', $data);
			$this->load->view('new-product', $data);
			$this->load->view('templates/shopping-cart', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Shop_model->update_product($userId, $data["product"]["id"]);
			redirect('my-products', 'refresh');
		}
	}

	public function deactivate($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$userId = $this->ion_auth->user()->row()->id;
		$user_group = $this->Shop_model->get_user_group($userId);
		$product = $this->Shop_model->get_product($id);

		if (!$product OR $user_group["id"] != 2 OR $userId != $product["users_id"]) {
			redirect('');
		}

		$this->Shop_model->deactivate_product($product["id"]);
		redirect('my-products', 'refresh');
	}

	public function activate($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$userId = $this->ion_auth->user()->row()->id;
		$user_group = $this->Shop_model->get_user_group($userId);
		$product = $this->Shop_model->get_product($id);

		if (!$product OR $user_group["id"] != 2 OR $userId != $product["users_id"]) {
			redirect('');
		}

		$this->Shop_model->activate_product($product["id"]);
		redirect('my-products', 'refresh');
	}

}