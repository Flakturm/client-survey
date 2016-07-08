<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Vote Model
*
* Version: 1.1.0
*
* Author:  Andy
*
* Created:  22.04.2015
*
* Last Change: 
*
*/

class Vote_model extends CI_Model
{
	public function __construct() {
		parent::__construct();		
	}

    public function update($feedback_id, $email_id) {

        $data = array(
            'feedback_id'   =>  $feedback_id,
        );

        $this->db->update('emails', $data, array('email_id' => $email_id));

        $data = array(
            'feedback_id'   =>  $feedback_id,
            'email_id'      =>  $email_id,
        );

        $this->db->insert('feedback', $data);

        return TRUE;
    }

    public function email($id) {
        return $this->db->get_where('emails', array('email_id' => $id), 1);
    }

    public function update_sent($id) {
        $data = array(
            'status'        =>  $this->config->item('email_status_sent')
        );

        $this->db->update('emails', $data, array('email_id' => $email_id));
        return TRUE;
    }

    public function user_companies($id='', $limit='') {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('company', 'company.company_id = users.company', 'inner');
        $this->db->join('geo_zone', 'company.geo_zone_id = geo_zone.geo_zone_id', 'inner');

        if ($limit) {
            $this->db->limit($limit);
        }
        if ($id) {
            $this->db->where('users.id', $id);
        }

        return $this->db->get();
    }

    public function companies($id='', $limit='') {
        if ($limit) {
            $this->db->limit($limit);
        }

        if ($id) {
            return $this->db->get_where('company', array('company_id' => $id));
        }
        return $this->db->get('company');
    }

    public function feedback_check($email_id) {
        $feedback = $this->db->select('feedback_id')
                             ->where('email_id', $email_id)
                             ->get('emails')
                             ->row();
        if ($feedback->feedback_id) {
            return TRUE;
        }

        return FALSE;
    }

    public function feedback_comment_check($email_id) {
        $feedback = $this->db->select('feedback_comment')
                             ->where('email_id', $email_id)
                             ->get('emails')
                             ->row();
        if ($feedback->feedback_comment) {
            return TRUE;
        }

        return FALSE;
    }

}
