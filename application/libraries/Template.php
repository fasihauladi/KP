<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Template
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function display($template, $data = NULL)
    {
        $data['_content']         = $this->_ci->load->view($template, $data, TRUE);
        $data['_header']         = $this->_ci->load->view('/admin_portal/template/v_header', $data, TRUE);
        $data['_sidebar']         = $this->_ci->load->view('/admin_portal/template/v_sidebar', $data, TRUE);
        $data['_footer']        = $this->_ci->load->view('/admin_portal/template/v_footer', $data, TRUE);
        $data['_js']             = $this->_ci->load->view('/admin_portal/template/v_js', $data, TRUE);
        $this->_ci->load->view('admin_portal/v_home', $data);
    }
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */