<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Order extends CI_Controller {
	function __construct(){
		parent::__construct();
		// $this->load->library('uuid');
		$this->load->model('M_Master');
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
		$data['side'] = 'job_order';
		$data['page'] = 'Job Order';
		$data['staff'] = $this->M_Master->getStaffIT('')->result();
		$this->load->view("job_order/index", $data);
	}
	public function getListJobOrder()
	{
		$filStaff= $this->input->get("filStaff");
		$filSearch = $this->input->get("filSearch");
		$data['data'] = $this->M_Job_Order->getDataJobOrder(" AND STATUS_JOB_ORDER NOT IN ('Waiting Confirmation')", $filStaff, $filSearch,'')->result();
		$this->load->view("job_order/tabel", $data);
	}
	public function getProgress()
	{
		$id = $this->input->get("id");
		$data['data'] = $this->M_Job_Order->getProgress($id)->result();
		$this->load->view("job_order/progress", $data);
	}
}
