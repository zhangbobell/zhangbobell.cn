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
    
    public function detail($title)
    {
        $page='code';
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        //iconv('GB2312', 'UTF-8', str)将字符串的编码从GB2312转到UTF-8 
        $sql="select `updatetime`,`click`, `title`, `content` from `code` where `title`='". urldecode($title) ."' limit 1";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $item)
        {
            $data['code']->updatetime = $item['updatetime'];
            $data['code']->click = $item['click'];
            $data['code']->title = $item['title'];
            $data['code']->content = $item['content'];
        }
        
        $sql="select `title` from `code` where `saveType`='1' order by `updatetime` DESC LIMIT 5";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $item)
        {
            $data['lasted'][] = $item['title'];
        }
        
        $sql="UPDATE `code` SET `click`=`click`+1 WHERE `title`='". urldecode($title) ."' LIMIT 1";
        $query = $this->db->query($sql);
        
        $data['title'] = $data['code']->title." zhangbobell.cn";
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function codeList($page='list')
    {
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        $data['title'] = "代码列表";
        
        $sql="SELECT `id`, `title`,date_format(`updatetime`,'%Y-%m-%d') as `date` "
                . "FROM `code` "
                . "WHERE `saveType`='1' AND `cid`='1' "
                . "ORDER by `updatetime` DESC ";
        $query = $this->db->query($sql);
        
        foreach ($query->result_array() as $key => $item)
        {
            $data['list'][$item['date']][$key]->id=$item['id'];
            $data['list'][$item['date']][$key]->date = $item['date'];
            $data['list'][$item['date']][$key]->title = $item['title'];
        }
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function feelings($page='list')
    {
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        $data['title'] = "文章列表";
        
        $sql="SELECT `id`, `title`,date_format(`updatetime`,'%Y-%m-%d') as `date` "
                . "FROM `code` "
                . "WHERE `saveType`='1' AND `cid`='2' "
                . "ORDER by `updatetime` DESC ";
        $query = $this->db->query($sql);
        
        foreach ($query->result_array() as $key => $item)
        {
            $data['list'][$item['date']][$key]->id=$item['id'];
            $data['list'][$item['date']][$key]->date = $item['date'];
            $data['list'][$item['date']][$key]->title = $item['title'];
        }
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function updateInfo($page='list')
    {
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        $data['title'] = "文章列表";
        
        $sql="SELECT `id`, `title`,date_format(`updatetime`,'%Y-%m-%d') as `date` "
                . "FROM `code` "
                . "WHERE `saveType`='1' AND `cid`='3' "
                . "ORDER by `updatetime` DESC ";
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
        
        $sql="SELECT * FROM `category` WHERE `isValid`='1'";
        $query = $this->db->query($sql);
        
        foreach ($query->result_array() as $key => $item)
        {
            $data['category'][$key]->id=$item['id'];
            $data['category'][$key]->name = $item['name'];
        }
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function addCodeData()
    {
        $title = $this->input->post('title', true);
        $saveType = $this->input->post('saveType', true);
        $cid = $this->input->post('cid', true);
        $click = $this->input->post('click', true);
        $vid = $this->input->post('vid', true);
        $content = $_POST['content'];//$this->input->post('content', true);
        
        date_default_timezone_set('Asia/Shanghai');
        if($saveType==0 || $saveType == 2)//自动保存草稿或手动保存草稿
        {
            if($vid==-1)//首次保存
            {
                $sql="INSERT INTO `code` (`saveType`,`cid`,`click`,`title`, `content`, `updatetime`) VALUES ('$saveType', '$cid', '$click', '$title', '$content', '". date('Y-m-d H:i:s') ."')";
                $query=$this->db->query($sql);
                if($query==true)
                {
                    $query =  $this->db->query("SELECT LAST_INSERT_ID() as `vid`");
                    foreach ($query->result_array() as $item)
                        $vid=$item['vid'];
                    echo $vid;
                }
                else
                    echo '-1';
                
            }
            else
            {
                $sql="UPDATE `code` "
                        . "SET `saveType`='$saveType', "
                        . "`cid`='$cid', "
                        . "`click`='$click', "
                        . "`title` = '$title', "
                        . "`content`='$content', "
                        . "`updatetime`='". date('Y-m-d H:i:s') ."' "
                        . "WHERE `id`='$vid'";
                $query=$this->db->query($sql);
                if($query==true)
                    echo $vid;
                else
                    echo '-1';
            }
        }
        if($saveType==1)//点击‘保存按钮’
        {
            $sql="UPDATE `code` "
                        . "SET `saveType`='$saveType', "
                        . "`cid`='$cid', "
                        . "`click`='$click', "
                        . "`title` = '$title', "
                        . "`content`='$content', "
                        . "`updatetime`='". date('Y-m-d H:i:s') ."' "
                        . "WHERE `id`='$vid'";
                $query=$this->db->query($sql);
            if($query==true)
                echo '1';
            else
                echo '0';
        }
    }
    
    public function deleteDraft()
    {
        $id = $this->input->post('id', true);
        
        $sql="delete from `code` where `id`='$id'";
        $query=$this->db->query($sql);
        if($query==true)
            echo '1';
        else
            echo '0';
    }
}