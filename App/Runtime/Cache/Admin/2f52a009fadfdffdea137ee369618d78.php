<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo L('home');?></title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/public.css" />
    <script type="text/javascript">
        function refreshimage() {
            var cap = document.getElementById('vcode');
            cap.src = cap.src + '?';
        }
    </script>
</head>
<body>
<div id="login">
    <div class="dologo"></div>

    <form action="<?php echo U('Login/login');?>" method="post">
        <ul>
            <li class="inpLi"><b><?php echo L('login_user_name');?>：</b><input type="text" name="user_name" class="inpLogin"></li>
            <li class="inpLi"><b><?php echo L('login_password');?>：</b><input type="password" name="password" class="inpLogin"></li>

            <?php if($site['captcha']): ?><li class="captchaPic">
                    <div class="inpLi"><b><?php echo L('login_captcha');?>：</b><input type="text" name="captcha" class="captcha"></div>
                    <img id="vcode" src="<?php echo U('Login/vcode');?>" alt="<?php echo L('captcha');?>" border="1" onClick="refreshimage()" title="<?php echo L('login_captcha_refresh');?>">
                </li><?php endif; ?>

            <li class="sub"><input type="submit" name="submit" class="btn" value="<?php echo L('login_submit');?>"></li>
            <li class="action">
                <a href="<?php echo U('Login/password_reset');?>"><?php echo L('login_password_forget');?>？</a>
                <em class="separator">|</em>
                <a href="<?php echo U('Home/Index/index');?>"><?php echo L('login_back');?></a>
            </li>
        </ul>
    </form>
</div>
</body>
</html>