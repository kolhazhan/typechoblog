<?php

/**
 * 在所需的区域输出UserAgent信息
 * @package UserAgent显示
 * @author 狱长
 * @version 1.2
 * @link https://www.xiaomaw.cn
 */

class XCCXOS_Plugin implements Typecho_Plugin_Interface {
    /**
     * 激活插件方法，如果激活失败，直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {
        //Typecho_Plugin::factory('Widget_Comments_Archive')->___useragent = ['XCCXOS_Plugin', 'render'];
    }

    /**
     * 禁用插件方法，如果禁用失败，直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate() {}

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form) {
        /* UserAgent信息 显示开关 */
        $UserAgentButton = new Typecho_Widget_Helper_Form_Element_Select('UserAgentButton', array(
            'on' => '开启（默认）',
            'off' => '关闭',
        ),"on",_t("UserAgent信息 显示开关"),'介绍：开启后，将激活插件并在插入代码之后显示UserAgent信息');
        $form->addInput($UserAgentButton->multiMode());
        
        /* 图标大小 */
        $size = new Typecho_Widget_Helper_Form_Element_Radio(
            'size',
            array('12' => _t('12px 大小'),'13'=>_t('13px 大小'),'14'=>_t('14px 大小'),'15'=>_t('15px 大小'),'16'=>_t('16px 大小'),'17'=>_t('17px 大小'),'18'=>_t('18px 大小')),
            '14','设置 显示图标 大小','');
        $form->addInput($size);

        /* 显示模式 */
        $display = new Typecho_Widget_Helper_Form_Element_Radio(
            'display', 
            array('0' => _t('样式1'),'1'=>_t('样式2'),'2'=>_t('样式3')),
            '0','设置 UserAgent 显示模式','');
        $form->addInput($display);
        
        /* 是否显示浏览器版本号 */
        $browser = new Typecho_Widget_Helper_Form_Element_Radio(
            'browser', 
            array('off' => _t('不显示(默认)'),'on'=>_t('显示')),
            'off','设置 浏览器版本号 显示','');
        $form->addInput($browser);
        
        /* 是否显示x64 Edition */
        $os = new Typecho_Widget_Helper_Form_Element_Radio(
            'os', 
            array('off'=>_t('不显示(默认)'),'on' => _t('显示')),
            'off','设置 Win系统x64 Edition 显示','');
        $form->addInput($os);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render($ua) {
        $options = Typecho_Widget::widget('Widget_Options');
        $data = Helper::options()->plugin('XCCXOS');
        /* 操作系统 */
        $os = self::get_os($ua);
        $osimg = self::imagelink("os", $os['code'], $os['title']);
        /* 浏览器 */
        $browser = self::get_browser_name($ua);
        $browserimg = self::imagelink("browser", $browser['code'], $browser['title']);
        //请勿乱改动 以免出现错误
        if (Helper::options()->plugin("XCCXOS")->UserAgentButton === "on"){
        /* 显示模式 */
        switch ($data->display) {
            case 0:
                $ua = '<img class="icon-ua" src="'.$osimg.'" title="'.$os['title'].'" alt="'.$os['title'].'" height="'.$data->size.'" style="vertical-align:-2px;margin-right:4px;" />  &nbsp;  <img class="icon-ua" src="'.$browserimg.'" title="'.$browser['title'].'" alt="'.$browser['title'].'" height="'.$data->size.'" style="vertical-align:-2px;margin-right:4px;" />';
                break;
            case 1:
                $ua = ''.$os['title'].' &nbsp; '.$browser['title'].'';
                break;
            case 2:
                $ua = '<img class="icon-ua" src="'.$osimg.'" title="'.$os['title'].'" alt="'.$os['title'].'" height="'.$data->size.'" style="vertical-align:-2px;margin-right:4px;" />  '.$os['title'].'  &nbsp;  <img class="icon-ua" src="'.$browserimg.'" title="'.$browser['title'].'" alt="'.$browser['title'].'" height="'.$data->size.'" style="vertical-align:-2px;margin-right:4px;" />  '.$browser['title'].'';
                break;
        }
        echo $ua;
        }else{
          echo '';  // UserAgent已关闭内容
        }
    }
    /**
     * 图标链接
     *
     * @access public
     * @return string
     */
    public static function imagelink($type, $name)
    {
        return Helper::options()->pluginUrl . '/XCCXOS/img/' . $type . '/' . $name . '.svg';
    }

