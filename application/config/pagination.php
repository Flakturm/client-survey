<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Pagination Config
 * 
 * Just applying codeigniter's standard pagination config with twitter 
 * bootstrap stylings
 * 
 * @license     http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @author      Mike Funk
 * @link        http://codeigniter.com/user_guide/libraries/pagination.html
 * @email       mike@mikefunk.com
 * 
 * @file        pagination.php
 * @version     1.3.1
 * @date        03/12/2012
 * 
 * Copyright (c) 2011
 */
 
// --------------------------------------------------------------------------

// $config['base_url'] = base_url();
$config['per_page'] = 50;
$config['uri_segment'] = 2;
$config['num_links'] = 9;
$config['page_query_string'] = FALSE;
$config['use_page_numbers'] = TRUE;
$config['query_string_segment'] = 'page';

/* This Application Must Be Used With BootStrap 3 *  */
$config['full_tag_open'] = "<ul class='pagination'>";
$config['full_tag_close'] ="</ul>";
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
$config['next_tag_open'] = "<li>";
$config['next_tagl_close'] = "</li>";
$config['prev_tag_open'] = "<li>";
$config['prev_tagl_close'] = "</li>";
$config['first_tag_open'] = "<li>";
$config['first_tagl_close'] = "</li>";
$config['last_tag_open'] = "<li>";
$config['last_tagl_close'] = "</li>";

// $config['display_pages'] = FALSE;
// 
$config['anchor_class'] = 'follow_link';

// --------------------------------------------------------------------------

/* End of file pagination.php */
/* Location: ./sonepar/application/config/pagination.php */