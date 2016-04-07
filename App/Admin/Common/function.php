<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/18
 * Time: 16:52
 */

    /**
     * 删除旧图片
     */
    function unlink_old_image($data, $uploadPath=null)
    {
        $image =explode('.',basename($data));
        unlink($data);
        if($uploadPath){
            $thumb = $uploadPath . 'thumb_' . $image['0'] .'.'. $image['1'];
            unlink($thumb);
        }
    }

    /**
     *清除系统缓存
     */
    function clear_cache($dir)
    {
        $dir = realpath($dir);
        if(!$dir || !@is_dir($dir))
            return 0;
        $handle = @opendir($dir);
        if($dir[strlen($dir)-1] != DIRECTORY_SEPARATOR)
            $dir .= DIRECTORY_SEPARATOR;
        while($file = @readdir($handle)){
            if($file != '.' && $file != '..'){
                if (@is_dir($dir . $file) && !is_link($dir . $file)) {
                    clear_cache($dir . $file);
                }else {
                    @unlink($dir . $file);
                }
            }
        }
        closedir($handle);
    }

    /**
     *email发送
     */
    function send_email($mailto, $subject = '', $body = '')
    {
        import('Admin.Common.Email.mail');
        import('Admin.Common.Email.smtp');
        $config = read_config();

        $mail = new PHPMailer();

        //$mail->SMTPDebug = 3;                               // 启用SMTP调试功能

        $mail->CharSet ="UTF-8";                              // 设定邮件编码
        $mail->isSMTP();                                      // 设定使用SMTP服务
        $mail->Host = $config['mail_host'];                   // SMTP服务器
        $mail->SMTPAuth = true;                               // 启用SMTP验证功能
        $mail->Username = $config['mail_username'];           // SMTP服务器用户名
        $mail->Password = $config['mail_password'];           // SMTP服务器密码
        if ($config['mail_ssl'])
            $mail->SMTPSecure = 'ssl';                        // 安全协议，可以注释掉
        $mail->Port = $config['mail_port'];                   // SMTP服务器的端口号

        $mail->From = $config['mail_username'];               // 发件人地址
        $mail->FromName = $config['site_name'];               // 发件人姓名
        $mail->addAddress($mailto, '');                       // 收件地址，可选指定收件人姓名

        $mail->isHTML(true);                                  // 是否HTML格式邮件

        $mail->Subject = $subject;                            // 邮件标题
        $mail->Body    = $body;                               // 邮件内容

        // 邮件正文不支持HTML的备用显示
        $mail->AltBody = L('mail_altbody');

        if($mail->send()) {
            return true;
        }

    }

    /**
     *找回密码验证
     * $data 数据集
     * $code 密码找回码
     * $timeout 默认为24小时(86400秒)
     */
    function check_password_reset($data, $code, $timeout = 86400)
    {
        if($data){
            //初始化
            $get_code = substr($code,0,20);
            $get_time = substr($code,20,30);
            $code = substr(sha1($data['user_name'].$data['email'].$data['password'].$get_time.$data['last_login']),0,20);
            // 验证链接有效性
            if (time() - $get_time < $timeout && $code == $get_code) return true;
        }
    }
