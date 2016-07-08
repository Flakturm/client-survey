<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        if ($this->session->userdata('site_lang')) {
            $this->lang->load('profile', $this->session->userdata('site_lang'));
        } else {
            $this->lang->load('profile', 'english');
        }
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->model("ion_auth_model");
    }

    //edit user
    function index($renderData="")
    {
        $this->title = lang('text_title');

        $id = $this->session->userdata('user_id');
        $user = $this->ion_auth->user($id)->row();

        if (isset($_POST) && !empty($_POST))
        {

            //update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', lang('label_password'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', lang('label_password_confirm'), 'required');
            }

            if ($this->form_validation->run() === TRUE)
            {

                //update the password if it was posted
                if ($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }

                //check to see if we are updating the user
                if($this->ion_auth->update($user->id, $data))
                {
                    //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages() );
                    redirect('/', 'refresh');
                }

                

            }
        }

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['user'] = $user;

        $companyObj = $this->ion_auth_model->company($user->company);

        $this->data['first_name'] = array(
            'name'  => 'first_name',
            'id'    => 'first_name',
            'class' => 'form-control',
            'disabled' => 1,
            'type'  => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name'  => 'last_name',
            'id'    => 'last_name',
            'class' => 'form-control',
            'disabled' => 1,
            'type'  => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['email_address'] = array(
            'name'  => 'email_address',
            'id'    => 'email_address',
            'class' => 'form-control',
            'disabled' => 1,
            'type'  => 'email',
            'value' => $this->form_validation->set_value('email_address', $user->email),
        );
        $this->data['company'] = array(
            'name'  => 'company',
            'id'    => 'company',
            'class' => 'form-control',
            'disabled' => 1,
            'type'  => 'text',
            'value' => $this->form_validation->set_value('company', $companyObj->name),
        );
        $this->data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'class' => 'form-control',
            'disabled' => 1,
            'type'  => 'phone',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id'   => 'password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id'   => 'password_confirm',
            'class' => 'form-control',
            'type' => 'password'
        );

        $this->data['btn_save'] = array(
            'name'  => 'save',
            'id' => 'btn_save',
            'value' => lang('button_save'),
            'class' => 'btn btn-primary',
            'type'  => 'submit',
        );

        $this->_render('pages/profile', $renderData);
    }
	
}