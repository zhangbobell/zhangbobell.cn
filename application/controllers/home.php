<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function index($page="index")
    {
        if ( ! file_exists("application/views/home/$page.php"))
        {
          show_404();
        }
        $data['title'] = "欢迎访问张博的个人主页";

        $this->load->view('home/'.$page, $data);
    }
}

