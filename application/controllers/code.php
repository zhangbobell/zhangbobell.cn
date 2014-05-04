<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Code extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function codeDetail($title)
    {
        $page='code';
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        //iconv('GB2312', 'UTF-8', str)将字符串的编码从GB2312转到UTF-8 
        $sql="select `updatetime`, `title`, `content` from `code` where `title`='". urldecode($title) ."' limit 1";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $item)
        {
            $data['code']->updatetime = $item['updatetime'];
            $data['code']->title = $item['title'];
            $data['code']->content = $item['content'];
        }
        
        $sql="select `title` from `code` order by `updatetime` DESC LIMIT 5";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $item)
        {
            $data['lasted'][] = $item['title'];
        }
        
        $data['title'] = $data['code']->title." zhangbobell.cn";
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function codeList($page='list')
    {
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        $data['title'] = "代码列表";
        
        $sql="select `id`, `title`,date_format(`updatetime`,'%Y-%m-%d') as `date` from `code` order by `updatetime` DESC";
        $query = $this->db->query($sql);
        
        foreach ($query->result_array() as $key => $item)
        {
            $data['list'][$item['date']][$key]->id=$item['id'];
            $data['list'][$item['date']][$key]->date = $item['date'];
            $data['list'][$item['date']][$key]->title = $item['title'];
        }
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function addCode()
    {
        $page='addCode';
        if(! file_exists("application/views/code/$page.php"))
            show_404 ();
        
        $data['title']='创建Code';
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function addCodeData()
    {
        $title = $this->input->post('title', true);
        $content = $_POST['content'];//$this->input->post('content', true);
        
        date_default_timezone_set('Asia/Shanghai');
        $sql="INSERT INTO `code` (`title`, `content`, `updatetime`) VALUES ('$title', '$content', '". date('Y-m-d H:i:s') ."')";
        $query=  $this->db->query($sql);
        if($query==true)
            echo '1';
        else
            echo '0';
    }
}