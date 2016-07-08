<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Language Model
*
* Version: 1.1.0
*
* Author:  Andy
*
* Created:  29.04.2015
*
* Last Change: 
*
*/

class Language_model extends CI_Model
{
	public function __construct() {
		parent::__construct();		
	}

    public function languages($id='', $limit='') {
        if ($limit) {
            $this->db->limit($limit);
        }

        if ($id) {
            return $this->db->get_where('languages', array('language_id' => $id));
        }
        return $this->db->get('languages');
    }

}
