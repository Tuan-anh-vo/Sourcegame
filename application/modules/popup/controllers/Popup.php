<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Popup extends MX_Controller
{
    private $module = 'popup';
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module . '_model', 'model');
    }
    /*-------------------------------------- FrontEnd --------------------------------*/
    function popup_video(){
    	echo $this->load->view('FRONTEND/popup_video','',TRUE);
    }
    function popup_login(){
    	echo $this->load->view('FRONTEND/popup_login','',TRUE);
    }
    function popup_register(){
    	
    }


}

