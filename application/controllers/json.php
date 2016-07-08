<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends MY_Controller {
	
    public function __construct() {
        parent::__construct();

        $this->load->model("reporting_model");
    }

	public function index($renderData=""){

		$renderData = 'JSON';
        
		$this->_render('',$renderData);
	}

    public function company_employees($renderData=""){

        $renderData = 'JSON';

        if ($this->input->post('company_id')) {
            $this->data['employees'] = $this->reporting_model->company_employees($this->input->post('company_id'))->result_array();
        }
        
        $this->_render('',$renderData);
    }

    public function country_companies($renderData=""){

        $renderData = 'JSON';

        if ($this->input->post('geo_zone_id')) {
            $this->data['companies'] = $this->reporting_model->country_companies($this->input->post('geo_zone_id'))->result_array();
        }
        
        $this->_render('',$renderData);
    }
	
}