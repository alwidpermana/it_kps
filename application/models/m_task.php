<?php
	class M_Task extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function getJobOrder($staff, $status, $whereStatus, $queryReview)
		{
			$sql = "SELECT
					  *
					FROM
					(
						SELECT
							a.ID,
							NAMA,
							NAME_PROGRAM,
							REQUEST_DATE,
							REQUEST_PIC,
							SOURCE,
							DESKRIPSI,
							OBJEK,
							STATUS_PROGRESS,
							PLAN_DATE,
							REVISI,
							NEW,
							URGENT,
							ERROR,
							CASE
								WHEN FOTO IS NULL OR FOTO = '' THEN 'assets/img/profile/profile-11.webp'
							ELSE CONCAT('assets/arsip/master-staff/',FOTO)
							END AS FOTO
						FROM
							IT_JOB_ORDER a
						INNER JOIN IT_STAFF b ON
						a.STAFF_ID = b.ID
						INNER JOIN IT_PROGRAM c ON
						a.PROGRAM_ID = c.ID
						WHERE
							a.STATUS = 'SAVED' AND
							a.STATUS_JOB_ORDER = '$status' $whereStatus
					)Q1
					LEFT JOIN
					(
						SELECT
							ID AS PROGRESS_ID,
							JOB_ORDER_ID,
							REVIEW_DATE,
							REVIEW_STATUS,
							STATUS
						FROM
							IT_PROGRESS
						WHERE
							STATUS_DATA = 'OPEN'
					)Q2 ON Q1.ID = Q2.JOB_ORDER_ID";
			return $this->db->query($sql);
		}
		public function updateJobOrderProgres($id, $status, $add)
		{
			$isiStatus = $status == 'Job Order'?'STATUS_PROGRESS = null':"STATUS_PROGRESS = '$status'";	
			$sql = "UPDATE IT_JOB_ORDER SET $isiStatus $add WHERE ID= '$id'";
			return $this->db->query($sql);
		}
		public function addProgress($uuid, $id, $status)
		{
			date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d H:i:s');
			$sql = "INSERT INTO IT_PROGRESS(ID, JOB_ORDER_ID, START_DATE, STATUS, STATUS_DATA)VALUES('$uuid','$id','$tanggal','$status','OPEN')";
			return $this->db->query($sql);
		}
		public function updateProgress($id, $update)
		{
			$sql = "UPDATE IT_PROGRESS SET $update WHERE JOB_ORDER_ID = '$id' AND STATUS_DATA = 'OPEN'";
			return $this->db->query($sql);
		}
		public function saveProgressDone($id, $status)
		{
			date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d H:i:s');
            $nik = $this->session->userdata("NIK");
			$sql = "UPDATE IT_PROGRESS SET REVIEW_DATE = '$tanggal', REVIEW_PIC = '$nik', REVIEW_STATUS = '$status', STATUS_DATA='CLOSE' WHERE JOB_ORDER_ID = '$id' AND STATUS_DATA= 'OPEN'";
			return $this->db->query($sql);
		}
		public function saveCaptureProgress($id, $idRevisi, $tipe, $fileName)
		{
			$sql = "INSERT INTO IT_PROGRESS_CAPTURE(ID, PROGRESS_ID, TYPE, FILE_NAME)VALUES('$id','$idRevisi','$tipe','$fileName')";
			return $this->db->query($sql);
		}
		public function getRevisiCapture($id)
		{
			$sql = "SELECT
						* 
					FROM
						IT_PROGRESS_CAPTURE
					WHERE
						PROGRESS_ID = '$id'";
			return $this->db->query($sql);
		}
		public function hapusCapture($id)
		{
			$sql = "DELETE FROM IT_PROGRESS_CAPTURE WHERE ID = '$id'";
			return $this->db->query($sql);
		}
		public function saveRevisi($id, $deskripsi)
		{
			date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d H:i:s');
            $nik = $this->session->userdata("NIK");
            $sql = "UPDATE IT_PROGRESS SET REVIEW_DATE = '$tanggal', REVIEW_PIC = '$nik', DESKRIPSI = '$deskripsi', REVIEW_STATUS = 'REVISI' WHERE ID = '$id'";
            return $this->db->query($sql);
		}
		public function getProgressById($id)
		{
			$sql = "SELECT * FROM IT_PROGRESS WHERE ID = '$id'";
			return $this->db->query($sql);
		}
	}
?>