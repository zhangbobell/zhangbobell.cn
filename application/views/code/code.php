<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title?></title>
        <meta charset="UTF-8">
        <meta name="keywords" content="<?php echo $code->title; ?> zhangbobell zhangbobell.cn zhangbo 个人主页" />
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
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-impromptu.min.css">
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-impromptu.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/prettify.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/codeDetail.js"></script>
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
                <li><a href="<?php echo base_url();?>code/feelings">心情</a></li>
                <li><a href="<?php echo base_url();?>code/updateInfo">更新</a></li>
                <li><a href="<?php echo base_url();?>code/aboutme">关于我</a></li>
            </ul>
    </div>
        <input type="hidden" id="aid" value="<?php echo $code->id;?>">
        <div class="auto mt20 w980"><h2 class="ml20 mr20"><?php echo $code->title;?></h2></div>
        <div class="auto mt20 w980"><h6 class="ml20 mr20">更新时间：<?php echo $code->updatetime;?>&nbsp;&nbsp;阅读数：<?php echo $code->click;?></h6></div>
    <div class="auto mt5 w980">
        
        <!-- main content -->
        <div class="l w680 pl20 pr20 mt5 mb30 pb10 bbe" id="content">         
            <?php echo $code->content;?>
        </div>
        <!-- end main content -->
        
        <!-- lasted article -->
        <div class="w220 l ml20 p5">
            <h4 class="b">最近更新文章</h4>
            <ul id="recentArticle" class="mt5 codeList">
                <?php foreach($lasted as $v): ?>
                <li><a href="./<?php echo $v?>" title="<?php echo $v?>"><?php echo $v?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        <!-- end lasted article -->
        
        
        <!-- comments -->
        <div class="l w680 pl20 pr20">
            <h2 class="lh64 commentNum"></h2>
            
            <!-- comment list -->
            <ul class="commentList pb30 mb15">
                <!-- added by ajax function -- getComment -->
            </ul>
            <!-- end comment list -->
            
            
            <!-- comment form -->
            <form method="post" action="#" class="commentForm">
                <h3 class="lh56">发表评论</h3>
                <div class="control">
                    <label class="controlLabel" for="name">您的昵称：&nbsp;</label><input type="text" id="name" name="name" maxlength="32" /><span class="required nameInfo">（必填）</span>
                </div>
                <div class="control">
                    <label class="controlLabel" for="email">电子邮件：&nbsp;</label><input type="text" id="email" name="email" maxlength="50" /><span class="required emailInfo">（必填，不会被公开）</span>
                </div>
                <div class="control">
                    <label class="controlLabel" for="url">个人主页：&nbsp;</label><input type="text" id="url" name="url" maxlength="50" /><span class="urlInfo"></span>
                </div>
                <div class="control">
                <label class="controlLabel" for="comment">评论内容：&nbsp;</label><span class="required commentInfo"></span><br />
                <textarea onpropertychange="if(value.length>100) value=value.substr(0,500)"  id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="请留下您的评论..."></textarea>
                </div>
                <input type="button" class="btn" id="submitComment" value="提 交">
            </form>
            <!-- end comment form -->
            
        </div>
        <!-- end comments -->
        
        
        <div class="fix"></div>    
    </div>
        <div class="auto w980 gc f16 tc p5 btd h60">&copy;&nbsp;<?php echo date('Y')?> zhangbobell.cn</div>
        
    </body>
</html>