<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Dashboard Model
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

class Dashboard_model extends CI_Model
{
	public function __construct() {
		parent::__construct();		
	}

	public function get_count() {
        return $this->db->count_all("emails");
    }

	public function get_emails($limit, $offset, $user_id){
        $data = array();

        $this->db->limit($limit, $offset);

        $this->db->select('DISTINCT e.email_id, company, customer_name, reference, email, status, date_added, date_sent, description', FALSE);
        $this->db->from('emails e');
        $this->db->join('feedback f', 'f.feedback_id = e.feedback_id', 'left');
        $this->db->join('feedback_description fd', 'f.feedback_id = fd.feedback_id', 'left');
        $this->db->where('e.user_id', $user_id);
        $this->db->order_by("e.email_id", "desc"); 
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
}
