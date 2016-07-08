<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Reporting Model
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

class Reporting_model extends CI_Model
{
	public function __construct() {
		parent::__construct();		
	}

    public function countries($id='', $limit='') {
        if ($limit) {
            $this->db->limit($limit);
        }

        if ($id) {
            return $this->db->get_where('geo_zone', array('geo_zone_id' => $id));
        }
        return $this->db->get('geo_zone');
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

    public function statuses($id='', $limit='') {
        if ($limit) {
            $this->db->limit($limit);
        }

        if ($id) {
            return $this->db->get_where('feedback_description', array('feedback_id' => $id));
        }
        return $this->db->get('feedback_description');
    }

    public function company_employees($company_id='', $limit='') {
        if ($limit) {
            $this->db->limit($limit);
        }

        $this->db->select('users.id, CONCAT(first_name, " ", last_name) name', FALSE)
                 ->from('users')
                 ->join('company', 'users.company = company.company_id', 'inner');
        if ($company_id) {
            $this->db->where('users.company', $company_id);
        }

        return $this->db->get();
    }

    public function country_companies($geo_zone_id='', $limit='') {
        if ($limit) {
            $this->db->limit($limit);
        }

        $this->db->select('company_id, company.name', FALSE)
                 ->from('company')
                 ->join('geo_zone', 'company.geo_zone_id = geo_zone.geo_zone_id', 'inner');
        if ($geo_zone_id) {
            $this->db->where('company.geo_zone_id', $geo_zone_id);
        }

        return $this->db->get();
    }

    function csv($geo_zone_id='', $company_id='', $user_id='', $from_date='', $to_date='', $feedback_id='') {
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        if (strtotime($to_date) < strtotime($from_date)) {
            $tmp = $to_date;
            $to_date = $from_date;
            $from_date = $tmp;
        }

        $query = "SELECT CONCAT(first_name, ' ', last_name) Name, emails.company AS Company, customer_name AS Client, reference AS Reference, date_sent AS 'Date Sent', description AS Status
            FROM emails
            INNER JOIN users ON emails.user_id = users.id
            INNER JOIN company ON users.company = company.company_id
            INNER JOIN geo_zone ON company.geo_zone_id = geo_zone.geo_zone_id
            INNER JOIN feedback ON emails.email_id = feedback.email_id
            INNER JOIN feedback_description ON feedback.feedback_id = feedback_description.feedback_id";

        $where = array();
        if ($geo_zone_id) {
            $where[] = 'geo_zone.geo_zone_id = ' . $geo_zone_id;
        }
        if ($company_id) {
            $where[] = 'company.company_id = ' . $company_id;
        }
        if ($user_id) {
            $where[] = 'users.id = ' . $user_id;
        }
        if ($from_date && $to_date) {
            $where[] = "(emails.date_sent BETWEEN '" . $from_date . "' AND '" . $to_date . "')";
        }
        else {
            if ($from_date) {
                $where[] = "emails.date_sent >= '" . $from_date . "'";
            }
            if ($to_date) {
                $where[] = "emails.date_sent <= '" . $to_date . "'";
            }
        }
        
        if ($feedback_id) {
            $where[] = 'users.id = ' . $feedback_id;
        }

        if ($where) {
            $where = implode(" AND ",$where);
            $query .= ' WHERE ' . $where;
        }
// exit($query);
        $query = $this->db->query($query);

        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('CSV_Report_'.date('Ymd_his').'.csv', $data);
    }


}
