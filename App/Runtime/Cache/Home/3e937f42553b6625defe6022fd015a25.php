<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ($config["site_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["site_description"]); ?>" />
<title><?php echo ($config["site_name"]); ?>- Powered by ThinkPHP</title>
    <link rel="stylesheet" type="text/css" href="/myweb/Public/Home/css/style.css" />
    <script type="text/javascript" src="/myweb/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/myweb/Public/Home/js/global.js"></script>
    <script type="text/javascript" src="/myweb/Public/Home/js/slide_show.js"></script>

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
            <a href="<?php echo ($config["root_url"]); ?>"><img src="/myweb/<?php echo ($config["site_logo"]); ?>" alt="<?php echo ($config["site_name"]); ?>" title="<?php echo ($config["site_name"]); ?>" /></a>
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
    

    <div class="wrap mb">

        <div id="pageLeft">
            <div class="treeBox">
                <h3><?php echo L('case_tree');?></h3>
                <ul>
                    <?php if(is_array($case_category)): $i = 0; $__LIST__ = $case_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i; if($cate['cur']): ?><li class="cur"><?php else: ?><li><?php endif; ?>
                            <a href="<?php echo ($cate["url"]); ?>"><?php echo ($cate["cat_name"]); ?></a>
                        </li>

                    <?php if($cate['child']): ?><ul>
                            <?php if(is_array($cate['child'])): $i = 0; $__LIST__ = $cate['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i; if($child['cur']): ?><li class="cur"><?php else: ?><li><?php endif; ?>
                                 -<a href="<?php echo ($child["url"]); ?>"><?php echo ($child["cat_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>

        <div id="pageIn">

            <div class="urHere"><?php echo L('ur_here');?>：
                <a href="<?php echo ($config["root_url"]); ?>"><?php echo L('home');?></a><b>></b>
                <a href="<?php echo ($system_module["case_category"]); ?>"><?php echo L('case_category');?></a>
                <?php if($ur_here): ?><b>></b><?php echo ($ur_here); endif; ?>
            </div>

            <div class="productList">
                <?php if(is_array($case_list)): $k = 0; $__LIST__ = $case_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$case): $mod = ($k % 2 );++$k; if($k == count($case_list)): ?><dl class="last"><?php else: ?><dl><?php endif; ?>
                    <dt>
                        <a href="<?php echo ($case["url"]); ?>">
                        <img src="<?php echo ($case["thumb"]); ?>" alt="<?php echo ($case["name"]); ?>" width="<?php echo ($config["thumb_width"]); ?>" height="<?php echo ($config["thumb_height"]); ?>" />
                        </a>
                        <p class="name"><a href="<?php echo ($case["url"]); ?>" title="<?php echo ($case["name"]); ?>"><?php echo ($case["name"]); ?></a></p>
                    </dt>
                    </dl><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </div>
            <div class="pager"><?php echo ($page); ?></div>
        </div>
        <div class="clear"></div>
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
</html>