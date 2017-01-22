<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
		$this->load->helper('url');
		$this->load->library('ion_auth');
		$this->load->library('session');
	}

	public function view( $productId ) {
		$data["logged_in"] = $this->ion_auth->logged_in();
		$data["product"] = $this->Shop_model->get_product( $productId );
		$data["productGallery"] = $this->Shop_model->get_product_gallery( $productId );
		if($data["logged_in"]) $data["user_group"] = $this->Shop_model->get_user_group($this->ion_auth->user()->row()->id);

		$this->load->view('templates/header');
		$this->load->view('templates/nav', $data);
		$this->load->view('product', $data);
		$this->load->view('templates/shopping-cart', $data);
		$this->load->view('templates/footer');
	}

	public function vote() {
		if( isset($_POST['vote']) && isset($_POST['id']) && !isset($_SESSION['voted']) ) {
			$vote = $_POST['vote'];
			$id = $_POST['id'];
			$this->session->set_userdata('voted', TRUE);
			echo $this->Shop_model->set_votes( $vote, $id );
		}
	}

}