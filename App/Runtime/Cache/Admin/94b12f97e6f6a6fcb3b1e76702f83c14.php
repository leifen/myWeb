<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo L('home');?>--<?php echo ($msgTitle); ?></title>
<meta charset="UTF-8">
<title><?php echo L('home'); if($ur_here): ?>--<?php echo ($ur_here); endif; ?></title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/public.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/global.js"></script>

</head>
<body>

<?php if(session('auth')): ?><div id="dcWrap">
		<div id="dcHead">
    <div id="head">
        <div class="logo"><a href="index.php"><img src="/Public/Admin/images/dclogo.gif" alt="logo"></a></div>
        <div class="nav">
            <ul>
                <li class="M"><a href="JavaScript:void(0);" class="topAdd"><?php echo L('top_add');?></a>
                    <div class="drop mTopad">
                        <?php if($system['open']['product']): ?><a href="<?php echo U('Product/create');?>"><?php echo L('top_add_product');?></a><?php endif; ?>
                        <?php if($system['open']['article']): ?><a href="<?php echo U('Article/create');?>"><?php echo L('top_add_article');?></a><?php endif; ?>
                        <?php if($system['open']['project']): ?><a href="<?php echo U('Project/create');?>"><?php echo L('nav_project');?></a><?php endif; ?>
                        <?php if($system['open']['case']): ?><a href="<?php echo U('Case/create');?>"><?php echo L('nav_case');?></a><?php endif; ?>
                        <a href="<?php echo U('Nav/create');?>"><?php echo L('top_add_nav');?></a>
                        <a href="<?php echo U('Show/index');?>"><?php echo L('top_add_show');?></a>
                        <a href="<?php echo U('Page/create');?>"><?php echo L('top_add_page');?></a>
                        <a href="<?php echo U('Manager/create');?>"><?php echo L('top_add_manager');?></a>
                    </div>
                </li>
                <li><a href="<?php echo U('Home/Index/index');?>" target="_blank"><?php echo L('top_go_site');?></a></li>
                <li><a href="<?php echo U('Index/clear_cache');?>"><?php echo L('clear_cache');?></a></li>
                <li><a href="http://wpa.qq.com/msgrd?&uin=287715706&site=qq&menu=yes" target="_blank"><?php echo L('top_help');?></a></li>
            </ul>
            <ul class="navRight">
                <li class="M noLeft"><a href="JavaScript:void(0);"><?php echo L('top_welcome'); echo session('auth')['user_name'];?></a>
                    <div class="drop mUser">
            <a href="<?php echo U('Manager/edit',array('id'=>session('auth')['user_id']));?>"><?php echo L('top_manager_edit');?></a>
        </div>
        </li>
        <li class="noRight"><a href="<?php echo U('Login/logout');?>"><?php echo L('top_logout');?></a></li>
        </ul>
        </div>
    </div>
