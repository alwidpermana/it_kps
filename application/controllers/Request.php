<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('uuid');
		$this->load->model('M_Master');
		$this->load->model('M_Request');
		$this->load->model('M_Job_Order');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['side'] = 'request';
		$data['page'] = 'Request Program';
		$data['program'] = $this->M_Master->getProgram('')->result();
		$data['staff_it'] = $this->M_Master->getStaffIT('')->result();
		$this->load->view("request/index", $data);
	}
	public function getDataRequest()
	{
		$filSearch = $this->input->get("filSearch");
		$data['data'] = $this->M_Job_Order->getDataJobOrder('','',$filSearch, 'REQUEST')->result();
		$this->load->view("request/tabel", $data);
	}
	public function saveRequest($value='')
	{
		$inputId= $this->input->post("inputId"); 
		$inputStaff= $this->input->post("inputStaff"); 
		$inputProgram= $this->input->post("inputProgram"); 
		$inputDeskripsi= $this->input->post("inputDeskripsi"); 
		$inputObjek= $this->input->post("inputObjek"); 
		$inputRevisi= $this->input->post("inputRevisi"); 
		$inputNew= $this->input->post("inputNew"); 
		$inputUrgent= $this->input->post("inputUrgent"); 
		$inputError= $this->input->post("inputError"); 
		if ($inputDeskripsi == '') {
			$response = array('data' =>true ,'status'=>'warning', 'message'=>'Isi Deskripsinya Terlebih Dahulu!', 'field'=>'#inputDeskripsi');
		}elseif ($inputObjek == '') {
			$response = array('data' =>true ,'status'=>'warning', 'message'=>'Isi Objek/Form Terlebih Dahulu!', 'field'=>'#inputObjek');
		}elseif ($inputRevisi == 'N' && $inputNew == 'N' && $inputUrgent == 'N' && $inputError == 'N') {
			$response = array('data' =>true ,'status'=>'warning', 'message'=>'Pilih Setidaknya 1 Jenis!', 'field'=>'#inputRevisi');
		}else{
			if ($inputId == '') {
				$id = $this->uuid->v4();
				$data=$this->M_Request->saveRequest($id, $inputStaff, $inputProgram, $inputDeskripsi, $inputObjek, $inputRevisi, $inputNew, $inputUrgent, $inputError);
			}else{
				$data=$this->M_Request->updateRequest($inputId, $inputStaff, $inputProgram, $inputDeskripsi, $inputObjek, $inputRevisi, $inputNew, $inputUrgent, $inputError);
			}
			$response = array('data' =>$data ,'status'=>'success');
		}
		echo json_encode($response);
	}
	public function cancelRequest()
	{
		$id = $this->input->post("id");
		$data = $this->M_Request->cancelRequest($id);
		echo json_encode($data);
	}
	public function saveApprove()
	{
		$id = $this->input->post("id");
		$jenis = $this->input->post("jenis");
		$plan = date("Y-m-d", strtotime($this->input->post("plan")));
		$pic = $this->input->post("pic");
		$data = $this->M_Request->saveApprove($id, $jenis, $pic);
		if ($data == true && $jenis == 'APPROVE') {
			$this->db->query("UPDATE IT_JOB_ORDER SET PLAN_DATE = '$plan', APPROVE_PIC = '$pic' WHERE ID = '$id'");
		}
		echo json_encode($data);
	}
}
?>