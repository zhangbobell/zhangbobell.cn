<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url(); ?>"/>
    <title>用户登录</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url() . TP_DIR; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url() . CSS_DIR; ?>/login.css" rel="stylesheet" media="screen">
</head>
<body>

<div class="container">

    <form class="form-signin" name="form1" method="post" action="checklogin.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Username" autofocus>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">
        <!-- The checkbox remember me is not implemented yet...
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <div id="message"></div>
    </form>

</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url() . TP_DIR; ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() . TP_DIR; ?>/jquery.md5/jquery.md5.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url() . TP_DIR; ?>/bootstrap/js/bootstrap.min.js"></script>
<!-- The AJAX login script -->
<script src="<?php echo base_url() . JS_DIR; ?>/user/login.js"></script>


</body>
</html>