    //获取系统 (请勿乱改动 以免出现错误)
    public static function get_os($ua)
    {
        $version = null;
        $code = null;

        if (preg_match('/Windows/i', $ua) || preg_match('/WinNT/i', $ua) || preg_match('/Win32/i', $ua)) {
            $title = 'Windows';
            if (preg_match('/Windows NT 11.0/i', $ua) || preg_match('/Windows NT 6.4/i', $ua)) {
                $version = '11';
                $code = 'Windows-10';
            }elseif (preg_match('/Windows NT 10.0/i', $ua) || preg_match('/Windows NT 6.4/i', $ua)) {
                $version = '10';
                $code = 'Windows-10';
            } elseif (preg_match('/Windows NT 6.3/i', $ua)) {
                $version = '8.1';
                $code = 'Windows-8';
            } elseif (preg_match('/Windows NT 6.2/i', $ua)) {
                $version = '8';
                $code = 'Windows-8';
            } elseif (preg_match('/Windows NT 6.1/i', $ua)) {
                $version = '7';
            } elseif (preg_match('/Windows NT 6.0/i', $ua)) {
                $version = 'Vista';
            } elseif (preg_match('/Windows NT 5.2 x64/i', $ua)) {
                $version = 'XP'; // x64 Edition very similar to Win 2003
            } elseif (preg_match('/Windows NT 5.2/i', $ua)) {
                $version = 'Server 2003';
            } elseif (preg_match('/Windows NT 5.1/i', $ua) || preg_match('/Windows XP/i', $ua)) {
                $version = 'XP';
            } elseif (preg_match('/Windows NT 5.01/i', $ua)) {
                $version = '2000 (SP1)';
            } elseif (preg_match('/Windows NT 5.0/i', $ua) || preg_match('/Windows NT5/i', $ua) || preg_match('/Windows 2000/i', $ua)) {
                $version = '2000';
            } elseif (preg_match('/Windows NT 4.0/i', $ua) || preg_match('/WinNT4.0/i', $ua)) {
                $version = 'NT 4.0';
            } elseif (preg_match('/Windows NT 3.51/i', $ua) || preg_match('/WinNT3.51/i', $ua)) {
                $version = 'NT 3.11';
            } elseif (preg_match('/Windows NT/i', $ua) || preg_match('/WinNT/i', $ua)) {
                $version = 'NT';
            } elseif (preg_match('/Windows 3.11/i', $ua) || preg_match('/Win3.11/i', $ua) || preg_match('/Win16/i', $ua)) {
                $version = '3.11';
            } elseif (preg_match('/Windows 3.1/i', $ua)) {
                $version = '3.1';
            } elseif (preg_match('/Windows 98; Win 9x 4.90/i', $ua) || preg_match('/Win 9x 4.90/i', $ua) || preg_match('/Windows ME/i', $ua)) {
                $version = 'ME';
            } elseif (preg_match('/Win98/i', $ua)) {
                $version = '98 SE';
            } elseif (preg_match('/Windows 98/i', $ua) || preg_match('/Windows\ 4.10/i', $ua)) {
                $version = '98';
            } elseif (preg_match('/Windows 95/i', $ua) || preg_match('/Win95/i', $ua)) {
                $version = '95';
            } elseif (preg_match('/Windows CE/i', $ua)) {
                $version = 'CE';
            } elseif (preg_match('/WM5/i', $ua)) {
                $version = 'Mobile 5';
            } elseif (preg_match('/WindowsMobile/i', $ua)) {
                $version = 'Mobile';
            }
        } elseif (strpos($ua, "Android 10; HarmonyOS;")!==false) {
            $title = 'HarmonyOS';
        } elseif (preg_match('/Android/i', $ua)) {
            $title = 'Android';
            if (preg_match('/Android[\ |\/]?([.0-9a-zA-Z]+)/i', $ua, $regmatch)) {
                $version = $regmatch[1];
            }
        } elseif (preg_match('/Mac/i', $ua) || preg_match('/Darwin/i', $ua)) {
            $title = 'Mac OS X';
            $code = 'Apple';
            if (preg_match('/Mac OS X/i', $ua) || preg_match('/Mac OSX/i', $ua)) {
                if (preg_match('/iPhone/i', $ua)) {
                    $title = 'iOS';
                    $version = substr($ua, strpos(strtolower($ua), strtolower('iPhone OS')) + 10);
                    // Parse iOS version number
                    $version = substr($version, 0, strpos($version, 'l') - 1);
                } elseif (preg_match('/iPad/i', $ua)) {
                    $title = 'iOS';
                    $version = substr($ua, strpos(strtolower($ua), strtolower('CPU OS')) + 7);
                    $version = substr($version, 0, strpos($version, 'l') - 1);
                } elseif (preg_match('/Mac OS X/i', $ua)) {
                    $version = substr($ua, strpos(strtolower($ua), strtolower('OS X')) + 5);
                    // Parse OS X version number
                    $version = substr($version, 0, strpos($version, ')'));
                } else {
                    $version = substr($ua, strpos(strtolower($ua), strtolower('OSX')) + 4);
                    $version = substr($version, 0, strpos($version, ')'));
                }
                // Parse OS X version number
                if (strpos($version, ';') > -1) {
                    $version = substr($version, 0, strpos($version, ';'));
                }
                // Beautify version format
                $version = str_replace('_', '.', $version);
            } elseif (preg_match('/Darwin/i', $ua)) {
                $title = 'Mac OS Darwin';
            } else {
                $title = 'Macintosh';
            }
        } elseif (preg_match('/[^A-Za-z]Arch/i', $ua)) {
            $title = 'Arch Linux';
            $code = 'Arch-Linux';
        } elseif (preg_match('/BlackBerry/i', $ua)) {
            $title = 'BlackBerryOS';
        } elseif (preg_match('/CentOS/i', $ua)) {
            $title = 'CentOS';
            if (preg_match('/.el([.0-9a-zA-Z]+).centos/i', $ua, $regmatch)) {
                $version = $regmatch[1];
            }
        } elseif (preg_match('/CrOS/i', $ua)) {
            $title = 'Google Chrome OS';
            $code = 'Chrome-OS';
        } elseif (preg_match('/Debian/i', $ua)) {
            $title = 'Debian GNU/Linux';
            $code = 'Debian';
        } elseif (preg_match('/Fedora/i', $ua)) {
            $title = 'Fedora';
            if (preg_match('/.fc([.0-9a-zA-Z]+)/i', $ua, $regmatch)) {
                $version = $regmatch[1];
            }
        } elseif (preg_match('/FreeBSD/i', $ua)) {
            $title = 'FreeBSD';
        } elseif (preg_match('/OpenBSD/i', $ua)) {
            $title = 'OpenBSD';
        } elseif (preg_match('/Oracle/i', $ua)) {
            $title = 'Oracle';
            $code = 'Oracle-Linux';
            if (preg_match('/.el([._0-9a-zA-Z]+)/i', $ua, $regmatch)) {
                $title .= ' Enterprise Linux';
                $version = str_replace('_', '.', $regmatch[1]);
            } else {
                $title .= ' Linux';
            }
        } elseif (preg_match('/Red\ Hat/i', $ua) || preg_match('/RedHat/i', $ua)) {
            $title = 'Red Hat';
            $code = 'Red-Hat';
            if (preg_match('/.el([._0-9a-zA-Z]+)/i', $ua, $regmatch)) {
                $title .= ' Enterprise Linux';
                $version = str_replace('_', '.', $regmatch[1]);
            }
        } elseif (preg_match('/Solaris/i', $ua) || preg_match('/SunOS/i', $ua)) {
            $title = 'Solaris';
        } elseif (preg_match('/Symb[ian]?[OS]?/i', $ua)) {
            $title = 'SymbianOS';
            if (preg_match('/Symb[ian]?[OS]?\/([.0-9a-zA-Z]+)/i', $ua, $regmatch)) {
                $version = $regmatch[1];
            }
        } elseif (preg_match('/Ubuntu/i', $ua)) {
            $title = 'Ubuntu';
            if (preg_match('/Ubuntu[\/|\ ]([.0-9]+[.0-9a-zA-Z]+)/i', $ua, $regmatch)) {
                $version = $regmatch[1];
            }
        } elseif (preg_match('/Linux/i', $ua)) {
            $title = 'GNU/Linux';
            $code = 'Linux';
        } elseif (preg_match('/J2ME\/MIDP/i', $ua)) {
            $title = 'J2ME/MIDP Device';
            $code = 'Java';
        }
        // No OS match
        else {
            $title = 'Other System';
            $code = 'Others';
        }
    if(Helper::options()->plugin("XCCXOS")->os === "on"){
        // Check x64 architecture
        if (preg_match('/x86_64/i', $ua)) {
            // If version isn't null append 64 bit, otherwise set it to x64
            $version = (is_null($version)) ? 'x64' : "$version x64";
        } elseif ((preg_match('/Windows/i', $ua) || preg_match('/WinNT/i', $ua) || preg_match('/Win32/i', $ua))
            && (preg_match('/Win64/i', $ua) || preg_match('/x64/i', $ua) || preg_match('/WOW64/i', $ua))
        ) {
            $version .= ' x64 Edition';
        }
    }
        if (is_null($code)) {
            $code = $title;
        }
        // Append version to title
        if (isset($version)) {
            $title .= " $version";
        }
        $result['code'] = $code;
        $result['title'] = $title;
        return $result;
    }
    /* Detect Web Browser Version */
    public static function get_browser_version($ua, $title){
    if(Helper::options()->plugin("XCCXOS")->browser === "on"){
        if($title=="QQ"){
          //适配QQ版本号获取
          preg_match('/' . $title . '\/(\d+.\d+.\d+)/i', $ua, $regmatch);    
        }else{
          //适配热门浏览器获取版本号
          preg_match('/' . $title . '\/([\d+]+)/i', $ua, $regmatch);    
        }
        $version = (empty($regmatch[1])) ? '' : $regmatch[1];
        return $version;
    }
    }
    /* Detect Web Browsers */
    //获取浏览器类型 (请勿乱改动 以免出现错误)
    public static function get_browser_name($ua)
    {
        $version = '';
        $code = null;

        if (preg_match('/360se/i', $ua)) {
            $title = '360 安全浏览器';
            $code = '360';
        } elseif (preg_match('/baidubrowser/i', $ua) || preg_match('/\ Spark/i', $ua)) {
            $title = '百度浏览器';
            $version = self::get_browser_version($ua, 'Browser');
            $code = 'BaiduBrowser';
        } elseif (preg_match('/SE\ /i', $ua) && preg_match('/MetaSr/i', $ua)) {
            $title = '搜狗高速浏览器';
            //$version = self::get_browser_version($ua, 'MetaSr');
            $code = 'Sogou-Explorer';
        } elseif (preg_match('#QQ/([a-zA-Z0-9.]+)#i', $ua)) {
            $title = '手机QQ';
            $version = self::get_browser_version($ua, 'QQ');
            $code = 'qq';
        } elseif (preg_match('/baiduboxapp/i', $ua)) {
            $title = '百度APP';
            $version = self::get_browser_version($ua, 'baiduboxapp');
            $code = 'baidu';
        } elseif (preg_match('/QQBrowser/i', $ua) || preg_match('/MQQBrowser/i', $ua)) {
            $title = 'QQ 浏览器';
            $version = self::get_browser_version($ua, 'QQBrowser');
            $code = 'QQBrowser';
        } elseif (preg_match('/chromeframe/i', $ua)) {
            $title = 'Google Chrome Frame';
            $version = self::get_browser_version($ua, 'chromeframe');
            $code = 'Chrome';
        } elseif (preg_match('/Chromium/i', $ua)) {
            $title = 'Chromium';
            $version = self::get_browser_version($ua, 'Chromium');
        } elseif (preg_match('/CrMo/i', $ua)) {
            $title = 'Google Chrome Mobile';
            $version = self::get_browser_version($ua, 'CrMo');
            $code = 'Chrome';
        } elseif (preg_match('/CriOS/i', $ua)) {
            $title = 'Google Chrome for iOS';
            $version = self::get_browser_version($ua, 'CriOS');
            $code = 'Chrome';
        } elseif (preg_match('/Quark/i', $ua)) {
            $title = 'Quark浏览器';
            $version = self::get_browser_version($ua, 'Quark');
            $code = 'browser';
        } elseif (preg_match('/Maxthon/i', $ua)) {
            $title = '傲游浏览器';
            $version = self::get_browser_version($ua, 'Maxthon');
            $code = 'Maxthon';
        } elseif (preg_match('/HeyTapBrowser/i', $ua)) {
            $title = 'OPPO浏览器';
            $version = self::get_browser_version($ua, 'HeyTapBrowser');
            $code = 'OPPO-Browser';
        } elseif (preg_match('/ViVOBrowser/i', $ua)) {
            $title = 'ViVO浏览器';
            $version = self::get_browser_version($ua, 'ViVOBrowser');
            $code = 'vivo';
        } elseif (preg_match('/HuaweiBrowser/i', $ua)) {
            $title = '华为浏览器';
            $version = self::get_browser_version($ua, 'HuaweiBrowser');
            $code = 'huawei';
        } elseif (preg_match('/MiuiBrowser/i', $ua)) {
            $title = '小米浏览器';
            $version = self::get_browser_version($ua, 'MiuiBrowser');
            $code = 'MIUI-Browser';
        } elseif (preg_match('/TheWorld/i', $ua)) {
            $title = '世界之窗浏览器';
            $code = 'TheWorld';
        } elseif (preg_match('/UBrowser/i', $ua)) {
            $title = 'UC 浏览器';
            $version = self::get_browser_version($ua, 'UBrowser');
            $code = 'UC';
        } elseif (preg_match('/UCBrowser/i', $ua)) {
            $title = 'UC 浏览器';
            $version = self::get_browser_version($ua, 'UCBrowser');
            $code = 'UC';
        } elseif (preg_match('/UC\ Browser/i', $ua)) {
            $title = 'UC 浏览器';
            $version = self::get_browser_version($ua, 'UC Browser');
            $code = 'UC';
        } elseif (preg_match('/UCWEB/i', $ua)) {
            $title = 'UC 浏览器';
            $version = self::get_browser_version($ua, 'UCWEB');
            $code = 'UC';
        } elseif (preg_match('/BlackBerry/i', $ua)) {
            $title = 'BlackBerry';
        } elseif (preg_match('/Coast/i', $ua)) {
            $title = 'Coast';
            $version = self::get_browser_version($ua, 'Coast');
            $code = 'Opera';
        } elseif (preg_match('/IEMobile/i', $ua)) {
            $title = 'IE Mobile';
            $code = 'IE';
        } elseif (preg_match('/LG Browser/i', $ua)) {
            $title = 'LG Web Browser';
            $version = self::get_browser_version($ua, 'Browser');
            $code = 'LG';
        } elseif (preg_match('/Navigator/i', $ua)) {
            $title = 'Netscape Navigator';
            $code = 'Netscape';
        } elseif (preg_match('/Netscape/i', $ua)) {
            $title = 'Netscape';
        } elseif (preg_match('/Nintendo 3DS/i', $ua)) {
            $title = 'Nintendo 3DS';
            $code = 'Nintendo';
        } elseif (preg_match('/NintendoBrowser/i', $ua)) {
            $title = 'Nintendo Browser';
            $version = self::get_browser_version($ua, 'Browser');
            $code = 'Nintendo';
        } elseif (preg_match('/NokiaBrowser/i', $ua)) {
            $title = 'Nokia Browser';
            $version = self::get_browser_version($ua, 'Browser');
            $code = 'Nokia';
        } elseif (preg_match('/MicroMessenger/i', $ua)) {
            $title = '手机微信';
            $version = self::get_browser_version($ua, 'MicroMessenger');
            $code = 'WeChat';
        } elseif (preg_match('/Opera Mini/i', $ua)) {
            $title = 'Opera Mini';
            $code = 'Opera';
        } elseif (preg_match('/Opera Mobi/i', $ua)) {
            if (preg_match('/Version/i', $ua)) {
                $version = self::get_browser_version($ua, 'Version');
            } else {
                $version = self::get_browser_version($ua, 'Opera Mobi');
            }
            $title = 'Opera Mobile';
            $code = 'Opera';
        } elseif (preg_match('/Opera/i', $ua) || preg_match('/OPR/i', $ua)) {
            $title = 'Opera';
            $code = 'Opera';
            // How is version stored on this Opera ua?
            if (preg_match('/Version/i', $ua)) {
                $version = self::get_browser_version($ua, 'Version');
            } elseif (preg_match('/OPR/i', $ua)) {
                $version = self::get_browser_version($ua, 'OPR');
            } else {
                $version = self::get_browser_version($ua, 'Opera');
            }
            if (preg_match('/Edition ([\ ._0-9a-zA-Z]+)/i', $ua, $regmatch)) {
                $title .= ' ' . $regmatch[1];
            } elseif (preg_match('/Opera ([\ ._0-9a-zA-Z]+)/i', $ua, $regmatch)) {
                $title .= ' ' . $regmatch[1];
            }
        } elseif (preg_match('/PlayStation\ 4/i', $ua)) {
            $title = 'PS4 Web Browser';
            $code = 'PS4';
        } elseif (preg_match('/SEMC-Browser/i', $ua)) {
            $title = 'SEMC Browser';
            $version = self::get_browser_version($ua, 'SEMC-Browser');
            $code = 'Sony';
        } elseif (preg_match('/SEMC-java/i', $ua)) {
            $title = 'SEMC Java';
            $code = 'Sony';
        } elseif (preg_match('/Series60/i', $ua) && !preg_match('/Symbian/i', $ua)) {
            $title = 'Nokia S60';
            $version = self::get_browser_version($ua, 'Series60');
            $code = 'Nokia';
        } elseif (preg_match('/S60/i', $ua) && !preg_match('/Symbian/i', $ua)) {
            $title = 'Nokia S60';
            $version = self::get_browser_version($ua, 'S60');
            $code = 'Nokia';
        } elseif (preg_match('/TencentTraveler/i', $ua)) {
            $title = 'TT 浏览器';
            $version = self::get_browser_version($ua, 'TencentTraveler');
            $code = 'QQBrowser';
        } elseif ((preg_match('/Ubuntu\;\ Mobile/i', $ua) || preg_match('/Ubuntu\;\ Tablet/i', $ua) && preg_match('/WebKit/i', $ua))) {
            $title = 'Ubuntu Web Browser';
            $code = 'Ubuntu';
        } elseif (preg_match('/AppleWebkit/i', $ua) && preg_match('/Android/i', $ua) && !preg_match('/Chrome/i', $ua)) {
            $title = 'Android Webkit';
            $version = self::get_browser_version($ua, 'Version');
            $code = 'Android-Webkit';
        } elseif (preg_match('/Chrome/i', $ua) && preg_match('/Mobile/i', $ua) && (preg_match('/Version/i', $ua) || preg_match('/wv/i', $ua))) {
            $title = 'WebView';
            $version = self::get_browser_version($ua, 'AppleWebkit');
            $code = 'Android-Webkit';
        }
        // Pulled out of order to help ensure better detection for above browsers
        elseif (preg_match('/EdgA/i', $ua)) {
            $title = 'Microsoft Edge';
            $version = self::get_browser_version($ua, 'EdgA');
            $code = 'Edge';
        } elseif (preg_match('/Edg/i', $ua)) {
            $title = 'Microsoft Edge';
            $version = self::get_browser_version($ua, 'Edg');
            $code = 'Edge';
        } elseif (preg_match('/Edge/i', $ua)) {
            $title = 'Microsoft Edge';
            $version = self::get_browser_version($ua, 'Edge');
            $code = 'Edge';
        } elseif (preg_match('/Chrome/i', $ua)) {
            $title = 'Google Chrome';
            $version = self::get_browser_version($ua, 'Chrome');
            $code = 'Chrome';
        } elseif (preg_match('/Safari/i', $ua) && !preg_match('/Nokia/i', $ua)) {
            $title = 'Safari';
            $code = 'Safari';
            if (preg_match('/Version/i', $ua)) {
                $version = self::get_browser_version($ua, 'Version');
            }
            if (preg_match('/Mobile Safari/i', $ua)) {
                $title = 'Mobile ' . $title;
            }
        } elseif (preg_match('/Nokia/i', $ua)) {
            $title = 'Nokia Web Browser';
            $code = 'Nokia';
        } elseif (preg_match('/Firefox/i', $ua)) {
            $title = 'Firefox';
            $version = self::get_browser_version($ua, 'Firefox');
        } elseif (preg_match('/MSIE/i', $ua) || preg_match('/Trident/i', $ua)) {
            $title = 'Internet Explorer';
            $code = 'IE';
            if (preg_match('/\ rv:([.0-9a-zA-Z]+)/i', $ua)) {
                // IE11 or newer
                $version = self::get_browser_version($ua, ' rv');
            } else {
                $version = self::get_browser_version($ua, 'MSIE');
            }
            // Detect compatibility mode for IE
            if ($version === '7.0' && preg_match('/Trident\/4.0/i', $ua)) {
                $version = '8.0 (Compatibility Mode)';
            }
        } elseif (preg_match('/Mozilla/i', $ua)) {
            $title = 'Mozilla';
            $version = self::get_browser_version($ua, ' rv');
            if (empty($version)) {
                $title .= ' Compatible';
                $code = 'Mozilla';
            }
        }
        // No Web browser match
        else {
            $title = 'Other Browser';
            $code = 'Others';
        }
        if (is_null($code)) {
            $code = $title;
        }
        if ($version != '') {
            $title .= " $version";
        }

        $result['code'] = $code;
        $result['title'] = $title;
        return $result;
    }
}
