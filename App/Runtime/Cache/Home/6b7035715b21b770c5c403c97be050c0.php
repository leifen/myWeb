<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo L('home');?>--<?php echo ($msgTitle); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ($config["site_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["site_description"]); ?>" />
<title><?php echo ($config["site_name"]); ?>- Powered by ThinkPHP</title>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css" />
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/global.js"></script>
    <script type="text/javascript" src="/Public/Home/js/slide_show.js"></script>

</head>
<body>

	<div id="wrapper">
		<div id="top">
    <div class="wrap">
        <ul class="topNav">
            <?php if(is_array($nav_top_list)): $i = 0; $__LIST__ = $nav_top_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if($nav['child']): ?><li class="parent"><a href="<?php echo ($nav["url"]); ?>"><?php echo ($nav["nav_name"]); ?><s></s></a>
                        <ul>
                            <?php if(is_array($nav['child'])): $i = 0; $__LIST__ = $nav['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($child["url"]); ?>"><?php echo ($child["nav_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <?php if($nav['target']): ?><a href="<?php echo ($nav["url"]); ?>" target="_blank">
                            <?php else: ?>
                            <a href="<?php echo ($nav["url"]); ?>"><?php endif; ?>
                            <?php echo ($nav["nav_name"]); ?>
                        </a><s></s>
                    </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <li><a href="javascript:AddFavorite('<?php echo ($config["root_url"]); ?>', '<?php echo ($config["site_name"]); ?>')"><?php echo L('add_favorite');?></a></li>
        </ul>
    </div>
</div>

<div id="header">
    <div class="wrap clearfix">
        <ul class="logo">
            <a href="<?php echo ($config["root_url"]); ?>"><img src="/<?php echo ($config["site_logo"]); ?>" alt="<?php echo ($config["site_name"]); ?>" title="<?php echo ($config["site_name"]); ?>" /></a>
        </ul>
    </div>
</div>
<div id="mainNav">
    <ul class="wrap">
        <?php if($index['cur']): ?><li class="cur"><a href="<?php echo ($config["root_url"]); ?>" class="first"><?php echo L('home');?></a></li>
            <?php else: ?>
            <li class=""><a href="<?php echo ($config["root_url"]); ?>" class="first"><?php echo L('home');?></a></li><?php endif; ?>

        <?php if(is_array($nav_middle_list)): $k = 0; $__LIST__ = $nav_middle_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($k % 2 );++$k; if($nav['cur']): ?><li class="cur hover"><?php else: ?><li class=""><?php endif; ?>

                <?php if(($k) == "7"): ?><a href="<?php echo ($nav["url"]); ?>" class="last"><?php echo ($nav["nav_name"]); ?></a>
                <?php else: ?>
                    <a href="<?php echo ($nav["url"]); ?>"><?php echo ($nav["nav_name"]); ?></a><?php endif; ?>

            <?php if($nav['child']): ?><ul>
                    <?php if(is_array($nav['child'])): $i = 0; $__LIST__ = $nav['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><li>
                            <?php if($child['child']): ?><a href="<?php echo ($child["url"]); ?>" class="parent"><?php echo ($child["nav_name"]); ?></a>
                                <?php else: ?>
                                <a href="<?php echo ($child["url"]); ?>" class=""><?php echo ($child["nav_name"]); ?></a><?php endif; ?>

                            <?php if($child['child']): ?><ul>
                                    <?php if(is_array($child['child'])): $i = 0; $__LIST__ = $child['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$children): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($children["url"]); ?>"><?php echo ($children["nav_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul><?php endif; ?>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul><?php endif; ?>

            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="clear"></div>
    </ul>
</div>
<!-- dcHead 结束 -->
		<div id="douMsg" class="wrap">
			<dl>
				<?php if ($status) {?>
				<dt><?php echo($message); ?></dt>
					<dd>
						如果您不做出选择，将在 <a id="href" href="<?php echo($jumpUrl); ?>"><b id="wait"><?php echo($waitSecond); ?></b> </a> 秒后跳转到上一页面，您也可以手动点击
						<a href="<?php echo($jumpUrl); ?>">{:L('msg_back')}</a>
					</dd>
				<?php } else { ?>
				<dt><?php echo($error); ?></dt>
					<dd>
						如果您不做出选择，将在 <a id="href" href="<?php echo($jumpUrl); ?>"><b id="wait"><?php echo($waitSecond); ?></b> </a> 秒后跳转到上一页面，您也可以手动点击
						<a href="<?php echo($jumpUrl); ?>"><?php echo L('msg_back');?></a>
					</dd>
				<?php } ?>

			</dl>
		</div>
		<?php if($config['qq']): ?><div id="onlineService">
        <div class="onlineIcon"><?php echo L('online');?></div>
        <div id="pop">
            <ul class="onlineQQ">
                <?php if(is_array($config['qq'])): $i = 0; $__LIST__ = $config['qq'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qq): $mod = ($i % 2 );++$i; if(is_array($qq)): ?><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($qq["number"]); ?>&site=qq&menu=yes" target="_blank"><?php echo ($qq["nickname"]); ?></a>
                    <?php else: ?>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($qq); ?>&site=qq&menu=yes" target="_blank"><?php echo L('online_qq');?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="service">
                <li><?php echo L('contact_tel');?><br /><?php echo ($config["tel"]); ?></li>
                <?php if($system_module['guestbook']): ?><li><a href="<?php echo ($system_module["guestbook"]); ?>"><?php echo L('guestbook_add');?></a></li><?php endif; ?>
            </ul>
        </div>
        <p class="goTop"><a href="javascript:;" onfocus="this.blur();" class="goBtn"></a></p>
    </div><?php endif; ?>
		<div id="footer">
    <div class="wrap">
        <div class="footNav">
            <?php if(is_array($nav_bottom_list)): $k = 0; $__LIST__ = $nav_bottom_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($k % 2 );++$k;?><a href="<?php echo ($nav["url"]); ?>"><?php echo ($nav["nav_name"]); ?></a>
            <?php if($k != count($nav_bottom_list)): ?><i>|</i><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="copyRight"><?php echo ($config["copyright"]); ?> <?php echo L('powered_by');?>
            <?php if($config['icp']): ?><a href="http://www.miibeian.gov.cn/" target="_blank"><?php echo ($config["icp"]); ?></a><?php endif; ?>
        </div>
    </div>
</div>
<?php if($config['code']): ?><div style="display:none"><?php echo ($config["code"]); ?></div><?php endif; ?>
	</div>

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