<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporting extends MY_Controller {
	
    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->model("reporting_model");

        if ($this->session->userdata('site_lang')) {
            $this->lang->load('reporting', $this->session->userdata('site_lang'));
        } else {
            $this->lang->load('reporting', 'english');
        }
    }

	public function index($renderData=""){

		$this->title = lang('text_title');

        $this->data['message'] = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : NULL;

        if ($this->ion_auth->is_admin()) {
            $this->data['countries'] = $this->reporting_model->countries()->result_array();

            // $this->data['companies'] = $this->reporting_model->companies()->result_array();

            // $this->data['statuses'] = $this->reporting_model->statuses()->result_array();
        }
        else {

            $company = $this->reporting_model->companies($this->session->userdata('company_id'))->row();

            $this->data['country'] = $this->reporting_model->countries($company->geo_zone_id)->row();

            $this->data['company'] = $company;

            $this->data['employees'] = $this->reporting_model->company_employees($company->company_id)->result_array();

            $this->data['statuses'] = $this->reporting_model->statuses()->result_array();
        }

        

        $this->data['from_date'] = array(
                'name'  => 'from_date',
                'id'    => 'from_date',
                'class' => 'form-control date-picker',
                'type'  => 'text',
                'readonly' => TRUE,
                'value' => $this->form_validation->set_value('from_date'),
        );
        $this->data['to_date'] = array(
                'name'  => 'to_date',
                'id'    => 'to_date',
                'class' => 'form-control ',
                'type'  => 'text',
                'readonly' => TRUE,
                'value' => $this->form_validation->set_value('to_date'),
        );

        $this->data['export_report'] = array(
            'name'  => 'submit',
            'id' => 'submit',
            'value' => lang('btn_export_report'),
            'class' => 'btn btn-lg btn-primary',
            'type'  => 'submit',
        );
        
		$this->_render('pages/reporting',$renderData);
	}

    public function export_csv() {

        if ($this->input->post('submit')) {
            $geo_zone_id = ($this->input->post('geo_zone_id')) ? $this->input->post('geo_zone_id'): NULL;
            $company_id = ($this->input->post('company_id')) ? $this->input->post('company_id'): NULL;
            $user_id = ($this->input->post('user_id')) ? $this->input->post('user_id'): NULL;
            $from_date = ($this->input->post('from_date')) ? $this->input->post('from_date'): NULL;
            $to_date = ($this->input->post('to_date')) ? $this->input->post('to_date'): NULL;
            $feedback_id = ($this->input->post('feedback_id')) ? $this->input->post('feedback_id'): NULL;

            $this->reporting_model->csv($geo_zone_id, $company_id, $user_id, $from_date, $to_date, $feedback_id);
        }
        else {
            redirect('reporting', 'refresh');
        }
    }
	
}