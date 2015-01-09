<?php

class User extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('muser');
    }

    /*
     *  管理中心
     */
    function center($page = 'center') {
        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $data['title'] = '管理中心';
        $data['user'] = $this->session->all_userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/banner');
        $this->load->view('templates/sidebar');
        $this->load->view('user/'.$page);
        $this->load->view('templates/footer');
    }

    function login($page = 'login') {
        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $data['title'] = '管理登录';

        $this->load->view('user/'.$page, $data);
    }

    function logout($page = 'logout') {
        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $data['title'] = '退出登录';

        $this->session->sess_destroy();
        $this->load->view('user/'.$page, $data);
    }

    function checklogin() {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $res = $this->muser->validate($username, $password);

        if ($res) {
            $res_arr = $res->result_array();
            $this->session->set_userdata($res_arr[0]);
            echo true;
        } else {
            echo $res;
        }
    }

    function manage_blog($page = 'manage_blog') {
        $article_list = $this->muser->get_article_list();

        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $data['title'] = '管理文章';
        $data['user'] = $this->session->all_userdata();
        $data['article_list'] = $article_list->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/banner');
        $this->load->view('templates/sidebar');
        $this->load->view('user/'.$page);
        $this->load->view('templates/footer_script');
        $this->load->view('user/footer_add_'.$page);
        $this->load->view('templates/footer');
    }

    function add_article($page = 'add_article') {
        $article_list = $this->muser->get_article_list();

        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $this->load->model('homepage', 'hp');

        $data['title'] = '添加文章';
        $data['user'] = $this->session->all_userdata();
        $data['category'] = $this->hp->getCategory();
        $data['id'] = $this->input->get('id', true);

        $this->load->view('templates/header', $data);
        $this->load->view('user/header_add_'.$page);
        $this->load->view('templates/banner');
        $this->load->view('templates/sidebar');
        $this->load->view('user/'.$page);
        $this->load->view('templates/footer_script');
        $this->load->view('user/footer_add_'.$page);
        $this->load->view('templates/footer');
    }

    function get_revise_article_data() {
        $id = $this->input->post('id', true);

        echo json_encode($this->muser->get_article($id));
    }

    function add_article_data() {
        $saveType = $this->input->post('saveType', true);
        $cid = $this->input->post('cid', true);
        $click = $this->input->post('click', true);
        $title = $this->input->post('title', true);
        $summary = $this->input->post('summary', true);
        $content = $this->input->post('content', false);
        $revise_id = $this->input->post('reviseId', false);

        if ($revise_id != '0') {
            echo $this->muser->update_article($revise_id, $cid, $title, $summary, $content);
        } else {
            echo $this->muser->insert_article($saveType, $cid, $click, $title, $summary, $content);
        }
    }

    function delete_article($page = 'delete_article') {

        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $delete_id = $this->input->get('id', true);
        $res = $this->muser->delete_article($delete_id);

        $data['title'] = '删除文章';
        $data['user'] = $this->session->all_userdata();
        $data['res'] = $res;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/banner');
        $this->load->view('templates/sidebar');
        $this->load->view('user/'.$page);
        $this->load->view('templates/footer_script');
        $this->load->view('templates/footer');
    }

    public function manage_comment($page = 'manage_comment') {
        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $comment_list = $this->muser->get_all_comment();

        $data['title'] = '管理评论';
        $data['user'] = $this->session->all_userdata();
        $data['comment_list'] = $comment_list->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/banner');
        $this->load->view('templates/sidebar');
        $this->load->view('user/'.$page);
        $this->load->view('templates/footer_script');
        $this->load->view('templates/footer');
    }

    function delete_comment($page = 'delete_comment') {

        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $delete_id = $this->input->get('id', true);
        $res = $this->muser->delete_comment($delete_id);

        $data['title'] = '删除评论';
        $data['user'] = $this->session->all_userdata();
        $data['res'] = $res;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/banner');
        $this->load->view('templates/sidebar');
        $this->load->view('user/'.$page);
        $this->load->view('templates/footer_script');
        $this->load->view('templates/footer');
    }

    public function reply_comment($page = 'reply_comment') {
        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $comment_id = $this->input->get('id', true);
        $res = $this->muser->get_comment($comment_id)->result_array();

        $data['title'] = '回复评论';
        $data['user'] = $this->session->all_userdata();
        $data['comment'] = $res[0];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/banner');
        $this->load->view('templates/sidebar');
        $this->load->view('user/'.$page);
        $this->load->view('templates/footer_script');
        $this->load->view('templates/footer');
    }

    public function reply_comment_data($page = 'reply_comment_res') {

        if ( ! file_exists("application/views/user/$page.php")) {
            show_404();
        }

        $email = $this->input->post('email', true);
        $id = $this->input->post('id', true);
        $reply = $this->input->post('reply', true);
        $articleId = $this->input->post('articleId', true);
        $zb = 'zhangbobell';
        $zb_email = 'zhangbobell@163.com';
        $zb_home = 'zhangbobell.cn';

        $res = $this->muser->insert_reply($articleId, $id, $zb, $zb_email, $zb_home, $reply);


        $article = $this->muser->get_article($articleId);
        $art_url = "<a href=\"". base_url() ."code/detail/" . $article['title'] . "\" target=\"_blank\">" . $article['title'] . "</a>";

        $res = $res && $this->send_email($email, $reply, $art_url);

        $data['title'] = '回复评论';
        $data['user'] = $this->session->all_userdata();
        $data['res'] = $res;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/banner');
        $this->load->view('templates/sidebar');
        $this->load->view('user/'.$page);
        $this->load->view('templates/footer_script');
        $this->load->view('templates/footer');
    }

    public function send_email($email, $reply_content, $art_url) {

        $config = Array(
            'mailtype' => 'html',
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.163.com',
            'smtp_port' => 465,
            'smtp_user' => 'zhangbobell@163.com',
            'smtp_pass' => '1991530123',
            'crlf' => '\r\n'
        );

        $this->load->library('email',$config);
        $this->email->set_newline("/r/n");

        $this->email->from('zhangbobell@163.com','张博');
        $this->email->to($email);
        $this->email->subject('Hello from zhangbobell');
        $this->email->message('您好，感谢您的评论，您在 zhangbobell.cn 的评论有了回复："' . $reply_content . '"。<br />点击查看'. $art_url);

        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
            return false;
        }

    }

    public function phpinfo() {
        echo phpinfo();
    }

}