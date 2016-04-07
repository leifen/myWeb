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

        <div class="urHere">
            <?php echo L('ur_here');?>：
            <a href="<?php echo ($config["root_url"]); ?>"><?php echo L('home');?></a>
            <?php if($ur_here): ?><b>></b><?php echo ($ur_here); endif; ?>
        </div>

        <div id="guestBook">
            <?php if($guestbook): ?><h2><?php echo ($lang["guestbook"]); ?></h2>
            <div class="bookList">
                <?php if(is_array($guestbook)): $i = 0; $__LIST__ = $guestbook;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$guestbook): $mod = ($i % 2 );++$i;?><dl>
                    <dt><?php echo L('guestbook_title');?>：<?php echo ($guestbook["title"]); ?> <b><?php echo (date('Y-m-d',$guestbook["add_time"])); ?></b></dt>
                    <dd><em><?php echo L('guestbook_content');?>：</em><span><?php echo ($guestbook["content"]); ?></span></dd>
                    <?php if($guestbook['reply']): ?><p><em><?php echo L('guestbook_reply');?>：</em><span><?php echo ($guestbook["reply"]); ?></span><b><?php echo ($guestbook["reply_time"]); ?></b></p><?php endif; ?>
                </dl><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="pager"><?php echo ($page); ?></div>
            </div><?php endif; ?>


            <h2><?php echo L('guestbook_add');?></h2>
            <div class="bookAdd">
                <form id="bookAdd" action="<?php echo U('GuestBook/insert');?>" method="post">
                    <dl>
                        <dt><?php echo L('guestbook_title');?>：</dt>
                        <dd>
                            <input type="text" name="title" value="<?php echo ($post["title"]); ?>" size="80" class="textInput" />

                        </dd>
                    </dl>
                    <dl>
                        <dt><?php echo L('guestbook_name');?>：</dt>
                        <dd>
                            <input type="text" name="name" value="<?php echo ($post["name"]); ?>" size="55" class="textInput" />

                        </dd>
                    </dl>
                    <dl>
                        <dt><?php echo L('guestbook_contact_type');?>：</dt>
                        <dd>
                            <select name="contact_type" class="select">
                                <option value=""><?php echo L('select');?></option>
                                <?php echo ($option); ?>
                            </select>
                            <input type="text" name="contact" value="<?php echo ($post["contact"]); ?>" size="60" class="textInput" />

                        </dd>
                    </dl>

                    <dl>
                        <dt><?php echo L('guestbook_content');?>：</dt>
                        <dd>
                            <textarea name="content" cols="90" rows="5" class="textArea" /></textarea>

                        </dd>
                    </dl>
                    <?php if($config['captcha']): ?><dl>
                        <dt><?php echo L('captcha');?>：</dt>
                        <dd>
                            <input type="text" name="captcha" class="textArea captcha" size="10">
                            <img id="vcode" src="<?php echo U('Admin/Login/vcode');?>" alt="<?php echo L('captcha');?>" border="1" onClick="refreshimage()" title="<?php echo L('captcha_refresh');?>">

                        </dd>
                    </dl><?php endif; ?>
                    <dl class="submit">
                        <input type="submit" class="btn" value="<?php echo L('btn_submit');?>"/>
                    </dl>
                </form>
            </div>
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