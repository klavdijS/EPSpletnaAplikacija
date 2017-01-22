<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
		$this->load->helper('url');
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('form_validation');
		$this->load->helper('form');
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

	public function addCart() {
		// Set array for send data.
		$insert_data = array(
		'id' => $this->input->post('id'),
		'name' => $this->input->post('name'),
		'price' => $this->input->post('price'),
		'qty' => 1
		);
		// This function add items into cart.
		$this->cart->insert($insert_data);
		// This will show insert data in cart.
		redirect('home');
	}

	public function removeCart($rowid) {
		$data = array(
			'rowid' => $rowid,
			'qty' => 0
		);
		$this->cart->update($data);
		redirect('home');
	}

	public function minusQty($rowid, $qty) {
		$newQty = $qty - 1;
		$data = array(
			'rowid' => $rowid,
			'qty' => $newQty
		);
		$this->cart->update($data);
		redirect('home');
	}

	public function plusQty($rowid, $qty) {
		$newQty = $qty + 1;
		$data = array(
			'rowid' => $rowid,
			'qty' => $newQty
		);
		$this->cart->update($data);
		redirect('home');
	}

	public function updateCart(){
		$cart_info = $_POST['cart'];
		foreach( $cart_info as $id => $cart) {
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];

			$data = array(
			'rowid' => $rowid,
			'price' => $price,
			'amount' => $amount,
			'qty' => $qty
			);

			$this->cart->update($data);
		}
		redirect('home');
	}

	public function checkoutOpen() {
		$data["logged_in"] = $this->ion_auth->logged_in();
		$data['products'] = $this->Shop_model->get_products();

		$this->load->view('templates/header');
		$this->load->view('templates/nav', $data);
		$this->load->view('checkout', $data);
		$this->load->view('templates/shopping-cart', $data);
		$this->load->view('templates/footer');

		$cart = $this->cart->contents();
		foreach ($cart as $item) {
			$this->Shop_model->set_order($item['id']);
		}

		#$this->cart->destroy();
	}

}