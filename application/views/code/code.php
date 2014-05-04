<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title?></title>
        <meta charset="UTF-8">
        <meta name="keywords" content="zhangbo zhangbobell.cn zhangbobell 个人主页">
        <meta name="description" content="<?php
            preg_match_all("/[\x{4e00}-\x{9fa5}]*[\，]*[0-9]*/u", $code->content, $match);
            $desc="";
            foreach ($match[0] as $v)
            {
                $desc.=$v;
                if(strlen($desc)>297)
                    break;
            }
            echo $desc ?>"   
        />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/base.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/zxx.lib.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/prettify.css">
        <script type="text/javascript" src="<?php echo base_url();?>public/js/prettify.js"></script>
        <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F1ddcbc50b79f09d34cdb6c127f894bf5' type='text/javascript'%3E%3C/script%3E"));
</script>
    </head>
    <body onload="prettyPrint()">
    <div class="top">
            <ul class="navBar">
                <a href="<?php echo base_url();?>"><img class="logo" src="<?php echo base_url();?>public/images/logo.png" width="125px" height="18px" alt="logo" /></a>
                <li><a href="<?php echo base_url();?>">主页</a></li>
                <li><a href="<?php echo base_url();?>code/codeList">代码</a></li>
            </ul>
    </div>
        <div class="auto mt20 w980"><h2 class="ml20 mr20"><?php echo $code->title;?></h2></div>
        <div class="auto mt20 w980"><h6 class="ml20 mr20"><?php echo $code->updatetime;?></h6></div>
    <div class="auto mt5 w980">
        <div class="l w680 pl20 pr20 mt5 mb30" id="content">         
            <?php echo $code->content;?>
        </div>
        <div class="w220 l ml20 p5">
            <h4 class="b">最近更新文章</h4>
            <ul id="recentArticle" class="mt5 codeList">
                <?php foreach($lasted as $v): ?>
                <li><a href="./<?php echo $v?>" title="<?php echo $v?>"><?php echo $v?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="fix"></div>    
    </div>
        <div class="auto w980 gc f16 tc p5 btd h60">&copy;&nbsp;<?php echo date('Y')?> zhangbobell.cn</div>
        
    </body>
</html>