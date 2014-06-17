<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title?></title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/base.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/zxx.lib.css">
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
                    <li><a href="<?php echo base_url();?>code/aboutme">关于我</a></li>
                </ul>
            </div>
            <div class="auto mt20 w980">
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
            <div class="auto w980 gc f16 tc p5 btd h60">&copy;&nbsp;<?php echo date('Y')?> zhangbobell.cn</div>
        </div>

    </body>
</html>