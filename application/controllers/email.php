<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends MY_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        if ($this->session->userdata('site_lang')) {
            $this->lang->load('email', $this->session->userdata('site_lang'));
        } else {
            $this->lang->load('email', 'english');
        }
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model("email_model");
        date_default_timezone_set($this->config->item('site_timezone'));
    }
	
	public function index($renderData=""){	
         
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        redirect('/', 'refresh');
		
        // 1. when you pass AJAX to renderData it will generate only that particular PAGE skipping other parts like header, nav bar,etc.,
        //      this can be used for AJAX Responses
        // 2. when you pass JSON , then the response will be json object of $this->data.  This can be used for JSON Responses to AJAX Calls.
        // 3. By default full page will be rendered
        
		$this->_render('pages/send',$renderData);
	}

    public function create($renderData="") {

        $this->title = lang('text_title');

        $this->prepare_rules();

        if ($this->form_validation->run() == true) {

            $template_id = $this->input->post('template');
            $company = $this->input->post('company');
            $customer_name = $this->input->post('customer_name');
            $email = strtolower($this->input->post('email'));
            $reference = $this->input->post('reference');

            if ($this->input->post('save')) {
                
                $inserted_id = $this->email_model->save($template_id, $company, $customer_name, $email, $reference, $this->session->userdata('user_id'));

                if ($inserted_id) {
                    $this->session->set_flashdata('successful_message', lang('msg_email_saved'));

                    redirect("email/draft/" . $inserted_id, 'refresh');
                }
                
            }
            if ($this->input->post('preview')) {

                $data = array(
                    'email_preview' => TRUE,
                    'template_id' => $template_id,
                    'company' => $company,
                    'customer_name' => $customer_name,
                    'email_addr' => $email,
                    'reference' => $reference,
                    'new_email' => TRUE
                );

                $this->session->set_userdata($data);

                redirect("email/preview/", 'refresh');
            }
        } 
        else {

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->data['language'] = '';

        $this->prepare_inputs();

        $this->_render('pages/email_page',$renderData);
    }

    public function draft($renderData="") {

        if (!$this->uri->segment(3)) {
            redirect('/', 'refresh');
        }

        $this->title = lang('text_title_draft');

        $this->prepare_rules();

        if ($this->form_validation->run() == true) {

            $template_id = $this->input->post('template');
            $company = $this->input->post('company');
            $customer_name = $this->input->post('customer_name');
            $email = strtolower($this->input->post('email'));
            $reference = $this->input->post('reference');

            if ($this->input->post('save')) {

                if ($this->email_model->update($template_id, $company, $customer_name, $email, $reference, $this->config->item('email_status_draft'), $this->uri->segment(3))) {
                    $this->session->set_flashdata('successful_message', lang('msg_email_saved'));

                    redirect("email/draft/" . $this->uri->segment(3), 'refresh');
                }
                
            }
            if ($this->input->post('preview')) {
                $data = array(
                    'email_preview' => TRUE,
                    'email_id' => $this->uri->segment(3),
                    'template_id' => $template_id,
                    'company' => $company,
                    'customer_name' => $customer_name,
                    'email_addr' => $email,
                    'reference' => $reference,
                );

                $this->session->set_userdata($data);

                redirect("email/preview/", 'refresh');
                // redirect("email/preview/" . $this->uri->segment(3), 'refresh');
            }
        } 
        else {

            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $emailObj = $this->email_model->email($this->uri->segment(3))->row();

        $this->data['language'] = $emailObj->language;

        $this->prepare_inputs($emailObj);

        if ($this->session->flashdata('successful_message')) {
            $this->data['successful_message'] = $this->session->flashdata('successful_message');
        }

        $this->_render('pages/email_page',$renderData);
    }

    public function sent($renderData="") {

        if (!$this->uri->segment(3)) {
            redirect('/', 'refresh');
        }

        $this->title = lang('text_title_sent');
        $this->css = array('jquery.fancybox.css');
        $this->javascript = array('jquery.fancybox.pack.js');

        $emailObj = $this->email_model->email($this->uri->segment(3))->row();

        $this->load->model('file_model');
        $filesArray = $this->file_model->files($this->uri->segment(3))->result_array();

        $this->data['files'] = $filesArray;
        $this->data['language'] = $emailObj->language;
        $this->data['email_sent'] = TRUE;
        $this->data['feeback_comment'] = $emailObj->feedback_comment;

        $this->prepare_inputs($emailObj);

        $this->_render('pages/email_page',$renderData);
    }

    public function preview($renderData="") {

        if ($this->session->userdata('email_preview')) {
            $template_id = $this->session->userdata('template_id');
            $company = $this->session->userdata('company');
            $customer_name = $this->session->userdata('customer_name');
            $email_addr = $this->session->userdata('email_addr');
            $reference = $this->session->userdata('reference');
        } 
        else {
            redirect('/', 'refresh');
        }

        $this->load->helper('html');

        $this->title = lang('text_title_preview');        

        // build email content
        $companyObj = $this->email_model->companies($this->session->userdata('company_id'))->row();

        $image_properties = array(
          'src' => IMAGES.'company-logos/'. $companyObj->logo .'.png',
          'alt' => $companyObj->name,
          'width' => '150',
          'title' => $companyObj->name,
        );
        $this->data['company_logo'] = img($image_properties);

        if ($companyObj->website) {
            $this->data['company_link'] = anchor('http://'.$companyObj->website, $companyObj->name);
        }

        $this->data['user_name'] = $this->session->userdata('username');

        $this->data['customer_name'] = $customer_name;
        $this->data['reference'] = $reference;
        $image_properties = array(
          'src' => IMAGES.'satisfied_'.$template_id.'.png',
          'alt' => 'I am satisfied',
          'title' => 'I am satisfied',
        );
        $this->data['img_satisfied'] = $image_properties;
        $image_properties = array(
          'src' => IMAGES.'dobetter_'.$template_id.'.png',
          'alt' => 'You can do better',
          'title' => 'You can do better',
        );
        $this->data['img_better'] = $image_properties;
        $image_properties = array(
          'src' => IMAGES.'email_bar.png',
          'alt' => 'Energy saving week Logo',
          'title' => 'Energy saving week Logo',
        );
        $this->data['img_energysavingweek'] = $image_properties;
        
        $this->data['template_file'] = 'email_templates/'. $template_id;

        $this->_render('pages/preview_email', $renderData);
    }

    public function send() {

        if ($this->session->userdata('email_preview')) {
            $template_id = $this->session->userdata('template_id');
            $company = $this->session->userdata('company');
            $customer_name = $this->session->userdata('customer_name');
            $email_addr = $this->session->userdata('email_addr');
            $reference = $this->session->userdata('reference');

            if ($this->session->userdata('new_email')) {
                
            }
            if ($this->session->userdata('email_id')) {
                $email_id = $this->session->userdata('email_id');
            }
            else {
                $email_id = $this->email_model->save($template_id, $company, $customer_name, $email_addr, $reference, $this->session->userdata('user_id'));
            }

            //$emailObj = $this->email_model->email($email_id)->row();
            
        }
        else {
            redirect('/', 'refresh');
        }

        $user_id = $this->session->userdata('user_id');

        $ci = get_instance();
        $ci->load->library('email');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = ''; // google ssl://smtp.gmail.com
        $config['smtp_user'] = ''; // account
        $config['smtp_pass'] = ''; // password
        $config['smtp_port'] = 465; // port
        $config['smtp_timeout'] = 10;
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $config['charset'] = 'utf-8'; // iso-8859-1
        $config['crlf'] = "\r\n";
        $ci->email->initialize($config);
        

        $ci->email->from($this->session->userdata('email'), $this->session->userdata('username'));

        $ci->email->to($email_addr);
        
        $this->load->library('encrypt');
        $this->load->helper('html');

        // build email content
        $companyObj = $this->email_model->companies($this->session->userdata('company_id'))->row();

        $image_properties = array(
          'src' => IMAGES.'company-logos/'. $companyObj->logo .'.png',
          'alt' => $companyObj->name,
          'width' => '150',
          'title' => $companyObj->name,
        );
        $data['company_logo'] = img($image_properties);

        if ($companyObj->website) {
            $data['company_link'] = anchor('http://'.$companyObj->website, $companyObj->name);
        }

        $data['user_name'] = $this->session->userdata('username');

        $data['customer_name'] = $customer_name;
        $data['reference'] = $reference;

        $encoded = $this->encrypt->encode($email_id);
        $data['encoded_id'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $encoded);
        $encoded = $this->encrypt->encode($this->config->item('email_feedback_like'));
        $data['encoded_like'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $encoded);
        $encoded = $this->encrypt->encode($this->config->item('email_feedback_better'));
        $data['encoded_better'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $encoded);
        $encoded = $this->encrypt->encode($template_id);
        $data['encoded_language'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $encoded);
        $encoded = $this->encrypt->encode($companyObj->logo);
        $data['encoded_logo'] = str_replace(array('+', '/', '='), array('-', '_', '~'), $encoded);

        $image_properties = array(
          'src' => IMAGES.'satisfied_'.$template_id.'.png',
          'alt' => 'I am satisfied',
          'title' => 'I am satisfied',
        );
        $data['img_satisfied'] = $image_properties;
        $image_properties = array(
          'src' => IMAGES.'dobetter_'.$template_id.'.png',
          'alt' => 'You can do better',
          'title' => 'You can do better',
        );
        $data['img_better'] = $image_properties;
        $image_properties = array(
          'src' => IMAGES.'email_bar.png',
          'alt' => 'Energy saving week Logo',
          'title' => 'Energy saving week Logo',
        );
        $data['img_energysavingweek'] = $image_properties;
        $data['language'] = $template_id;
        
        $message = $this->load->view('email_templates/email.tpl.php', $data, true);


// exit(sprintf(lang('msg_email_subject_'.$template_id), $companyObj->name));
// exit($message);
        $ci->email->subject(sprintf(lang('msg_email_subject_'.$template_id), $companyObj->name));
        $ci->email->message($message);

        if($ci->email->send()) {
            $this->session->set_flashdata('successful_message', lang('msg_email_sent'));

            $now = date('Y-m-d H:i:s');

            $this->email_model->update($template_id, $company, $customer_name, $email_addr, $reference, $this->config->item('email_status_sent'), $email_id, $now);

            $unset_items = array(
                'new_email_preview' => FALSE,
                'template_id' => '',
                'company' => '',
                'customer_name' => '',
                'email_addr' => '',
                'reference' => '',
                'email_id' => '',
            );
            $this->session->unset_userdata($unset_items);

            redirect('/', 'refresh');
// show_error($this->email->print_debugger());
        }
        else {
            $this->session->set_flashdata('error_message', lang('msg_email_sent_error'));
            $this->data['message'] = $this->session->flashdata('error_message');
            // need fixing
            redirect('email/preview/', 'refresh');
// show_error($this->email->print_debugger());
        }

    }

    protected function prepare_rules() {
        //validate form input
        $this->form_validation->set_rules('template', lang('text_template'), 'required');
        $this->form_validation->set_rules('company', lang('label_company'), 'required');
        $this->form_validation->set_rules('customer_name', lang('label_customer_name'), 'required');
        $this->form_validation->set_rules('email', lang('label_email_address'), 'required|valid_email');
        $this->form_validation->set_rules('reference', lang('label_reference'), 'required');
    }

    protected function prepare_inputs($email = NULL) {

        $data = $this->email_model->user_companies($this->session->userdata('user_id'), 1)->row();

        $this->data['company_language'] = $data->language;

        // edit email
        if ($email) {
            
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'class' => 'form-control',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('company', $email->company),
            );

            $this->data['customer_name'] = array(
                'name'  => 'customer_name',
                'id'    => 'customer_name',
                'class' => 'form-control',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('customer_name', $email->customer_name),
            );

            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'class' => 'form-control',
                'type'  => 'email',
                'value' => $this->form_validation->set_value('email', $email->email),
            );

            $this->data['reference'] = array(
                'name'  => 'reference',
                'id'    => 'reference',
                'class' => 'form-control',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('reference', $email->reference),
            );
        }   // create email
        else {
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'class' => 'form-control',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('company'),
            );

            $this->data['customer_name'] = array(
                'name'  => 'customer_name',
                'id'    => 'customer_name',
                'class' => 'form-control',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('customer_name'),
            );

            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'class' => 'form-control',
                'type'  => 'email',
                'value' => $this->form_validation->set_value('email'),
            );

            $this->data['reference'] = array(
                'name'  => 'reference',
                'id'    => 'reference',
                'class' => 'form-control',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('reference'),
            );
        }

        $this->data['btn_save'] = array(
            'name'  => 'save',
            'id' => 'btn_save',
            'value' => lang('button_save'),
            'class' => 'btn btn-primary',
            'type'  => 'submit',
        );

        $this->data['btn_preview'] = array(
            'name'  => 'preview',
            'id' => 'btn_preview',
            'value' => lang('button_preview'),
            'class' => 'btn btn-info',
            'type'  => 'submit',
        );

        
    }
	
}