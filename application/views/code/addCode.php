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
                <li><a href="<?php echo base_url();?>code/feelings">心情</a></li>
                <li><a href="<?php echo base_url();?>code/updateInfo">更新</a></li>
            </ul>
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
		<textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
		<br />
		<input type="button" name="button" id="submit" value="提交内容" />
                <input type="button" name="button" id="save" value="保存草稿" />
                <div id="result"></div>
            </form>
            </div>
        </div>

    </body>
</html>