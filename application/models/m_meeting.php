<?php
	class M_Meeting extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function getMeetingNo($value='')
		{
			$tahun = date('Y');
	        $bulan = date('m');
	        $gabung = 'Meeting/'.$tahun.'/'.$bulan.'/';
	        $cekNoDoc=$this->db->query("SELECT MAX(RIGHT(MEETING_NO,2)) AS MAX_NO FROM IT_MEETING");
	            foreach ($cekNoDoc->result() as $data) {
	                if ($data->MAX_NO =="") {
	                    $docNo = $gabung."01";
	                }else{
	                    $zero='';
	                    $length= 2;
	                    $index=$data->MAX_NO;

	                    for ($i=0; $i <$length-strlen($index+1) ; $i++) { 
	                        $zero = $zero.'0';
	                    }
	                    $docNo = $gabung.$zero.($index+1);
	                }
	                
	            }
	        
	        return $docNo;
		}
		public function saveDraftMeeting($id, $no, $date, $name, $hour, $pic, $category, $inputRoom)
		{
			date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d H:i:s');
			$sql = "INSERT INTO IT_MEETING(ID, MEETING_NO, MEETING_DATE, MEETING_NAME, START_HOUR, MEETING_PIC, CATEGORY, STATUS, ROOM, TGL_INPUT)VALUES('$id','$no','$date','$name','$hour','$pic','$category','DRAFT', '$inputRoom','$tanggal')";
			return $this->db->query($sql);
		}
		public function saveTask($meetingID, $staff, $program, $deskripsi, $objek, $plan, $picApprove, $pic, $date, $id, $revisi, $new, $urgent)
		{
			$sql = "INSERT INTO IT_JOB_ORDER(ID, STAFF_ID, PROGRAM_ID, REQUEST_DATE, REQUEST_PIC, SOURCE, SOURCE_ID, DESKRIPSI, OBJEK, PLAN_DATE, APPROVE_PIC, STATUS, REVISI, NEW, URGENT)VALUES('$id','$staff','$program','$date','$pic','MEETING','$meetingID','$deskripsi','$objek','$plan','$picApprove','DRAFT','$revisi','$new','$urgent')";
			return $this->db->query($sql);
		}
		public function getTaskMeeting($id, $status)
		{
			$sql = "SELECT
						a.ID,
						a.STAFF_ID,
						b.NAMA,
						a.PROGRAM_ID,
						c.NAME_PROGRAM,
						a.DESKRIPSI,
						a.OBJEK,
						a.PLAN_DATE,
						a.APPROVE_PIC,
						a.REVISI,
						a.NEW,
						a.STATUS_JOB_ORDER,
						a.URGENT,
						a.ERROR
					FROM
						IT_JOB_ORDER a
					INNER JOIN
						IT_STAFF b ON
					a.STAFF_ID = b.ID
					INNER JOIN 
						IT_PROGRAM c ON
					a.PROGRAM_ID = c.ID
					WHERE
						a.SOURCE = 'MEETING' AND
						a.SOURCE_ID = '$id' AND
						a.STATUS = '$status'";
			return $this->db->query($sql);
		}
		public function hapusTask($id)
		{
			$sql = "DELETE FROM IT_JOB_ORDER WHERE ID = '$id'";
			return $this->db->query($sql);
		}
		public function getDataMeeting($whereId)
		{
			$sql = "SELECT
						Q1.*,
						Q2.JML,
						Q3.JML_CLOSE
					FROM
					(
						SELECT
							ID,
							MEETING_NO,
							MEETING_DATE,
							MEETING_NAME,
							CATEGORY,
							MEETING_PIC,
							ROOM,
							`STATUS`,
							MOM,
							START_HOUR,
							PIC_INPUT,
							TGL_INPUT,
							FINISH_HOUR 
						FROM
							IT_MEETING
						$whereId
					)Q1
					LEFT JOIN
					(
						SELECT
							COUNT(SOURCE_ID) AS JML,
							SOURCE_ID
						FROM
							IT_JOB_ORDER
						WHERE
							SOURCE = 'MEETING' AND
							`STATUS` = 'SAVED' 
						GROUP BY SOURCE_ID
					)Q2 ON Q1.ID = Q2.SOURCE_ID
					LEFT JOIN
					(
						SELECT
							COUNT(SOURCE_ID) AS JML_CLOSE,
							SOURCE_ID
						FROM
							IT_JOB_ORDER
						WHERE
							SOURCE = 'MEETING' AND
							STATUS_JOB_ORDER = 'Close' 
						GROUP BY SOURCE_ID
					)Q3 ON Q1.ID = Q3.SOURCE_ID
					ORDER BY
						MEETING_DATE DESC";
			return $this->db->query($sql);
		}
		public function updateMeeting($inputMeetingName, $inputPIC, $inputRoom, $inputCategory, $inputMoM, $inputId)
		{
			date_default_timezone_set('Asia/Jakarta');
            $jam = date('H:i:s');
			$sql = "UPDATE IT_MEETING SET MEETING_NAME='$inputMeetingName', MEETING_PIC='$inputPIC', ROOM='$inputRoom', CATEGORY='$inputCategory', MOM = '$inputMoM', STATUS = 'SAVED', FINISH_HOUR='$jam' WHERE ID = '$inputId'";
			return $this->db->query($sql);
		}
		public function getAttendeById($id)
		{
			$sql = "SELECT
						a.NIK,
						b.namapeg
					FROM
						IT_ATTENDE_MEETING a
					INNER JOIN
						tbpegawai b ON
					a.NIK = b.nik
					WHERE
						a.MEETING_ID = '$id'
					ORDER BY b.nik ASC";
			return $this->db->query($sql);
		}
	}
?>