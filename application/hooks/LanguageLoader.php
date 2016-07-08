<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        //$ci->lang->load('general','english');

        $site_lang = $ci->session->userdata('site_lang');

        if ($site_lang) {
            $ci->lang->load('general', $site_lang);
        } else {
            $ci->lang->load('general', 'english');
        }
    }
}