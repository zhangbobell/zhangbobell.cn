<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="user-scalable=no,width=device-width, minimum-scale=0.5, maximum-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/zxx.lib.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/base.css">
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/public.js"></script>
        <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F1ddcbc50b79f09d34cdb6c127f894bf5' type='text/javascript'%3E%3C/script%3E"));
</script>
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
            <div class="auto mt20 w700 pl50 m-list">
                <?php if(!isset($list)||$list===NULL)die("没有代码"); ?>
                <?php foreach ($list as $key=> $item):?>
                    <ul class="codeList">
                        <span><?php echo $key?></span>
                        <?php foreach ($item as $v):?>
                        <li><a href="<?php echo base_url();?>code/detail/<?php echo urlencode($v->title); ?>"><?php echo $v->title; ?></a></li>
                        <?php endforeach;?>
                    </ul>
                <?php endforeach;?>
                
                <div class="pagination"><?php echo $pagination;?><div class="fix"></div></div>
            </div>
            <div class="auto w700 gc f16 tc p15 btd h60 m-footer">&copy;&nbsp;<?php echo date('Y')?> zhangbobell.cn</div>
        </div>

    </body>
</html>