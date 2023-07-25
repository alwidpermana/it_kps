<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('uuid');
		$this->load->model('M_Master');
		$this->load->model('M_Meeting');
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
		$data['side'] = 'meeting';
		$data['page'] = 'Meeting';
		$this->load->view("meeting/index", $data);
		
	}
	public function getTabelMeeting()
	{
		$filSearch = $this->input->get("filSearch");
		$data['data'] = $this->M_Meeting->getDataMeeting('')->result();
		$this->load->view("meeting/table", $data);
	}
	public function add()
	{
		$data['side'] = 'meeting';
		$data['page'] = 'Meeting';
		$data['pegawai'] = $this->M_Master->getPegawai('')->result();
		$data['program'] = $this->M_Master->getProgram('')->result();
		$data['staff_it'] = $this->M_Master->getStaffIT('')->result();
		$this->load->view("meeting/add", $data);
	}
	public function getMeetingNo()
	{
		$data = $this->M_Meeting->getMeetingNo();
		echo json_encode($data);
	}

	public function saveDraftMeeting()
	{
		$inputMeetingNo= $this->input->post("inputMeetingNo");
		$inputDate= date("Y-m-d", strtotime($this->input->post("inputDate")));
		$inputMeetingName= $this->input->post("inputMeetingName");
		$inputHour= $this->input->post("inputHour");
		$inputPIC= $this->input->post("inputPIC");
		$inputAttend= $this->input->post("inputAttend");
		$inputCategory= $this->input->post("inputCategory");
		$inputRoom = $this->input->post("inputRoom");
		$trigger = '';
		$inputId = '';
		if ($inputDate == '') {
			$message = 'Meeting Date Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputDate';
		}elseif ($inputMeetingName == '') {
			$message = 'Meeting Name Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputMeetingName';
		}elseif ($inputHour == '__:__') {
			$message = 'Meeting Hour Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputHour';
		}elseif ($inputPIC == '') {
			$message = 'Meeting PIC Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputPIC';
		}elseif ($inputAttend == '') {
			$message = 'Meeting Attendee Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputAttend';
		}elseif ($inputCategory == '') {
			$message = 'Category Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputCategory';
		}else{
			$inputId = $this->uuid->v4();
			$data = true;
			$data = $this->M_Meeting->saveDraftMeeting($inputId, $inputMeetingNo, $inputDate, $inputMeetingName, $inputHour, $inputPIC, $inputCategory, $inputRoom);
			if ($data == true) {
				$message = 'Berhasil Menyimpan Data';
				$status = 'Success';
				for ($i=0; $i <count($inputAttend) ; $i++) { 
					$this->db->query("INSERT INTO IT_ATTENDE_MEETING VALUES('','$inputId','$inputAttend[$i]')");	
				}
			}else{
				$message = 'Gagal Menyimpan Data';
				$status = 'Error';
			}
		}
		
		$response = array('message' =>$message , 'status'=>$status,'trigger'=>$trigger,'attend'=>$inputAttend,'id'=>$inputId);
		echo json_encode($response);
	}
	public function saveTaskMeeting()
	{
		$inputId= $this->input->post("inputId");
		$inputStaff = $this->input->post("inputStaff");
		$inputProgram= $this->input->post("inputProgram");
		$inputDeskripsi= $this->input->post("inputDeskripsi");
		$inputObjek= $this->input->post("inputObjek");
		$inputPlanDate= date("Y-m-d", strtotime($this->input->post("inputPlanDate")));
		$inputPICApprove= $this->input->post("inputPICApprove");
		$inputPIC= $this->input->post("inputPIC");
		$inputRevisi= $this->input->post("inputRevisi");
		$inputNew= $this->input->post("inputNew");
		$inputUrgent= $this->input->post("inputUrgent");
		$inputDate= date("Y-m-d", strtotime($this->input->post("inputDate")));
		$html="";
		if ($inputDeskripsi == '') {
			$message = 'Deskripsi Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputDeskripsi';
		}elseif($inputObjek == ''){
			$message = 'Objek Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputObjek';
		}elseif($inputPlanDate == ''){
			$message = 'Objek Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputPlanDate';
		}elseif($inputPICApprove == ''){
			$message = 'Objek Masih Kosong';
			$status = 'Warning';
			$trigger = '#inputPICApprove';
		}else{
			$trigger = '';
			$id = $this->uuid->v4();
			$data = $this->M_Meeting->saveTask($inputId, $inputStaff, $inputProgram, $inputDeskripsi, $inputObjek, $inputPlanDate, $inputPICApprove, $inputPIC, $inputDate, $id, $inputRevisi, $inputNew, $inputUrgent);
			if ($data == true) {
				$message = 'Berhasil Menyimpan Data';
				$status = 'Success';
				$html='';
			}else{
				$message = 'Gagal Menyimpan Data';
				$status = 'Error';
			}
		}
		$getCountTask = $this->db->query("SELECT ID FROM IT_JOB_ORDER WHERE SOURCE = 'MEETING' AND SOURCE_ID = '$inputId'")->num_rows();
		$jumlahTask = $getCountTask>0?$getCountTask:1;
		$response = array('message' =>$message , 'status'=>$status,'trigger'=>$trigger,'html'=>$html,'task'=>$jumlahTask);
		echo json_encode($response);
	}
	public function getTaskMeeting()
	{
		$inputId = $this->input->get('inputId');
		$status = $this->input->get('status');
		$data['status']=$status;
		$data['data'] = $this->M_Meeting->getTaskMeeting($inputId, $status)->result();
		$this->load->view("meeting/task", $data);
	}
	public function hapusTask()
	{
		$id = $this->input->post("taskID");
		$data = $this->M_Meeting->hapusTask($id);
		echo json_encode($data);
	}
	public function edit($id)
	{
		$whereId = "WHERE ID = '$id'";
		$data['data'] = $this->M_Meeting->getDataMeeting($whereId)->row();
		$this->load->view("meeting/edit", $data);
	}
	public function saveMeeting()
	{
		$inputMeetingName = $this->input->post("inputMeetingName");
		$inputPIC = $this->input->post("inputPIC");
		$inputRoom = $this->input->post("inputRoom");
		$inputCategory = $this->input->post("inputCategory");
		$inputMoM = $this->input->post("inputMoM");
		$inputId = $this->input->post("inputId");
		$inputAttend = $this->input->post("inputAttend");
		$data = $this->M_Meeting->updateMeeting($inputMeetingName, $inputPIC, $inputRoom, $inputCategory, $inputMoM, $inputId);
		$getTask = $this->db->query("SELECT ID FROM IT_JOB_ORDER WHERE SOURCE_ID = '$inputId' AND SOURCE = 'MEETING'");
		if ($getTask->num_rows()==0) {
			$response = array('status' =>'Warning','notif'=>'Belum ada task yang ditambahkan!');
		}else{
			if ($data == true) {
				$this->db->query("UPDATE IT_JOB_ORDER SET STATUS = 'SAVED', STATUS_JOB_ORDER = 'Open' WHERE SOURCE_ID = '$inputId' AND SOURCE = 'MEETING'");
				$this->db->query("DELETE FROM IT_ATTENDE_MEETING WHERE MEETING_ID = '$inputId'");
				for ($i=0; $i <count($inputAttend) ; $i++) { 
					$this->db->query("INSERT INTO IT_ATTENDE_MEETING VALUES('','$inputId','$inputAttend[$i]')");	
				}
				$response = array('status' =>'Success','notif'=>'Berhasil Menyimpan Data Meeting');
			}

		}
		
		echo json_encode($response);
	}
	public function view($id)
	{
		$data['side']= 'meeting';
		$data['page'] = 'View Meeting';
		$where = " WHERE ID = '$id'";
		$dataMeeting = $this->M_Meeting->getDataMeeting($where);
		// if ($dataMeeting->num_rows()==0) {
		// 	$this->session->set_flashdata('warning', 'Data Tidak Ditemukan! Hubungi Staff IT!');
		// 	redirect(base_url('meeting'));
		// }else{

		// }
		$data['attende'] = $this->M_Meeting->getAttendeById($id)->result();
		$data['data'] = $dataMeeting->row();
		$this->load->view("meeting/view", $data);
	}
	
}	
?>