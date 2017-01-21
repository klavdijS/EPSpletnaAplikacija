<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {
	
	public function __construct() {
		parent::__construct();

		$this->load->model('Shop_model');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function index_get() {
		redirect('home', 'refresh');
	}

	public function product_get() {
		// Če ni naveden ID, javi napako.
		if(!$this->get('id')) {
			$this->response(NULL, 400);
		}

		$product = $this->Shop_model->get_product( $this->get('id') );
		$product["image"] = array('uploads/'. $product["image"]);
		$images = $this->Shop_model->get_product_gallery($product["id"]);
		foreach ($images as $image) array_push($product["image"],'uploads/'.$image["filename"]);

		// Sporoči, če produkt z navedenim ID-jem obstaja ali ne.
		if ($product) {
			$this->response($product, 200);
		} else {
			$this->response(NULL, 404);
		}
	}

	public function products_get() {
		$products = $this->Shop_model->get_products();

		for ($i = 0; $i < count($products); $i++) {
			$products[$i]["image"] = array('uploads/'. $products[$i]["image"]);
			$images = $this->Shop_model->get_product_gallery($products[$i]["id"]);
			foreach ($images as $image) array_push($products[$i]["image"],'uploads/'.$image["filename"]);
		}

		if ($products) {
			$this->response($products, 200);
		} else {
			$this->response(NULL, 404);
		}
	}

	public function login_post() {
		if ($this->ion_auth->login($this->post('username'), $this->post('password'))) {
			$userId = $this->ion_auth->user()->row()->id;
			$user = $this->Shop_model->get_user($userId);
			$data = array(
				"username"		=> $user["username"],
				"email"			=> $user["email"],
				"first_name"	=> $user["first_name"],
				"last_name"		=> $user["last_name"],
				"phone"			=> $user["phone"],
				"street"		=> $user["street"],
				"street_number"	=> $user["street_number"],
				"city"			=> $user["city"],
				"postcode"		=> $user["postcode"],
				"country"		=> $user["country"],
				"user_id"		=> $user["id"]
			);
			$this->response(array('status' => 'success', 'user' => $data));
		} else {
			$users = $this->Shop_model->get_user();
			$usernames = array_unique(array_map(function ($i) { return $i['username']; }, $users));

			if (!$this->post('username')) {
				$data = "Username is required.";
				$error_number = 1;
			} else if (!$this->post('password')) {
				$data = "Password is required.";
				$error_number = 2;
			} else if (!in_array($this->post('username'), $usernames)) {
				$data = "Username does not exist.";
				$error_number = 3;
			} else {
				$data = "Wrong password.";
				$error_number = 4;
			}
			$this->response(array('status' => 'failed', 'error' => $data, 'error_number' => $error_number));
		}
	}

	public function register_post() {
		$users = $this->Shop_model->get_user();
		$usernames = array_unique(array_map(function ($i) { return $i['username']; }, $users));
		$identity = $this->post('username');
		$password = $this->post('password');
		$email = $this->post('email');

		if (!$this->post('email')) {
			$data = "Email is required.";
		} else if (!$this->post('username')) {
			$data = "Username is required.";
		} else if (!$this->post('password')) {
			$data = "Password is required.";
		} else if (in_array($this->post('username'), $usernames)) {
			$data = "This user already exists.";
            $error_number = 4;
		}

		if (isset($data)) {
			$this->response(array('status' => 'failed', 'error' => $data, 'error_number' => $error_number));
			return;
		}

		$additional_data = array(
			'first_name' 	=> $this->post('first_name'),
			'last_name'  	=> $this->post('last_name'),
			'street'		=> $this->post('street'),
			'street_number'	=> $this->post('street_number'),
			'city'			=> $this->post('city'),
			'postcode'		=> $this->post('postcode'),
			'country'		=> $this->post('country'),
			'phone'      	=> $this->post('phone'),
		);

		if (!in_array($identity, $usernames) && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
			$this->response(array('status' => 'success'));
		} else {
			if (!$this->post('first_name')) {
				$data = "First name is required.";
			} else if (!$this->post('last_name')) {
				$data = "Last name is required.";
			} else {
				$data = "";
			}
			$this->response(array('status' => 'failed', 'error' => $data));
		}
	}

	public function changeuser_post() {
        if ($this->ion_auth->login($this->post('username'), $this->post('password'))) {
            $userId = $this->ion_auth->user()->row()->id;
            $this->Shop_model-> update_user($userId);
            $updated = FALSE;
            if (isset($_POST['new_password'])) {
                $this->ion_auth->change_password($this->post('username'), $this->post('password'), $this->input->post('new_password'));
                $updated = TRUE;
            }
            $user = $this->Shop_model->get_user($userId);
            $data = array(
                "username"		=> $user["username"],
                "email"			=> $user["email"],
                "first_name"	=> $user["first_name"],
                "last_name"		=> $user["last_name"],
                "phone"			=> $user["phone"],
                "street"		=> $user["street"],
                "street_number"	=> $user["street_number"],
                "city"			=> $user["city"],
                "postcode"		=> $user["postcode"],
                "country"		=> $user["country"],
                "user_id"		=> $user["id"]
            );
            $this->response(array('status' => 'success', 'user' => $data,'password_updated' => $updated));

        } else {
            $users = $this->Shop_model->get_user();
            $usernames = array_unique(array_map(function ($i) { return $i['username']; }, $users));

            if (!$this->post('username')) {
                $data = "Username is required.";
                $error_number = 1;
            } else if (!$this->post('password')) {
                $data = "Password is required.";
                $error_number = 2;
            } else if (!in_array($this->post('username'), $usernames)) {
                $data = "Username does not exist.";
                $error_number = 3;
            } else {
                $data = "Wrong password.";
                $error_number = 4;
            }
            $this->response(array('status' => 'failed', 'error' => $data, 'error_number' => $error_number));
        }

    }

}