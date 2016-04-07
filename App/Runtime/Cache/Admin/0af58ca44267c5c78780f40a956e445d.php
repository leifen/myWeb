<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title><?php echo L('home'); if($ur_here): ?>--<?php echo ($ur_here); endif; ?></title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/public.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/global.js"></script>

</head>
<body>

<div id="dcWrap">
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
        <!-- 当前位置 -->
<div id="urHere"><?php echo L('home');?>
    <?php if($ur_here): ?><b>></b><strong><?php echo ($ur_here); ?></strong><?php endif; ?>
</div>
        
    <div id="index" class="mainBox">

<!--------------------------单页面管理-------------------------------------->
        <div class="indexBox">
            <div class="boxTitle"><?php echo L('title_page');?></div>
            <ul class="ipage">
                <?php if(is_array($page_list)): $i = 0; $__LIST__ = $page_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$page_list): $mod = ($i % 2 );++$i; if(($page_list['level']) > "0"): ?><a href="<?php echo U('Page/edit',array('id'=>$page_list['id']));?>" class="child<?php echo ($page_list["level"]); ?>"><?php echo ($page_list["page_name"]); ?></a>
                        <?php else: ?>
                        <a href="<?php echo U('Page/edit',array('id'=>$page_list['id']));?>"><?php echo ($page_list["page_name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </ul>
        </div>
        <!--------------------------网站基本信息-------------------------------------->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="indexBoxTwo">
            <tr>
                <td width="65%" valign="top" class="pr">
                    <div class="indexBox">
                        <div class="boxTitle"><?php echo L('title_site_info');?></div>
                        <ul>
                            <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
                                <tr>
                                    <td width="120"><?php echo L('num_page');?>：</td>
                                    <td><strong><?php echo ($sys_info["num_page"]); ?></strong></td>
                                    <td width="100"><?php echo L('num_article');?>：</td>
                                    <td><strong><?php echo ($sys_info["num_article"]); ?></strong></td>
                                </tr>
                                <tr>
                                    <td><?php echo L('num_product');?>：</td>
                                    <td><strong><?php echo ($sys_info["num_product"]); ?></strong></td>
                                    <td><?php echo L('language');?>：</td>
                                    <td><strong><?php echo ($site["language"]); ?></strong></td>
                                </tr>
                                <tr>
                                    <td><?php echo L('dou_version');?>：</td>
                                    <td><strong><?php echo ($sys_info["tp_ver"]); ?></strong></td>
                                    <td><?php echo L('charset');?>：</td>
                                    <td><strong><?php echo ($sys_info["charset"]); ?></strong></td>
                                </tr>
                                <tr>
                                    <td><?php echo L('site_theme');?>：</td>
                                    <td><strong><?php echo ($site["site_theme"]); ?></strong></td>
                                    <td><?php echo L('build_date');?>：</td>
                                    <td><strong><?php echo ($sys_info["build_date"]); ?></strong></td>
                                </tr>
                            </table>
                        </ul>
                    </div>
                </td>
                <td valign="top" class="pl">
                    <div class="indexBox">
                        <div class="boxTitle"><?php echo ($title_admin_log); ?></div>
                        <ul>
                            <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
                                <tr>
                                    <th width="45%"><?php echo L('manager_log_ip');?></th>
                                    <th width="55%"><?php echo L('manager_log_create_time');?></th>
                                </tr>
                                <?php if(is_array($log_list)): $i = 0; $__LIST__ = $log_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log_list): $mod = ($i % 2 );++$i;?><tr>
                                    <td align="center"><?php echo ($log_list["ip"]); ?></td>
                                    <td align="center"><?php echo (date('Y-d-m H:i:s',$log_list["create_time"])); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </table>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>

<!--------------------------服务器信息-------------------------------------->
        <div class="indexBox">
            <div class="boxTitle"><?php echo L('title_sys_info');?></div>
            <ul>
                <table width="100%" border="0" cellspacing="0" cellpadding="7" class="tableBasic">
                    <tr>
                        <td width="120" valign="top"><?php echo L('php_version');?>：</td>
                        <td valign="top"><?php echo ($sys_info["php_ver"]); ?> </td>
                        <td width="100" valign="top"><?php echo L('mysql_version');?>：</td>
                        <td valign="top"><?php echo ($sys_info["mysql_ver"]); ?></td>
                        <td width="100" valign="top"><?php echo L('os');?>：</td>
                        <td valign="top"><?php echo ($sys_info["os"]); ?>(<?php echo ($sys_info["ip"]); ?>)</td>
                    </tr>
                    <tr>
                        <td valign="top"><?php echo L('max_filesize');?>：</td>
                        <td valign="top"><?php echo ($sys_info["max_filesize"]); ?></td>
                        <td valign="top"><?php echo L('gd');?>：</td>
                        <td valign="top"><?php echo ($sys_info["gd"]); ?></td>
                        <td valign="top"><?php echo L('web_server');?>：</td>
                        <td valign="top"><?php echo ($sys_info["web_server"]); ?></td>
                    </tr>
                </table>
            </ul>
        </div>

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
</body>
</html>