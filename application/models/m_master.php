<?php
	class M_Master extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function saveDataStaffIT($id, $nik, $nama, $email, $no_hp, $status)
		{
			$sql = "INSERT INTO it_staff(ID, NIK, NAMA, EMAIL, NO_HP, STATUS)VALUES('$id','$nik','$nama','$email','$no_hp','$status')";
			return $this->db->query($sql);
		}
		public function updateDataStaffIT($id, $nik, $nama, $email, $no_hp, $status)
		{
			$sql = "UPDATE it_staff SET NIK = '$nik', NAMA = '$nama', EMAIL='$email', NO_HP='$no_hp', STATUS = '$status' WHERE ID = '$id'";
			return $this->db->query($sql);
		}
		public function getStaffIT($where)
		{
			$sql = "SELECT
						ID,
						FOTO,
						NIK,
						NAMA,
						EMAIL,
						NO_HP,
						STATUS
					FROM
						IT_STAFF
					$where
					ORDER BY NAMA ASC";
			return $this->db->query($sql);
		}
		public function saveDataProgram($id, $type, $link, $nama, $staff)
		{
			$sql = "INSERT INTO IT_PROGRAM(ID, TYPE, LINK, NAME_PROGRAM, STAFF_ID)VALUES('$id','$type','$link','$nama','$staff')";
			return $this->db->query($sql);
		}
		public function updateDataProgram($id, $type, $link, $nama, $staff)
		{
			$sql = "UPDATE IT_PROGRAM SET TYPE='$type', LINK = '$link', NAME_PROGRAM='$nama', STAFF_ID = '$staff' WHERE ID='$id'";
			return $this->db->query($sql);
		}
		public function getProgram($where)
		{
			$sql = "SELECT
						a.*,
						b.NAMA	
					FROM
						IT_PROGRAM a
					LEFT JOIN
						IT_STAFF b ON
					a.STAFF_ID = b.ID
					$where
					ORDER BY NAME_PROGRAM ASC";
			return $this->db->query($sql);
		}
		public function deleteProgram($id)
		{
			$sql = "DELETE FROM IT_PROGRAM WHERE ID = '$id'";
			return $this->db->query($sql);
		}
		public function getPegawai($search)
		{
			$sql = "SELECT nik, namapeg FROM tbPegawai WHERE nik LIKE '%$search%' OR namapeg LIKE '%$search%'";
			return $this->db->query($sql);
		}
		public function prosesLogin($nik, $password)
		{
			$sql = "SELECT NIK, PASSWORD, LVL, STATUS, NAMA FROM IT_USER WHERE NIK = '$nik' AND PASSWORD = '$password'";
			return $this->db->query($sql);
		}
		public function getMeetingPeriodical()
		{
			$sql = "SELECT * FROM IT_PERIODICAL_MEETING ORDER BY TGL_INPUT DESC";
			return $this->db->query($sql);
		}
		public function saveDataMeetingPeriodical($id, $name)
		{
			date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d H:i:s');
            $nik = $this->session->userdata("nik");
			$sql = "INSERT INTO IT_PERIODICAL_MEETING(ID, NAME_MEETING, PIC_INPUT, TGL_INPUT)VALUES('$id','$name','$nik','$tanggal')";
			return $this->db->query($sql);
		}
		public function updateDataMeetingPeriodical($id, $name)
		{
			$sql = "UPDATE IT_PERIODICAL_MEETING SET NAME_MEETING = '$name' WHERE ID = $id";
			return $this->db->query($sql);
		}
	}
?>