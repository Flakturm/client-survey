<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    protected $page;

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->load->model("dashboard_model");
        $this->load->library('pagination');

        if ($this->session->userdata('site_lang')) {
            $this->lang->load('dashboard', $this->session->userdata('site_lang'));
        } else {
            $this->lang->load('dashboard', 'english');
        }
    }
	
	public function index($renderData="") {        

		$this->title = lang('text_title');

        $this->javascript = array('sorttable.js');
		
        $config['base_url'] = base_url() . 'dashboard/';
        $config['total_rows'] = $this->dashboard_model->get_count();

        $this->pagination->initialize($config);

        $this->data['emails'] = $this->dashboard_model->get_emails($this->pagination->per_page, $this->uri->segment(2), $this->session->userdata('user_id'));

        $this->data['message'] = NULL;
        if ($this->session->flashdata('successful_message')) {
            $this->data['message'] = $this->session->flashdata('successful_message');
        }
        elseif ($this->session->flashdata('message')) {
            $this->data['message'] = $this->session->flashdata('message');
        }
        
		$this->_render('pages/dashboard', $renderData);
	}
	
}