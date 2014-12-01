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
        $this->load->model('homepage', 'hp');
    }
    
    private $itemPerPage=20;

    public function detail($title)
    {
        $page='code';
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();


        $data['code'] = $this->hp->getArticle(urldecode($title));
        $data['lasted'] = $this->hp->getLatestArticles(5);
        $data['title'] = $title;

        $this->hp->selfIncrease($title);

        $this->load->view('templates/a_header', $data);
        $this->load->view('code/header_add_' . $page);
        $this->load->view('templates/a_nav');
        $this->load->view('code/'.$page);
        $this->load->view('templates/a_footer_script');
        $this->load->view('code/footer_add_' . $page);
        $this->load->view('templates/a_footer');
    }
    
    public function codeList($pageNum='0')
    {
        $page = 'list';
        if ( ! file_exists("application/views/code/$page.php"))
          show_404();
        
        $data['title'] = "代码列表";
        $data['list'] = $this->hp->getList(1, $pageNum, $this->itemPerPage);
        $data['pagination'] = $this->getPagination(1);

        $this->load->view('templates/a_header', $data);
        $this->load->view('templates/a_nav');
        $this->load->view('code/'.$page);
        $this->load->view('templates/a_footer_script');
        $this->load->view('templates/a_footer');
    }
    
    public function feelings($pageNum='0')
    {
        $page = 'list';
        if ( ! file_exists("application/views/code/$page.php"))
            show_404();

        $data['title'] = "文章列表";
        $data['list'] = $this->hp->getList(2, $pageNum, $this->itemPerPage);
        $data['pagination'] = $this->getPagination(2);

        $this->load->view('templates/a_header', $data);
        $this->load->view('templates/a_nav');
        $this->load->view('code/'.$page);
        $this->load->view('templates/a_footer_script');
        $this->load->view('templates/a_footer');
    }
    
    public function updateInfo($pageNum='0')
    {
        $page = 'list';
        if ( ! file_exists("application/views/code/$page.php"))
            show_404();

        $data['title'] = "文章列表";
        $data['list'] = $this->hp->getList(3, $pageNum, $this->itemPerPage);
        $data['pagination'] = $this->getPagination(3);

        $this->load->view('templates/a_header', $data);
        $this->load->view('templates/a_nav');
        $this->load->view('code/'.$page);
        $this->load->view('templates/a_footer_script');
        $this->load->view('templates/a_footer');
    }
    
    public function addCode()
    {
        $page='addCode';
        if(! file_exists("application/views/code/$page.php"))
            show_404 ();
        
        $data['title'] = '创建Code';
        $data['category'] = $this->hp->getCategory();
        
        $this->load->view('code/'.$page, $data);
    }
    
    public function addCodeData()
    {
        $saveType = $this->input->post('saveType', true);
        $cid = $this->input->post('cid', true);
        $click = $this->input->post('click', true);
        $title = $this->input->post('title', true);
        $summary = $this->input->post('summary', true);
        $content = $this->input->post('content', false);

        echo $this->hp->insertArticle($saveType, $cid, $click, $title, $summary, $content);
    }
    
    public function deleteDraft()
    {
        $id = $this->input->post('id', true);
        echo $this->hp->deleteArticle($id);
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

        $query = $this->hp->setComment($aid, $author, $email, $url, $comment);
        if ($query == true)
            echo '1';
        else
            echo '0';
    }
    
    //Add on June 12th, 2014 to get comments from database
    public function getCommentData()
    {
        $aid =  $this->input->post('aid', true);

        $data = $this->hp->getComment($aid);
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
//        $page='aboutme';
//        if ( ! file_exists("application/views/code/$page.php"))
//          show_404();
//
//        //iconv('GB2312', 'UTF-8', str)将字符串的编码从GB2312转到UTF-8
//        $sql="select `id`, `updatetime`,`click`, `title`, `content` from `code` where `title`='". urldecode($title) ."' limit 1";
//        $query = $this->db->query($sql);
//        $data = array();
//        foreach ($query->result_array() as $item)
//        {
//            $data['code']->id = $item['id'];
//            $data['code']->updatetime = $item['updatetime'];
//            $data['code']->click = $item['click'];
//            $data['code']->title = $item['title'];
//            $data['code']->content = $item['content'];
//        }
//
//        //浏览时浏览量自增
//        $sql="UPDATE `code` SET `click`=`click`+1 WHERE `title`='". urldecode($title) ."' LIMIT 1";
//        $query = $this->db->query($sql);
//
//        $data['title'] = $data['code']->title." zhangbobell.cn";
//
//        $this->load->view('code/'.$page, $data);

        $page='code';
        if ( ! file_exists("application/views/code/$page.php"))
            show_404();


        $data['code'] = $this->hp->getArticle(urldecode($title));
        $data['lasted'] = $this->hp->getLatestArticles(5);
        $data['title'] = $title;

        $this->hp->selfIncrease($title);

        $this->load->view('templates/a_header', $data);
        $this->load->view('code/header_add_' . $page);
        $this->load->view('templates/a_nav');
        $this->load->view('code/'.$page);
        $this->load->view('templates/a_footer_script');
        $this->load->view('code/footer_add_' . $page);
        $this->load->view('templates/a_footer');
    }

    /*
     * getPagination : 获取分页链接的数组
     * param : $cid -- 类目id
     * return : $pagination -- 分页链接的数组
     */
    public function getPagination($cid)
    {
        $this->load->model("homepage", 'hp');
        //获取总的记录数
        $totalRecord = $this->hp->getCateNum($cid);

        //生成分页的超级链接
        $this->load->library('pagination');
        $config = $this->pageConfig(base_url().'code/codeList/', $totalRecord);
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        return $pagination;
    }
}