<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->load->helper('url');
    }
 
    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }
}