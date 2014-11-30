<?php
if(!$this->session->userdata('id')) {
    header("content-type: text/html; charset=utf8");
    echo "该页面需要登录";
    echo "<br />正在跳转到登录页面...";

    $returnPage = base_url().'/user/login';
    echo "<br />如果浏览器没有反应，请点击<a href=\"". $returnPage ."\">这里</a>.";
    echo "<script type='text/javascript'>";
    echo "window.setTimeout(\"window.location='". $returnPage ."'\",1000); ";
    echo "</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title?></title>
        <meta charset="UTF-8">
        <base href="<?php echo base_url(); ?>"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/base.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/zxx.lib.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/default.css" />
	    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/prettify.css" />
    </head>
    <body>
        <div class="pct100">
            <div class="top">
                <div class="top-wrap">
                    <a class="logo-wrap" href="<?php echo base_url();?>">
                        <img class="logo" src="<?php echo base_url();?>public/images/logo.png" width="125px" height="18px" alt="logo" /></a>
                    <span id="nav-icon" class="nav-icon"></span>
                    <ul id="nav-bar" class="navBar">
                        <li><a href="<?php echo base_url();?>">主页</a></li>
                        <li><a href="<?php echo base_url();?>code/codeList">代码</a></li>
                        <li><a href="<?php echo base_url();?>code/feelings">心情</a></li>
                        <li><a href="<?php echo base_url();?>code/updateInfo">更新</a></li>
                        <li><a href="<?php echo base_url();?>code/aboutme">关于我</a></li>
                    </ul>
                </div>
            </div>
            <div class="auto mt20 w980">
            <form name="example" method="post" action="addCodeData">
                标题：<input type="text" placeholder="请输入标题" width="10" class="mt10 mb10" name="title" id="title" /><br />
                分类：<select id="category">
                    <?php foreach($category as $v):?>
                    <option value="<?php echo $v->id?>"><?php echo $v->name?></option>
                    <?php endforeach;?>
                    </select><br />
                内容：<br />
                <!-- 加载编辑器的容器 -->
                <script id="container" name="content" type="text/plain"></script>
                <br />
		        <input type="button" name="button" id="submit" value="提交内容" />
                <div id="result"></div>
            </form>
            </div>
        </div>

        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/public.js"></script>
        <script type="text/javascript" src="<?php echo base_url().TP_DIR; ?>/UE/ueditor.config.js"></script>
        <script type="text/javascript" src="<?php echo base_url().TP_DIR; ?>/UE/ueditor.all.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/addCode.js"></script>


        <script type="text/javascript">
            var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
            document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F1ddcbc50b79f09d34cdb6c127f894bf5' type='text/javascript'%3E%3C/script%3E"));
        </script>
    </body>
</html>