<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vote extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->model('vote_model');
    }

    public function to(){

        $encoded = $this->uri->segment(3);
        $decoded = str_replace(array('-', '_', '~'), array('+', '/', '='), $encoded);
        $email_id = $this->encrypt->decode($decoded);

        $encoded = $this->uri->segment(4);
        $decoded = str_replace(array('-', '_', '~'), array('+', '/', '='), $encoded);
        $feedback = $this->encrypt->decode($decoded);

        $encoded = $this->uri->segment(5);
        $decoded = str_replace(array('-', '_', '~'), array('+', '/', '='), $encoded);
        $language = $this->encrypt->decode($decoded);

        // check if feedback has been posted
        if ($this->vote_model->feedback_check($email_id)) {
            // $this->session->set_userdata('show_thankyou', TRUE);
            // $this->session->set_userdata('feedback_show_form', FALSE);
            redirect('thankyou/'.$this->uri->segment(3).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6), 'refresh');
        }

        if ($this->vote_model->update($feedback, $email_id)) {
            $this->session->set_userdata('feedback_email_id', $this->uri->segment(3));
            $this->session->set_userdata('feedback_language', $this->uri->segment(5));
            $this->session->set_userdata('feedback_logo', $this->uri->segment(6));
            $this->session->set_userdata('feedback_show_form', TRUE);
            redirect('thankyou/'.$this->uri->segment(3).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6), 'refresh');
        }
        else {
            $this->session->set_userdata('feedback_show_form', FALSE);
            $this->session->set_userdata('show_thankyou', TRUE);
            redirect('thankyou/'.$this->uri->segment(3).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6), 'refresh');
        }
        
    }
	
}