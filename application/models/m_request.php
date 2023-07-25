<?php
	class M_Request extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function saveRequest($id, $inputStaff, $inputProgram, $inputDeskripsi, $inputObjek, $inputRevisi, $inputNew, $inputUrgent, $inputError)
		{
			date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d H:i:s');
            $nik = '-';
			$sql = "INSERT INTO IT_JOB_ORDER(ID, STAFF_ID, PROGRAM_ID, DESKRIPSI, OBJEK, REVISI, NEW, URGENT, ERROR, REQUEST_DATE, REQUEST_PIC, PIC_INPUT, TGL_INPUT, SOURCE, STATUS, STATUS_JOB_ORDER)VALUES('$id','$inputStaff','$inputProgram','$inputDeskripsi','$inputObjek','$inputRevisi','$inputNew','$inputUrgent','$inputError','$tanggal','$nik','$nik','$tanggal','REQUEST','DRAFT','Waiting Confirmation')";
			return $this->db->query($sql);
		}
		public function updateRequest($id, $inputStaff, $inputProgram, $inputDeskripsi, $inputObjek, $inputRevisi, $inputNew, $inputUrgent, $inputError)
		{
			$sql = "UPDATE IT_JOB_ORDER SET STAFF_ID = '$inputStaff', PROGRAM_ID = '$inputProgram', DESKRIPSI='$inputDeskripsi',OBJEK = '$inputObjek', REVISI = '$inputRevisi', NEW = '$inputNew', URGENT = '$inputUrgent', ERROR = '$inputError' WHERE ID = '$id'";
			return $this->db->query($sql);
		}
		public function cancelRequest($id)
		{
			$sql = "UPDATE IT_JOB_ORDER SET STATUS_JOB_ORDER = 'CANCEL' WHERE ID = '$id'";
			return $this->db->query($sql);
		}
		public function saveApprove($id, $jenis)
		{
			$status = $jenis == 'APPROVE' ? 'Open':'Reject';
			$sql = "UPDATE IT_JOB_ORDER SET STATUS = 'SAVED', STATUS_JOB_ORDER = '$status' WHERE ID = '$id'";
			return $this->db->query($sql);
		}
	}
?>