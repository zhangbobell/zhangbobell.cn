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
    
    private $itemPerPage=20;

    public function detail($title)
    {
        $page='code';
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        //iconv('GB2312', 'UTF-8', str)将字符串的编码从GB2312转到UTF-8 
        $sql="select `id`, `updatetime`,`click`, `title`, `content` from `code` where `title`='". urldecode($title) ."' limit 1";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $item)
        {
            $data['code']->id = $item['id'];
            $data['code']->updatetime = $item['updatetime'];
            $data['code']->click = $item['click'];
            $data['code']->title = $item['title'];
            $data['code']->content = $item['content'];
        }
        
        //最近更新的5篇文章
        $sql="select `title` from `code` where `saveType`='1' order by `updatetime` DESC LIMIT 5";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $item)
        {
            $data['lasted'][] = $item['title'];
        }
        
        //浏览时浏览量自增
        $sql="UPDATE `code` SET `click`=`click`+1 WHERE `title`='". urldecode($title) ."' LIMIT 1";
        $query = $this->db->query($sql);
        
        $data['title'] = $data['code']->title." zhangbobell.cn";
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function codeList($pageNum='0')
    {
        if ( ! file_exists("application/views/code/list.php"))
          show_404();
        
        $data['title'] = "代码列表";
        
        $sql="SELECT `id`, `title`,date_format(`updatetime`,'%Y-%m-%d') as `date` "
                . "FROM `code` "
                . "WHERE `saveType`='1' AND `cid`='1' "
                . "ORDER by `updatetime` DESC "
                . "LIMIT $pageNum, $this->itemPerPage ";
        
        $query = $this->db->query($sql);
        
        foreach ($query->result_array() as $key => $item)
        {
            $data['list'][$item['date']][$key]->id=$item['id'];
            $data['list'][$item['date']][$key]->date = $item['date'];
            $data['list'][$item['date']][$key]->title = $item['title'];
        }
        
        //获取总的记录数
        $query = $this->db->query("select * from code where `cid`='1'");
        $totalRecord = $query->num_rows();
        
        //生成分页的超级链接
        $this->load->library('pagination');
        $config=$this->pageConfig(base_url().'code/codeList/', $totalRecord);  
        $this->pagination->initialize($config); 
        $data['pagination']=$this->pagination->create_links();
        
        $this->load->view('code/list', $data);
    }
    
    public function feelings($pageNum='0')
    {
        if ( ! file_exists("application/views/code/list.php"))
        {
          show_404();        
        }
        $data['title'] = "文章列表";
        
        $sql="SELECT `id`, `title`,date_format(`updatetime`,'%Y-%m-%d') as `date` "
                . "FROM `code` "
                . "WHERE `saveType`='1' AND `cid`='2' "
                . "ORDER by `updatetime` DESC "
                . "LIMIT $pageNum, $this->itemPerPage ";
        $query = $this->db->query($sql);
        
        foreach ($query->result_array() as $key => $item)
        {
            $data['list'][$item['date']][$key]->id=$item['id'];
            $data['list'][$item['date']][$key]->date = $item['date'];
            $data['list'][$item['date']][$key]->title = $item['title'];
        }
        
        //获取总的记录数
        $query = $this->db->query("select * from code where `cid`='2'");
        $totalRecord = $query->num_rows();
        
        //生成分页的超级链接
        $this->load->library('pagination');
        $config=$this->pageConfig(base_url().'code/feelings/', $totalRecord);  
        $this->pagination->initialize($config); 
        $data['pagination']=$this->pagination->create_links();
        
        $this->load->view('code/list', $data);
    }
    
    public function updateInfo($pageNum='0')
    {
        if ( ! file_exists("application/views/code/list.php"))
          show_404();
        
        $data['title'] = "文章列表";
        
        $sql="SELECT `id`, `title`,date_format(`updatetime`,'%Y-%m-%d') as `date` "
                . "FROM `code` "
                . "WHERE `saveType`='1' AND `cid`='3' "
                . "ORDER by `updatetime` DESC "
                . "LIMIT $pageNum, $this->itemPerPage ";
        $query = $this->db->query($sql);
        
        foreach ($query->result_array() as $key => $item)
        {
            $data['list'][$item['date']][$key]->id=$item['id'];
            $data['list'][$item['date']][$key]->date = $item['date'];
            $data['list'][$item['date']][$key]->title = $item['title'];
        }
        
        //获取总的记录数
        $query = $this->db->query("select * from code where `cid`='3'");
        $totalRecord = $query->num_rows();
        
        //生成分页的超级链接
        $this->load->library('pagination');
        $config=$this->pageConfig(base_url().'code/updateInfo/', $totalRecord);  
        $this->pagination->initialize($config); 
        $data['pagination']=$this->pagination->create_links();
        
        $this->load->view('code/list', $data);
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
        $content = $_POST['content'];
        
        date_default_timezone_set('Asia/Shanghai');
        if($saveType==0 || $saveType == 2)//自动保存草稿或手动保存草稿
        {
            if($vid==-1)//首次保存
            {
                $sql="INSERT INTO `code` "
                        . "(`saveType`,`cid`,`click`,`title`, `content`, `updatetime`) "
                        . "VALUES ('$saveType', '$cid', '$click', '$title', '$content', '". date('Y-m-d H:i:s') ."')";
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
    
    //Add on June 12th, 2014 to handle the ajax request about adding comments
    public function addCommentData()
    {
        $aid =  $this->input->post('aid', true);
        $author =  $this->input->post('author', true);
        $email = $this->input->post('email', true);
        $url = $this->input->post('url', true);
        $comment = $this->input->post('comment', true);
        
        $author = htmlspecialchars($author,ENT_QUOTES);
        $email = htmlspecialchars($email,ENT_QUOTES);
        $url = htmlspecialchars($url,ENT_QUOTES);
        $comment = htmlspecialchars($comment,ENT_QUOTES);
        
        $sql="INSERT INTO `comment` "
                        . "(`articleId`,`author`,`updatetime`,`email`, `url`, `content`) "
                        . "VALUES ('$aid', '$author', '". date('Y-m-d H:i:s') ."', '$email', '$url', '$comment')";
        $query=$this->db->query($sql);
        if($query==true)
        {
            echo '1';
        }
        else
            echo '0';
    }
    
    //Add on June 12th, 2014 to get comments from database
    public function getCommentData()
    {
        $aid=  $this->input->post('aid', true);
        $sql="select `id`, `author`, `url`, `updatetime`, `content` from `comment` where `articleId`='$aid' order by `updatetime` ASC";
        $query = $this->db->query($sql);
        
        $data = array();
        foreach ($query->result_array() as $key => $item)
        {
            $data[$key]['id'] = $item['id'];
            $data[$key]['author'] = $item['author'];
            $data[$key]['url'] = $item['url'];
            $data[$key]['updatetime'] = $item['updatetime'];
            $data[$key]['content'] = $item['content'];
        }
        
        echo json_encode($data);
    }
    
    /*
     * Created on June 13th, 2014
     * function pageConfig : 配置分页链接的参数
     * @param : $addr 分页的基地址; $totalRows 信息总条数
     * @return : $config 配置好的结果数组        
     */
    public function pageConfig($addr, $totalRows)
    {
        $config['base_url'] = $addr;
        $config['total_rows'] = $totalRows;  
        $config['per_page'] = $this->itemPerPage;
        $config['first_link'] = '首页';
        $config['last_link'] = '末页';
        $config['next_link'] = '下一页';
        $config['prev_link'] = '上一页';
        $config['cur_tag_open'] = '<a class="current">';
        $config['cur_tag_close'] = '</a>';
        
        return $config;
    }
    
    public function aboutme($title='关于我')
    {
        $page='aboutme';
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        //iconv('GB2312', 'UTF-8', str)将字符串的编码从GB2312转到UTF-8 
        $sql="select `id`, `updatetime`,`click`, `title`, `content` from `code` where `title`='". urldecode($title) ."' limit 1";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $item)
        {
            $data['code']->id = $item['id'];
            $data['code']->updatetime = $item['updatetime'];
            $data['code']->click = $item['click'];
            $data['code']->title = $item['title'];
            $data['code']->content = $item['content'];
        }
        
        //浏览时浏览量自增
        $sql="UPDATE `code` SET `click`=`click`+1 WHERE `title`='". urldecode($title) ."' LIMIT 1";
        $query = $this->db->query($sql);
        
        $data['title'] = $data['code']->title." zhangbobell.cn";
        
        $this->load->view('code/'.$page, $data);
    }
}