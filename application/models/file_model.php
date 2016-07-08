<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  File Model
*
* Version: 1.1.0
*
* Author:  Andy
*
* Created:  5.5.2015
*
* Last Change: 
*
*/

class File_model extends CI_Model {
    //table name
    private $file = 'files';   // files

    public function save_files_info($files, $email_id) {
        //start db transaction
        $this->db->trans_start();
        //file data
        $file_data = array();
        foreach ($files as $file) {
            $file_data[] = array(
                'file_name' => $file['file_name'],
                'file_orig_name' => $file['orig_name'],
                'file_path' => $file['full_path'],
                'upload_date' => date('Y-m-d H:i:s'),
                'email_id'  => $email_id
            );
        }
        //insert file data
        $this->db->insert_batch($this->file, $file_data);
        //complete the transaction
        $this->db->trans_complete();
        //check transaction status
        if ($this->db->trans_status() === FALSE) {
            foreach ($files as $file) {
                $file_path = $file['full_path'];
                //delete the file from destination
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            //rollback transaction
            $this->db->trans_rollback();
            return FALSE;
        } else {
            //commit the transaction
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function files($id='', $limit='') {
        if ($limit) {
            $this->db->limit($limit);
        }

        if ($id) {
            return $this->db->get_where($this->file, array('email_id' => $id));
        }
        return $this->db->get($this->file);
    }

}