</div>
<!-- dcHead 结束 -->
		<div id="dcLeft">
			<div id="menu">
    <ul class="top">
        <?php if(($cur) == "index"): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
            <a href="<?php echo U('Index/index');?>"><i class="home"></i> <em><?php echo L('menu_home');?></em></a></li></ul>
    <ul>
        <?php if(($cur) == "system"): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
            <a href="<?php echo U('Config/index');?>"><i class="system"></i><em><?php echo L('system');?></em></a>
        </li>
        <?php if(($cur) == "nav"): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
            <a href="<?php echo U('Nav/index');?>"><i class="nav"></i><em><?php echo L('nav');?></em></a>
        </li>
        <?php if(($cur) == "show"): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
            <a href="<?php echo U('Show/index');?>"><i class="show"></i><em><?php echo L('show');?></em></a>
        </li>
        <?php if(($cur) == "page"): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
             <a href="<?php echo U('Page/index');?>"><i class="page"></i><em><?php echo L('menu_page');?></em></a>
        </li>
    </ul>

    <?php if(is_array($menu_list['column'])): $i = 0; $__LIST__ = $menu_list['column'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><ul>
        <?php if(($cur) == $menu["name_category"]): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
             <a href='<?php echo ($menu["url_category"]); ?>'><i class="<?php echo ($menu["name"]); ?>Cat"></i><em><?php echo ($menu["lang_category"]); ?></em></a>
        </li>
        <?php if(($cur) == $menu["name"]): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
            <a href="<?php echo ($menu["url"]); ?>"><i class="<?php echo ($menu["name"]); ?>Cat"></i><em><?php echo ($menu["lang"]); ?></em></a>
        </li>
    </ul><?php endforeach; endif; else: echo "" ;endif; ?>

    <?php if($menu_list['single']): ?><ul>
        <?php if(is_array($menu_list['single'])): $i = 0; $__LIST__ = $menu_list['single'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if(($cur) == $menu["name"]): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
            <a href="<?php echo ($menu["url"]); ?>"><i class="<?php echo ($menu["name"]); ?>"></i><em><?php echo ($menu["lang"]); ?></em></a></li>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul><?php endif; ?>

    <ul class="bot">
        <?php if(($cur) == "manager"): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
             <a href="<?php echo U('Manager/index');?>"><i class="manager"></i><em><?php echo L('manager');?></em></a>
        </li>
        <?php if(($cur) == "manager_log"): ?><li class="cur"> <?php else: ?><li><?php endif; ?>
            <a href="<?php echo U('Log/index');?>"><i class="managerLog"></i><em><?php echo L('manager_log');?></em></a>
        </li>
    </ul>
</div>
		</div>
		<div id="dcMain">
			<div id="urHere"><?php echo L('home');?><b>></b><strong><?php echo L('msg');?></strong>
			</div>
			<div class="mainBox">
				<h3><?php echo L('msg');?></h3>
				<div id="douMsg">
					<?php if ($status) {?>
					<h2><?php echo($message); ?></h2>
					<dl>
						<dt><p class="jump">如果您不做出选择，将在 <a id="href" href="<?php echo($jumpUrl); ?>"><b id="wait"><?php echo($waitSecond); ?></b> 秒后跳转到上一个链接地址。</a></p></dt>
						<dd><a href="<?php echo($jumpUrl); ?>"><?php echo(L('msg_back')); ?></a></dd>
					</dl>
					<?php } else { ?>
					<h2><?php echo($error); ?></h2>
					<dl>
						<dt><p class="jump">如果您不做出选择，将在 <a id="href" href="<?php echo($jumpUrl); ?>"><b id="wait"><?php echo($waitSecond); ?></b> 秒后跳转到上一个链接地址。</a></p></dt>
						<dd><a href="<?php echo($jumpUrl); ?>"><?php echo L('msg_back');?></a></dd>
					</dl>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
<div id="dcFooter">
    <div id="footer">
        <div class="line"></div>
        <ul>
            <?php echo L('footer_copyright');?>
        </ul>
    </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div>
	</div>

<?php else: ?>

	<div id="outMsg">

		<?php if ($status) {?>
		<h2><?php echo($message); ?></h2>
		<dl>
			<dt><p class="jump">如果您不做出选择，将在 <a id="href" href="<?php echo($jumpUrl); ?>"><b id="wait"><?php echo($waitSecond); ?></b> 秒后跳转到上一个链接地址。</a></p></dt>
			<dd><a href="<?php echo($jumpUrl); ?>"><?php echo(L('msg_back')); ?></a></dd>
		</dl>
		<?php } else { ?>
		<h2><?php echo($error); ?></h2>
		<dl>
			<dt><p class="jump">如果您不做出选择，将在 <a id="href" href="<?php echo($jumpUrl); ?>"><b id="wait"><?php echo($waitSecond); ?></b> 秒后跳转到上一个链接地址。</a></p></dt>
			<dd><a href="<?php echo($jumpUrl); ?>"><?php echo L('msg_back');?></a></dd>
		</dl>
		<?php } ?>

	</div><?php endif; ?>

</body>
<script type="text/javascript">
	(function(){
		var wait = document.getElementById('wait'),href = document.getElementById('href').href;
		var interval = setInterval(function(){
			var time = --wait.innerHTML;
			if(time <= 0) {
				location.href = href;
				clearInterval(interval);
			};
		}, 1000);
	})();
</script>
</html>