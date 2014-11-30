<?php
if(!$this->session->userdata('id'))
{
    header("content-type: text/html; charset=utf8");
    echo "该页面需要登录";
    echo "<br />正在跳转到登录页面...";

    $returnPage = base_url().'user/login';
    echo "<br />如果浏览器没有反应，请点击<a href=\"". $returnPage ."\">这里</a>.";
    echo "<script type='text/javascript'>";
    echo "window.setTimeout(\"window.location='". $returnPage ."'\",1000); ";
    echo "</script>";
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo base_url(); ?>"/>
    <title><?php echo $title?> zhangbobell.cn</title>
    <link rel="stylesheet" href="<?php echo base_url().TP_DIR?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_DIR?>/zxx.lib.css">
