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

		return $this->db->get_where('products', array('id' => $id))->row_array();
	}

	public function set_product() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$userId = $this->ion_auth->user()->row()->id;

		$data = array(
			'name'			=> $this->input->post('product'),
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

	public function set_order($productid) {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$userId = $this->ion_auth->user()->row()->id;

		$data = array(
			'status'		=> 0,
			'products_id'	=> $productid,
			'date'			=> date('Y/m/d H:i:s'),
			'users_id'		=> $userId
		);

	 	$this->db->insert('orders', $data);
	}

	public function get_product_gallery($id) {
		return $this->db->get_where('product_gallery', array('products_id' => $id))->result_array();
	}

}