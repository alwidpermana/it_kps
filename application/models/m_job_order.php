<?php
	class M_Job_Order extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function getDataJobOrder($where, $staff, $search, $source)
		{
			$sql = "SELECT
						*
					FROM
					(
						SELECT
							a.*,
							b.NAMA,
							c.NAME_PROGRAM
						FROM
							IT_JOB_ORDER a
						INNER JOIN
							IT_STAFF b ON
						a.STAFF_ID = b.ID
						INNER JOIN
							IT_PROGRAM c ON
						a.PROGRAM_ID = c.ID
						WHERE
							SOURCE LIKE '%$source%' AND
							a.STAFF_ID LIKE '%$staff%'
							$where
					)Q1
					ORDER BY TGL_INPUT DESC";
			return $this->db->query($sql);
		}
		public function getProgress($id)
		{
			$sql = "SELECT
						* 
					FROM
						`it_progress`
					WHERE
						JOB_ORDER_ID ='$id'";
			return $this->db->query($sql);
		}
	}
?>