<?php
class Shop_model extends CI_Model {

	public function __construct() {
		$this->load->database();
		$this->load->helper('url');

		date_default_timezone_set('Europe/Ljubljana');
	}

	public function get_products($id = FALSE) {
		// Če ni podan specifičen produkt, vrni vse produkte iz baze.
		if ($id === FALSE) {
			return $this->db->get('products')->result_array();
		}

		return $this->db->get_where('products', array('users_id' => $id))->result_array();
	}

	public function get_orders($id, $user_group) {
		if ($user_group == 1) {
			return $this->db->select('*')->from('orders')->join('products', 'products.id = orders.products_id')->get()->result_array();
		}
		else if ($user_group == 2) {
			return $this->db->select('*')->from('products')->where('users_id', $id)->join('orders', 'products_id = products.id')->get()->result_array();
		}
		else if ($user_group == 3) {
			return $this->db->select('*')->from('orders')->where('users_id1', $id)->join('products', 'id = orders.products_id')->get()->result_array();
		}
	}

	public function user_certified($id) {
		return $this->db->where('id', $id)->update('users', array('isCertified' => TRUE));
		// return $this->db->insert('users', array('isCertified' => TRUE);
	}

	public function approve_order($id) {
		$data = array(
			'status'		=> 1
		);
		$this->db->where('id1', $id)->update('orders', $data);
	}

	public function cancel_order($id) {
		$data = array(
			'status'		=> 2
		);
		$this->db->where('id1', $id)->update('orders', $data);
	}

	public function remove_order($id) {
		$this->db->where('id1', $id)->delete('orders');
	}

	public function get_product($id) {
		return $this->db->get_where('products', array('id' => $id))->row_array();
	}

	public function set_product() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$userId = $this->ion_auth->user()->row()->id;

		$data = array(
			'name'			=> $this->input->post('name'),
			'description'	=> $this->input->post('description'),
			'date'			=> date('Y/m/d H:i:s'),
			'price'			=> $this->input->post('price'),
			'image'			=> $this->upload->data('file_name'),
			'users_id'		=> $userId
		);

	 	$this->db->insert('products', $data);

	 	$productId = $this->db->insert_id();

	 	// Shrani še ostale fotografije v fotogalerijo produkta,
	 	// vendar izpusti prvo fotografijo (t.j. prikazna slika),
	 	// ki se naloži že v tabelo s produkti.
	 	foreach ($_FILES as $file) {
	 		
	 		// Zamenjaj presledke v imenu datoteke s podčrtaji
	 		$filename = str_replace(' ', '_', $file["name"]);
			
			if ( ! empty($filename) && $filename != $this->upload->data('file_name')) {
				$data = array(
			 		'filename'		=> $filename,
			 		'products_id'	=> $productId
			 	);
			
			 	$this->db->insert('product_gallery', $data);
			}
		}
	}

	public function set_order($productid, $quantity) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$userId = $this->ion_auth->user()->row()->id;

		$data = array(
			'status'		=> 0,
			'products_id'	=> $productid,
			'date'			=> date('Y/m/d H:i:s'),
			'users_id'		=> $userId, 
			'qty'			=> $quantity
		);

	 	$this->db->insert('orders', $data);
	}

	public function update_product($userId, $productId) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$data = array(
			'name'			=> $this->input->post('name'),
			'description'	=> $this->input->post('description'),
			'date'			=> date('Y/m/d H:i:s'),
			'price'			=> $this->input->post('price'),
			'users_id'		=> $userId
		);

		if ($_FILES["featuredImage"]["name"]) {
			$filename = str_replace(' ', '_', $_FILES['featuredImage']["name"]);
			$data['image'] = $filename;
		}

	 	$this->db->where('id', $productId)->update('products', $data);

	 	// Shrani še ostale fotografije v fotogalerijo produkta.
	 	for($image = 1; $image <= 3; $image++) {
	 		
	 		// Zamenjaj presledke v imenu datoteke s podčrtaji
	 		$filename = isset($_FILES['image'.$image]) ? str_replace(' ', '_', $_FILES['image'.$image]["name"]) : "";

			if ( ! empty($filename) ) {
				$data = array(
			 		'filename'		=> $filename,
			 		'products_id'	=> $productId
			 	);

				if($this->input->post('imageId'.$image)) {
					$old_image_id = $this->input->post('imageId'.$image);
					$this->db->where('id', $old_image_id)->update('product_gallery', $data);
				} else {
					$this->db->insert('product_gallery', $data);
				}
			 }
		 }
	}

	public function set_votes($vote, $id) {
		$product = $this->db->get_where('products', array('id' => $id))->row_array();
		$rating = $product["rating"] + $vote;
		$this->db->where('id', $id)->update('products', array('rating' => $rating));
		return $rating;
	}

	public function get_product_gallery($id) {
		return $this->db->get_where('product_gallery', array('products_id' => $id))->result_array();
	}

	public function delete_image() {
		return $this->db->delete('product_gallery', array('id' => $this->input->post('delete_image')));
	}

	public function deactivate_product($id) {
		return $this->db->where('id', $id)->update('products', array('active' => FALSE));
	}

	public function activate_product($id) {
		return $this->db->where('id', $id)->update('products', array('active' => TRUE));
	}

	public function get_user_group($id) {
		return $this->db->select('*')->from('users_groups')->where('user_id', $id)->join('groups', 'groups.id = users_groups.group_id')->get()->row_array();	
	}

	public function get_user_group_by_name($name) {
		return $this->db->select('*')->from('users')->where('username', $name)->join('users_groups', 'users_groups.user_id = users.id')->join('groups', 'groups.id = users_groups.group_id')->get()->row_array();	
	}

	public function get_user($id = FALSE) {
		if ($id === FALSE) {
			return $this->db->select('*')->from('users')->join('users_groups', 'users_groups.user_id = users.id')->get()->result_array();
		}

		return $this->db->get_where('users', array('id' => $id))->row_array();
	}

	public function update_user($id) {
		$data = array(
			'first_name'	=> $this->input->post('first_name'),
			'last_name'		=> $this->input->post('last_name'),
			'email'			=> $this->input->post('email'),
			'phone'			=> $this->input->post('phone'),
			'street'		=> $this->input->post('street'),
			'street_number'	=> $this->input->post('street_number'),
			'city'			=> $this->input->post('city'),
			'postcode'		=> $this->input->post('postcode'),
			'country'		=> $this->input->post('country')
		);

		return $this->db->where('id', $id)->update('users', $data);
	}

}
