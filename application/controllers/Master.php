<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('uuid');
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
	public function staff()
	{
		$data['side'] = 'master-staff';
		$data['page'] = 'Master - Staff IT';
		$this->load->view('master/staff/index', $data);
	}
	public function saveDataStaffIT()
	{
		$config['upload_path']="./assets/arsip/master-staff";
        $config['allowed_types']='jpg|png|jpeg';
        $config['encrypt_name'] = FALSE;
         
        $this->load->library('upload',$config);
	    if($this->upload->do_upload("inputFile")){
	        $data = $this->upload->data();

	        //Resize and Compress Image
            // $config['image_library']='gd2';
            $config['source_image']='./assets/arsip/master-staff/'.$data['file_name'];
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
	    $inputNIK = $this->input->post("inputNIK");
	    $inputNama = $this->input->post("inputNama");
	    $inputEmail = $this->input->post("inputEmail");
	    $inputNoHP = $this->input->post("inputNoHP");
	    $inputId = $this->input->post("inputId");
	    $inputStatus = $this->input->post("inputStatus");
	    if ($inputId == '') {
	    	$id = $this->uuid->v4();
	    	$data = $this->M_Master->saveDataStaffIT($id, $inputNIK, $inputNama, $inputEmail, $inputNoHP, $inputStatus);	
	    }else{
	    	$id = $inputId;
	    	$data = $this->M_Master->updateDataStaffIT($id, $inputNIK, $inputNama, $inputEmail, $inputNoHP, $inputStatus);
	    }

	    if ($data == true && $fileName != '') {
	    	$this->db->query("UPDATE it_staff SET FOTO = '$fileName' WHERE ID = '$id'");
	    }
        
        echo json_encode($data);
	}
	public function getStaff()
	{
		$data['data'] = $this->M_Master->getStaffIT('')->result();
		$this->load->view("master/staff/tabel", $data);
	}
	public function getStaffById()
	{
		$id = $this->input->get("id");
		$where = " WHERE ID = '$id'";
		$data = $this->M_Master->getStaffIT($where)->row();
		echo json_encode($data);
	}
	public function staff_detail($id)
	{
		$data['side'] = 'staff';
		$data['page'] = 'Staff Detail';
		$where = "WHERE ID = '$id'";
		$data['data'] = $this->M_Master->getStaffIT($where)->row();
		$this->load->view("master/staff/detail", $data);
	}
	public function application()
	{
		$data['side'] = 'master-application';
		$data['page'] = 'Master - Application';
		$this->load->view("master/application/index", $data);
	}
	public function getStaffForApplication()
	{
		$staffId = $this->input->get("staffId");
		$data = $this->M_Master->getStaffIT('');
		if ($data->num_rows()>0) {
			$html='';
			foreach ($data->result() as $key) {
				$selected = $staffId == $key->ID ? 'selected':'';
				$html.='<option value="'.$key->ID.'">'.$key->NAMA.'</option>';	
			}
		}else{
			$html = '';
		}
		echo json_encode($html);
	}
	public function saveProgram()
	{
		$config['upload_path']="./assets/arsip/program";
        $config['allowed_types']='jpg|png|jpeg';
        $config['encrypt_name'] = FALSE;
         
        $this->load->library('upload',$config);
	    if($this->upload->do_upload("inputFile")){
	        $data = $this->upload->data();

	        //Resize and Compress Image
            // $config['image_library']='gd2';
            $config['source_image']='./assets/arsip/program/'.$data['file_name'];
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
	    $inputType = $this->input->post("inputType");
	    $link = $inputType == 'Web Base'?'http://192.168.0.213:8080/':'assets/arsip/program-desktop/';
	    $inputLink = $link.''.$this->input->post("inputLink");
	    $inputNama = $this->input->post("inputNama");
	    $inputStaff = $this->input->post("inputStaff");
	    $inputId = $this->input->post("inputId");
	    if ($inputId == '') {
	    	$id = $this->uuid->v4();
	    	$data = $this->M_Master->saveDataProgram($id, $inputType, $inputLink, $inputNama, $inputStaff);	
	    }else{
	    	$id = $inputId;
	    	$data = $this->M_Master->updateDataProgram($id, $inputType, $inputLink, $inputNama, $inputStaff);
	    }

	    if ($data == true && $fileName != '') {
	    	$this->db->query("UPDATE IT_PROGRAM SET GAMBAR = '$fileName' WHERE ID = '$id'");
	    }
        
        echo json_encode($data);
	}
	public function getProgram()
	{
		$data['data'] = $this->M_Master->getProgram('')->result();
		$this->load->view("master/application/tabel", $data);
	}
	public function getProgramById($value='')
	{
		$id = $this->input->get("id");
		$where = " WHERE a.ID = '$id'";
		$data = $this->M_Master->getProgram($where)->row();
		echo json_encode($data);
	}
	public function deleteProgram()
	{
		$id = $this->input->post("id");
		$data = $this->M_Master->deleteProgram($id);
		echo json_encode($data);
	}
	public function download_file()
	{
		 $this->load->helper(array('url','download'));  
		force_download('assets/arsip/program/SpotifySetup.exe',NULL);
	}
	public function periodical()
	{
		$data['side'] = 'master-periodical';
		$data['page'] = 'Master - Periodical Meeting';
		$this->load->view("master/periodical/index", $data);
	}
	public function getMeetingPeriodical($value='')
	{
		$data['data'] = $this->M_Master->getMeetingPeriodical()->result();
		$this->load->view("master/periodical/tabel", $data);
	}
	public function saveDataMeetingPeriodical()
	{
		$inputNama = $this->input->post("inputNama");
		$inputId = $this->input->post("inputId");
		if ($inputId == '') {
			$id = $this->uuid->v4();
			$data = $this->M_Master->saveDataMeetingPeriodical($id, $inputNama);
		}else{
			$data = $this->M_Master->updateDataMeetingPeriodical($inputId, $inputNama);
		}
		echo json_encode($data);
		
	}
}
