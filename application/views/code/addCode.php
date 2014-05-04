<?php
	$htmlData = '';
	if (!empty($_POST['content1'])) {
		if (get_magic_quotes_gpc()) {
			$htmlData = stripslashes($_POST['content1']);
		} else {
			$htmlData = $_POST['content1'];
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title?></title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/base.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/zxx.lib.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/default.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/prettify.css" />
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/addCode.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/kindeditor.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/zh_CN.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/prettify.js"></script>
        <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F1ddcbc50b79f09d34cdb6c127f894bf5' type='text/javascript'%3E%3C/script%3E"));
</script>
    </head>
    <body>
        <div class="pct100">
            <div class="top">
            <ul class="navBar">
                <a href="<?php echo base_url();?>"><img class="logo" src="<?php echo base_url();?>public/images/logo.png" width="125px" height="18px" alt="logo" /></a>
                <li><a href="<?php echo base_url();?>">主页</a></li>
                <li><a href="<?php echo base_url();?>code/codeList">代码</a></li>
            </ul>
            </div>
            <div class="auto mt20 w980">
                <div id="result"></div>
<!--                <form action="./addCodeData" method="post">
                    标题：<input type="text" placeholder="请输入标题" width="10" class="mt10 mb10" name="title" id="title"><br />
                    内容：<br /><textarea rows="20" cols="60" name="content" id="content" class="mt10 mb10" placeholder="请输入内容"></textarea><br />
                    <input class="ml80" type="button" name="submit" id="submit" value="提交">
            </form>-->
            <form name="example" method="post" action="addCodeData">
                标题：<input type="text" placeholder="请输入标题" width="10" class="mt10 mb10" name="title" id="title" /><br />
                内容：<br />
		<textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
		<br />
		<input type="button" name="button" id="submit" value="提交内容" /> (提交快捷键: Ctrl + Enter)
            </form>
            </div>
        </div>

    </body>
</html>