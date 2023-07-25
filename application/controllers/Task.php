<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('uuid');
		$this->load->model('M_Task');
		$this->load->model('M_Master');
		
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
		$data['side'] = 'task';
		$data['page'] = 'Task';
		$data['program'] = $this->M_Master->getProgram('')->result();
		$data['staff'] = $this->M_Master->getStaffIT('')->result();
		$this->load->view("task/index", $data);
	}
	public function listTask($value='')
	{
		$tipe = $this->input->get("tipe");
		$filStaff = $this->input->get("filStaff");
		if ($tipe == 'job order') {
			$whereStatus = " AND a.STATUS_PROGRESS IS NULL";
			$status = 'OPEN';
			$queryReview="";
		}elseif($tipe == 'on progress'){
			$whereStatus = " AND a.STATUS_PROGRESS ='On Progress'";
			$status = 'OPEN';
			$queryReview='';
		}elseif ($tipe == 'review') {
			$whereStatus = " AND a.STATUS_PROGRESS ='Review'";
			$status = 'OPEN';
			$queryReview="";
		}elseif ($tipe == 'done') {
			$whereStatus = " AND a.STATUS_PROGRESS ='Done'";
			$status = 'CLOSE';
			$queryReview='';
		}else{
			$status = '-';
			$whereStatus = " AND a.STATUS_PROGRESS ='--'";
			$queryReview='';
		}
		
		$data['tipe'] = $tipe;
		$data['data'] = $this->M_Task->getJobOrder($filStaff,$status, $whereStatus, $queryReview)->result();
		$this->load->view("task/progress", $data);
	}
	public function nextTask()
	{
		$id = $this->input->post("id");
		$next = $this->input->post("next");
		$status = $this->input->post("status");
		date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
		if ($next == 'On Progress') {
			$add= ", START_PROGRESS='$tanggal' ";
			$data = $this->M_Task->updateJobOrderProgres($id, $next, $add);
			if ($data == true) {
				$uuid = $this->uuid->v4();
				$status = 'INITIAL';
				$this->M_Task->addProgress($uuid,$id, $status);
				$response = array('data' =>$data ,'status'=>'success' );
			}
		}elseif ($next == 'Review') {
			$data = $this->M_Task->updateJobOrderProgres($id, $next, '');
			if ($data == true) {
				$update = "END_DATE = '$tanggal'";
				$this->M_Task->updateProgress($id, $update);
				$this->db->query("UPDATE IT_JOB_ORDER SET END_PROGRESS = '$tanggal' WHERE ID= '$id'");
				$response = array('data' =>$data ,'status'=>'success' );
			}
		}else{
			$response = array('data' =>true ,'status'=>'warning' );
		}
		echo json_encode($response);
	}
	public function cancelTask()
	{
		$id = $this->input->post("id");
		$next = $this->input->post("next");
		date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
		if ($next == 'Job Order') {
			$data = $add= ", START_PROGRESS=NULL ";
			$data = $this->M_Task->updateJobOrderProgres($id, $next, $add);
			if ($data == true) {
				$this->db->query("DELETE FROM IT_PROGRESS WHERE JOB_ORDER_ID = '$id' AND STATUS_DATA ='OPEN'");
			}
			$response = array('data' =>$data ,'status'=>'success' );
		}elseif ($next=='On Progress') {
			$data = $this->M_Task->updateJobOrderProgres($id, $next, '');
			if ($data == true) {
				if ($data == true) {
					$update = "END_DATE = NULL";
					$this->M_Task->updateProgress($id, $update);
					$response = array('data' =>$data ,'status'=>'success' );
				}	
			}
		}else{
			$response = array('data' =>true ,'status'=>'warning' );
		}
		echo json_encode($response);
	}
	public function progressDone()
	{
		$id = $this->input->post("id");
		$jenis = $this->input->post("jenis");
		$status = $jenis == 'approve' ? 'APPROVE' : 'REVISI';
		$data = $this->M_Task->saveProgressDone($id, $status);
		if ($data == true) {
			date_default_timezone_set('Asia/Jakarta');
		    $tanggal = date('Y-m-d H:i:s');
			$nik = $this->session->userdata("NIK");
			$this->db->query("UPDATE IT_JOB_ORDER SET ACTUAL_DATE = '$tanggal', APPROVE_DATE='$tanggal', APPROVE_STATUS = 'APPROVED', STATUS_JOB_ORDER = 'Close', STATUS_PROGRESS= 'Done' WHERE ID = '$id' ");
		}
		echo json_encode($data);
	}
	public function getUUID()
	{
		$uuid = $this->uuid->v4();
		echo json_encode($uuid); 
	}
	public function getImageRevisi()
	{
		$inputIdRevisi = $this->input->get("inputIdRevisi");
		$data['data'] = $this->M_Task->getRevisiCapture($inputIdRevisi)->result();
		$this->load->view("task/revisi-image", $data);
	}
	public function saveCaptureProgress()
	{
		$config['upload_path']="./assets/arsip/capture-progress";
        $config['allowed_types']='jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
	    if($this->upload->do_upload("inputFile")){
	        $data = $this->upload->data();

	        //Resize and Compress Image
            // $config['image_library']='gd2';
            $config['source_image']='./assets/arsip/capture-progress/'.$data['file_name'];
            // $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            // $config['quality']= '60%';
            // $config['width']= 1024;
            // $config['max_size']     = '1500';
        		
            // $config['height']= 768;
            // $config['new_image']= './assets/dokumen/kecelakaan-kerja/'.$data['file_name'];
            $this->load->library('image_lib', $config);
            // $this->image_lib->resize();
            $fileName= $data['file_name'];
	    }else{
	    	$fileName = '';
	    }
	    $inputIdRevisi = $this->input->post("inputIdRevisi");
	    $inputTipe = $this->input->post("inputTipe");
	    $id = $this->uuid->v4();
	    $data = $this->M_Task->saveCaptureProgress($id, $inputIdRevisi, $inputTipe, $fileName);
	    echo json_encode($data);
	}
	public function hapusCapture()
	{
		$id= $this->input->post("id");
		$data = $this->M_Task->hapusCapture($id);
		echo json_encode($data);
	}
	public function saveRevisi()
	{
		$inputIdRevisi = $this->input->post("inputIdRevisi");
		$inputDeskripsi = $this->input->post("inputDeskripsi");
		$data = $this->M_Task->saveRevisi($inputIdRevisi, $inputDeskripsi);
		echo json_encode($data);
	}
	public function getProgressById()
	{
		$id = $this->input->get("id");
		$data = $this->M_Task->getProgressById($id)->row();
		echo json_encode($data);
	}
	public function startRevisi()
	{
		$id = $this->input->post("id");
		$uuid = $this->uuid->v4();
		$status = 'REVISI';
		$data = $this->M_Task->addProgress($uuid,$id, $status);
		if ($data == true) {
			$this->db->query("UPDATE IT_JOB_ORDER SET END_PROGRESS = null, STATUS_PROGRESS = 'On Progress' WHERE ID = '$id'");
			$this->db->query("UPDATE IT_PROGRESS SET STATUS_DATA = 'CLOSE' WHERE JOB_ORDER_ID = '$id' AND REVIEW_STATUS = 'REVISI' AND STATUS_DATA = 'OPEN'");
		}
		echo json_encode($data);

	}
}
?>