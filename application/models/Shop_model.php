<?php
class Shop_model extends CI_Model {

	public function __construct() {
		$this->load->database();
		$this->load->helper('url');

		date_default_timezone_set('Europe/Ljubljana');
	}

	public function get_products($slug = FALSE) {
		// Če ni podan specifičen produkt, vrni vse produkte iz baze.
		if ($slug === FALSE) {
			return $this->db->get('products')->result_array();
		}

		return $this->db->get_where('products', array('slug' => $slug))->row_array();
	}

	public function set_product() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		// Zamenjamo vse presledke s pomisljaji in poskrbimo, da so vse
		// besede napisane v malih tiskanih crkah.
		$slug = url_title($this->input->post('product'), 'dash', TRUE);

		$user_id = $this->ion_auth->user()->row()->id;

		$data = array(
			'name'			=> $this->input->post('product'),
			'description'	=> $this->input->post('description'),
			'date'			=> date('Y/m/d H:i:s'),
			'price'			=> $this->input->post('price'),
			'image'			=> $this->upload->data('file_name'),
			'slug'			=> $slug,
			'users_id'		=> $user_id
		);

		return $this->db->insert('products', $data);
	}

}