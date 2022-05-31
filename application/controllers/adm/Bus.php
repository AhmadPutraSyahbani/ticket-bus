<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->model('getkod_model');
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index(){
	$data['title'] = "Data Bus Tourismo";
	$data['bus'] = $this->db->query("SELECT * FROM tbl_bus ORDER BY nama_bus asc")->result_array();
	$this->load->view('adm/bus', $data);
	}
	public function viewbus($id=''){
		$data['title'] = "View Bus";
		$data['bus'] = $this->db->query("SELECT * FROM tbl_bus WHERE kd_bus = '".$id."'")->row_array();
		$this->load->view('adm/view_bus', $data);
	}
	public function tambahbus(){
		$kode = $this->getkod_model->get_kodbus();
		$data = array(
			'kd_bus' => $kode,
			'nama_bus' => $this->input->post('nama_bus'),
			'plat_bus'		 => $this->input->post('plat_bus'),
			'kapasitas_bus'		 => $this->input->post('seat'),
			'status_bus'			=> '1'
			 );
		$this->db->insert('tbl_bus', $data);
		$this->session->set_flashdata('message', 'swal("Berhasil", "Data Bus Tersimpan", "success");');
		redirect('adm/bus');
	}
	public function hapus($kd_bus){
		$this->getkod_model->hapusDatabus($kd_bus);
		redirect('adm/bus');
	}

}

/* End of file Bus.php */
/* Location: ./application/controllers/adm/Bus.php */