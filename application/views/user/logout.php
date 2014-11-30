<?php

header("content-type: text/html; charset=utf8");
echo "退出成功";
echo "<br />正在跳转到登录页面...";

$returnPage = base_url().'user/login';
echo "<br />如果浏览器没有反应，请点击<a href=\"". $returnPage ."\">这里</a>.";
echo "<script type='text/javascript'>";
echo "window.setTimeout(\"window.location='". $returnPage ."'\",1000); ";
echo "</script>";
exit();