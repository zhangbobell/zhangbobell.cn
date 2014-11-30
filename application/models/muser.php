<?php
/**
 * Created by PhpStorm.
 * User: zhangbobell
 * Date: 14-11-30
 * Time: 下午6:57
 */

class Muser extends CI_Model {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Shanghai');
    }

    /*
     * 验证用户名密码
     * @param : username , password
     * @return : the record or false
     * */
    function validate($username, $password) {
        $sql = "SELECT `id`,`username`, `groupid`
                FROM `user`
                WHERE `username`=? and password=? LIMIT 1";

        return $this->db->query($sql, array($username, $password));
    }

    function get_article_list() {
        $sql = "SELECT `code`.`id`, `updatetime`, `click`, `name`, `title`
                FROM `code`
                LEFT JOIN `category`
                ON `code`.`cid` = `category`.`id`
                WHERE `saveType` = '1'
                ORDER BY `updatetime` DESC";

        return $this->db->query($sql);
    }

    function get_article($id)
    {
        //iconv('GB2312', 'UTF-8', str)将字符串的编码从GB2312转到UTF-8
        $sql="select `id`, `updatetime`,`click`, `title`, `cid`, `summary`, `content` from `code` where `id`=? limit 1";
        $res = $this->db->query($sql, $id)->result_array();

        return $res[0];
    }

    /*
 * insertArticle : 插入文章
 * param :  $saveType -- 保存类型   0:自动保存草稿 1:正式发布的文章 2:手动保存草稿
 *          $cid -- 类目id
 *          $click -- 点击量
 *          $title -- 文章题目
 *          $content -- 文章内容
 * return : $vid -- 文章的id or -1 -- 插入失败
 */
    function insert_article($saveType, $cid, $click, $title, $summary, $content) {
        $date = date('Y-m-d H:i:s');
        $sql="INSERT INTO `code` "
            . "(`saveType`,`cid`,`click`,`title`, `summary`, `content`, `updatetime`) "
            . "VALUES (?, ?, ?, ?, ?, ?, '$date')";

        return $this->db->query($sql, array($saveType, $cid, $click, $title, $summary, $content));
    }

    function update_article($revise_id, $cid, $title, $summary, $content) {
//        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE `code` SET
                `cid` = ?, `title` = ?, `summary` = ?, `content` = ?
                WHERE `id` = ?";

        return $this->db->query($sql, array($cid, $title, $summary, $content, $revise_id));
    }

    function delete_article($delete_id) {
        $sql = "DELETE FROM `code` WHERE `id` = ?";

        return $this->db->query($sql, array($delete_id));
    }

}