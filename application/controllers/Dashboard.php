<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		// $this->load->library('uuid');
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
		$data['side'] = 'dashboard';
		$data['page'] = 'Dashboard';
		$this->load->view('dashboard/index', $data);
	}
	public function proses_login()
	{
		$inputLoginNIK = $this->input->post("inputLoginNIK");
		$inputLoginPassword = $this->input->post("inputLoginPassword");
		$field = '';
		$alert = '';
		$status = '';
		$html='';
		if ($inputLoginNIK == '') {
			$status = 'warning';
			$field = '#inputLoginNIK';
			$alert = '<div class="alert alert-primary" role="alert">NIK Belum Diisi</div>';
		}elseif ($inputLoginPassword == '') {
			$status = 'warning';
			$field = '#inputLoginPassword';
			$alert = '<div class="alert alert-primary" role="alert">Password Belum Diisi!</div>';
		}else{
			$data = $this->M_Master->prosesLogin($inputLoginNIK, $inputLoginPassword);
			if ($data->num_rows()>0) {
				$status = 'success';
				$dataUser = $data->row();
				$data_session = array(
					'NIK' => $dataUser->NIK,
					'NAMA'=> $dataUser->NAMA,
					'STATUS'=>$dataUser->STATUS,
					'sesi' => true
					);
	 
				$this->session->set_userdata($data_session);
			}else{
				$status='warning';
				$html = '<div class="alert alert-primary" role="alert">Akun Tidak Ditemukan</div>';
			}
		}
		$response = array('status' =>$status ,'field'=>$field, 'alert'=>$alert, 'html'=>$html);
		echo json_encode($response);
	}
	public function logout($value='')
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function running_exe()
	{
		shell_exec('schtasks/ create /sc minute /tn "xampp" /tr "C:/xampp/xampp-control.exe"');
		shell_exec('schtasks/ run /tn "xampp"');
		shell_exec('schtasks /delete /tn "xampp" /F');
	}
}
