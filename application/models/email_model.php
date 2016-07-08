<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Email Model
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

class Email_model extends CI_Model
{
	public function __construct() {
		parent::__construct();		
	}

	public function get_count() {
        return $this->db->count_all("recipient_history");
    }

	public function get_email_templates() {
        $data = array();
        $Q = $this->db->get('email_template');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    public function save($language, $company = '', $customer_name, $email, $reference = '', $user_id) {

        $data = array(
            'customer_name' =>  $customer_name,
            'company'       =>  $company,
            'reference'     =>  $reference,
            'email'         =>  $email,
            'status'        =>  $this->config->item('email_status_draft'),
            'user_id'       =>  $user_id,
            'language'   =>  $language
        );

        $this->db->insert('emails', $data);

        $id = $this->db->insert_id();

        return (isset($id)) ? $id : FALSE;
    }

    public function update($language, $company = '', $customer_name, $email, $reference = '', $status, $email_id, $date_sent = '') {

        $data = array(
            'customer_name' =>  $customer_name,
            'company'       =>  $company,
            'reference'     =>  $reference,
            'email'         =>  $email,
            'status'        =>  $status,
            'language'   =>  $language
        );

        if ($date_sent) {
            $data['date_sent'] = $date_sent;
        }

        $this->db->update('emails', $data, array('email_id' => $email_id));
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
        $this->db->join('languages', 'languages.language_id = geo_zone.language_id', 'inner');

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

    public function save_comment($email_id, $comment) {
        $data = array(
            'feedback_comment'        =>  $comment
        );

        if($this->db->update('emails', $data, array('email_id' => $email_id))) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }

}
