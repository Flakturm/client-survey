<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thankyou extends CI_Controller {

    private $error;
    private $success;

    public function __construct() {
         parent::__construct();
         $this->load->library(array('form_validation', 'encrypt'));
         $this->load->model(array('vote_model'));
         $this->load->helper('form');
    }
	
	public function index($renderData=""){	

        $email_id = $this->decode_var($this->uri->segment(2));
        $language = $this->decode_var($this->uri->segment(3));
        $logo_name = $this->decode_var($this->uri->segment(4));

        $this->lang->load('thankyou', $language);

        $data['show_form'] = FALSE;

        if (!$this->vote_model->feedback_comment_check($email_id)) {
            $data['show_form'] = TRUE;
        }

        if ($this->session->flashdata('success')) {
            $data['success'] = $this->session->flashdata('success');
        }

        if ($this->session->flashdata('errors')) {
            $data['errors'] = $this->session->flashdata('errors');
        }

        // $this->form_validation->set_rules('feedback_comment', lang('text_comment'), 'required');
        //now we set a callback as rule for the upload field
        // $this->form_validation->set_rules('files[]','Upload files','callback_fileupload_check');
    

        if ($this->input->post('send')) {
            
            $this->load->model(array('email_model', 'file_model'));

            $file_is_done = FALSE;
            $comment_is_done = FALSE;

            if ($_FILES) {
                //file upload destination
                $config['upload_path'] = UPLOAD;
                $config['allowed_types'] = 'gif|jpg|jpeg|png|mp4|mov';
                $config['max_size'] = '10240';  // 10MB
                $config['max_filename'] = '255';
                $config['encrypt_name'] = TRUE;

                //upload file
                $i = 0;
                $files = array();
                $is_file_error = FALSE;

                // we retrieve the number of files that were uploaded
                $count = count($_FILES['userfile']['size']);
                if ($_FILES['userfile']['error'][0] == 0) {
                    foreach($_FILES as $key => $value) {
                        for($i = 0; $i <= $count-1; $i++) {
                            $_FILES['userfile']['name']=$value['name'][$i];
                            $_FILES['userfile']['type']    = $value['type'][$i];
                            $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$i];
                            $_FILES['userfile']['error']       = $value['error'][$i];
                            $_FILES['userfile']['size']    = $value['size'][$i];

                            $this->load->library('upload', $config);
                            if (!$this->upload->do_upload()) {
                                $this->handle_error($this->upload->display_errors());
                            } else {
                                $files[$i] = $this->upload->data();
                            }
                        }
                    }
                }
                // There were errors, we have to delete the uploaded files
                if ($is_file_error && $files) {
                    for ($i = 0; $i < count($files); $i++) {
                        $file = $dir_path . $files[$i]['file_name'];
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                }
     
                if (!$is_file_error && $files) {
                    $resp = $this->file_model->save_files_info($files, $email_id);
                    if ($resp === TRUE) {
                        $this->handle_success('File(s) was/were successfully uploaded.');
                        $file_is_done = TRUE;
                    } else {
                        for ($i = 0; $i < count($files); $i++) {
                            $file = $dir_path . $files[$i]['file_name'];
                            if (file_exists($file)) {
                                unlink($file);
                            }
                        }
                        $this->handle_error('Error while saving file info to Database.');
                    }
                }
            }
            

            if ($this->input->post('feedback_comment')) {
                $feedback_message = $this->input->post('feedback_comment');
                if ($this->email_model->save_comment($email_id, $feedback_message)) {
                    $this->session->set_userdata('feedback_show_form', FALSE);
                    // $this->session->set_userdata('feedback_sent', TRUE);
                    $this->handle_success(lang('msg_comment_sent'));
                    // $this->session->set_flashdata('show_comment_sent', lang('msg_comment_sent'));
                    
                    $comment_is_done = TRUE;
                }
            }

            if ($comment_is_done || $file_is_done) {
                redirect('thankyou/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4), 'refresh');
            }
            
        }
        else {

            // $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        // $data['errors'] = $this->error;
        // $data['success'] = $this->success;

        $data['title'] = lang('text_title');
        $data['message'] = lang('msg_thanks');
        $data['logo_name'] = $logo_name;

        $data['feedback_comment'] = array(
                'name'  => 'feedback_comment',
                'id'    => 'feedback_comment',
                'class' => 'form-control',
                'rows'  => 3,
                'placeholder' => lang('text_placeholder'),
                'value' => $this->form_validation->set_value('feedback_comment'),
        );

        $data['btn_send'] = array(
            'name'  => 'send',
            'id' => 'btn_send',
            'value' => lang('button_send'),
            'class' => 'btn btn-primary',
            'type'  => 'submit',
        );

        $data['thankyou_default_message'] = lang('msg_thank_you_default');
        
		$this->load->view('pages/thankyou',$data);
	}

    private function decode_var($var) {
        $decoded = str_replace(array('-', '_', '~'), array('+', '/', '='), $var);
        return $this->encrypt->decode($decoded);
    }

    private function handle_error($err) {
        $this->error .= "<p>" . $err . "</p>";
        $this->session->set_flashdata('errors', $this->error);
    }
 
    private function handle_success($succ) {
        $this->success .= "<p>" . $succ . "</p>";
        $this->session->set_flashdata('success', $this->success);
    }
	
}