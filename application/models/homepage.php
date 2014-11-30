<?php
/**
 * Created by PhpStorm.
 * User: ibm
 * Date: 14-8-23
 * Time: 下午7:43
 */
class Homepage extends CI_Model {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Shanghai');
    }

    /*
     * getList : 获取指定的类目中指定数目的条目
     * param : $cid -- 类目id  $startFrom -- 起始的序号  $entryNum -- 记录的条数
     * return : $list -- 结果记录集
     */
    function getList($cId, $startFrom, $entryNum=20)
    {
        $list = array();
        $sql="SELECT `id`, `title`,date_format(`updatetime`,'%Y-%m-%d') as `date` "
            . "FROM `code` "
            . "WHERE `saveType`='1' AND `cid`= $cId "
            . "ORDER by `updatetime` DESC "
            . "LIMIT $startFrom, $entryNum";

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $key => $item)
        {
            $list[$item['date']][$key]->id=$item['id'];
            $list[$item['date']][$key]->date = $item['date'];
            $list[$item['date']][$key]->title = $item['title'];
        }

        return $list;
    }

    /*
     * getCateNum : 获取指定的类目所有的条目数
     * param : $cid -- 类目id
     * return : $num_rows -- 类目的条目数
     */
    function getCateNum($cid)
    {
        $query = $this->db->query("select * from code where `cid`=$cid");
        return $query->num_rows();
    }

    /*
     * getComment : 获取指定文章的所有评论
     * param : $aid -- 文章id
     * return : $data -- 文章评论的结果集
     */
    function getComment($aid)
    {
        $sql="select `id`, `author`, `url`, `updatetime`, `content` from `comment` where `articleId`=$aid order by `updatetime` ASC";
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

        return $data;
    }

    /*
     * setComment : 增加指定文章的评论
     * param : $aid -- 文章id  $author -- 评论作者  $email -- 作者的邮件地址  $url -- 作者的网址  $comment -- 作者的评论
     * return : $query -- 执行结果(true or false)
     */
    function setComment($aid, $author, $email, $url, $comment)
    {
        $sql="INSERT INTO `comment` "
            . "(`articleId`,`author`,`updatetime`,`email`, `url`, `content`) "
            . "VALUES ('$aid', '$author', '". date('Y-m-d H:i:s') ."', '$email', '$url', '$comment')";
        $query=$this->db->query($sql);

        return $query;
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
    function insertArticle($saveType, $cid, $click, $title, $summary, $content)
    {
        $date = date('Y-m-d H:i:s');
        $sql="INSERT INTO `code` "
            . "(`saveType`,`cid`,`click`,`title`, `summary`, `content`, `updatetime`) "
            . "VALUES (?, ?, ?, ?, ?, ?, '$date')";

        return $this->db->query($sql, array($saveType, $cid, $click, $title, $summary, $content));

    }

    /*
     * insertArticle : 更新文章
     * param :  $saveType -- 保存类型   0:自动保存草稿 1:正式发布的文章 2:手动保存草稿
     *          $cid -- 类目id
     *          $vid -- 文章id
     *          $click -- 点击量
     *          $title -- 文章题目
     *          $content -- 文章内容
     * return : $vid -- 文章的id or -1 -- 插入失败
     */
    function updateArticle($saveType, $cid, $vid, $click, $title, $content)
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
        if($saveType == 1)
        {
            if($query == true)
                return 1;
            return 0;
        }
        else
        {
            if($query == true)
                return $vid;
            return -1;
        }
    }

    /*
     * deleteArticle : 删除指定id的文章
     * param : $aid -- 文章id
     * return : $query -- 执行结果(true or false)
     */
    function deleteArticle($aid)
    {
        $sql="delete from `code` where `id`='$aid'";
        $query=$this->db->query($sql);
        if($query==true)
            return 1;
        else
            return 0;
    }

    /*
     * getCategory : 获取所有的类目
     * param : void
     * return : $cate -- 所有类目的结果集
     */
    function getCategory()
    {
        $cate = array();
        $sql = "SELECT * FROM `category` WHERE `isValid`='1'";
        $query = $this->db->query($sql);

        foreach ($query->result_array() as $key => $item)
        {
            $cate[$key]->id = $item['id'];
            $cate[$key]->name = $item['name'];
        }

        return $cate;
    }

    /*
     * getArticle : 获取指定id的文章
     * param : void
     * return : $cate -- 所有类目的结果集
     */
    function getArticle($title)
    {
        //iconv('GB2312', 'UTF-8', str)将字符串的编码从GB2312转到UTF-8
        $sql="select `id`, `updatetime`,`click`, `title`, `summary`, `content` from `code` where `title`=? limit 1";
        $res = $this->db->query($sql, $title)->result_array();

        return $res[0];
    }

    /*
     * getLatestArticles : 获取一定数目最近的文章标题
     * param : $num -- 指定的数目
     * return : lasted -- 文章标题的结果集
     */
    function getLatestArticles($num)
    {
        $lasted = array();
        //最近更新的5篇文章
        $sql="select `title` from `code` where `saveType`='1' order by `updatetime` DESC LIMIT $num";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $item)
        {
            $lasted[] = $item['title'];
        }

        return $lasted;
    }

    /*
     * selfIncrease : 文章点击量自增
     * param : $title -- 文章的标题
     * return : $query -- 执行结果(true or false)
     */
    function selfIncrease($title)
    {
        //浏览时浏览量自增
        $sql="UPDATE `code` SET `click`=`click`+1 WHERE `title`='". urldecode($title) ."' LIMIT 1";
        $query = $this->db->query($sql);
        return $query;
    }


} 