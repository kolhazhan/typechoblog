<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$JStaticAssetsUrl = new Typecho_Widget_Helper_Form_Element_Text(
	'JStaticAssetsUrl',
	null,
	null,
	'自定义静态资源CDN地址（非必填）',
	'介绍：将主题的assets上传到CDN，填写CDN地址，例如https://exple.com（不要加结尾的/）'
);
$JStaticAssetsUrl->setAttribute('class', 'joe_content joe_global');
$form->addInput($JStaticAssetsUrl);

$JNavMaxNum = new Typecho_Widget_Helper_Form_Element_Select(
	'JNavMaxNum',
	array(
		'3' => '3个（默认）',
		'4' => '4个',
		'5' => '5个',
		'6' => '6个',
		'7' => '7个',
	),
	'3',
	'选择导航栏最大显示的个数',
	'介绍：用于设置最大多少个后，以更多下拉框显示'
);
$JNavMaxNum->setAttribute('class', 'joe_content joe_global');
$form->addInput($JNavMaxNum->multiMode());

$JCustomNavs = new Typecho_Widget_Helper_Form_Element_Textarea(
	'JCustomNavs',
	NULL,
	NULL,
	'导航栏自定义链接（非必填）',
	'介绍：用于自定义导航栏链接 <br />
		 格式：跳转文字 || 跳转链接（中间使用两个竖杠分隔）<br />
		 其他：一行一个，一行代表一个超链接 <br />
		 例如：<br />
			百度一下 || https://baidu.com <br />
			腾讯视频 || https://v.qq.com
		 '
);
$JCustomNavs->setAttribute('class', 'joe_content joe_global');
$form->addInput($JCustomNavs);

$JFooter_Left = new Typecho_Widget_Helper_Form_Element_Textarea(
	'JFooter_Left',
	NULL,
	'2022 - 2024 ©<a href="https://letanml.xyz">浅梦的小站</a>丨技术支持：<a href="https://letanml.xyz" target="_blank">浅梦</a>',
	'自定义底部栏左侧内容（非必填）',
	'介绍：用于修改全站底部左侧内容（wap端上方） <br>
		 例如：<style style="display:inline">2021 - 2022 ©<a href="{站点链接}">{站点标题}</a>丨技术支持：<a href="https://letanml.xyz" target="_blank">浅梦</a></style>'
);
$JFooter_Left->setAttribute('class', 'joe_content joe_global');
$form->addInput($JFooter_Left);

$JFooter_Right = new Typecho_Widget_Helper_Form_Element_Textarea(
	'JFooter_Right',
	NULL,
	'<a href="'. Typecho_Common::url('', Helper::options()->index) .'feed/" target="_blank" rel="noopener noreferrer">RSS</a>
		 <a href="'. Typecho_Common::url('', Helper::options()->index) .'sitemap.xml" target="_blank" rel="noopener noreferrer" style="margin-left: 15px">MAP</a>
		 <a href="https://icp.gov.moe/?keyword=20240056" target="_blank" style="margin-left: 15px" rel="noopener noreferrer">萌ICP备20240056号</a>',
	'自定义底部栏右侧内容（非必填）',
	'介绍：用于修改全站底部右侧内容（wap端下方） <br>
		 例如：&lt;a href="/"&gt;首页&lt;/a&gt; &lt;a href="/"&gt;关于&lt;/a&gt;'
);
$JFooter_Right->setAttribute('class', 'joe_content joe_global');
$form->addInput($JFooter_Right);

$JBirthDay = new Typecho_Widget_Helper_Form_Element_Text(
	'JBirthDay',
	NULL,
	'2022/9/29 09:29:29',
	'网站成立日期（非必填）',
	'介绍：用于显示当前站点已经运行了多少时间。<br>
		 注意：填写时务必保证填写正确！例如：2022/9/29 09:29:29 <br>
		 其他：不填写则不显示，若填写错误，则不会显示计时'
);
$JBirthDay->setAttribute('class', 'joe_content joe_global');
$form->addInput($JBirthDay);

$JCustomFont = new Typecho_Widget_Helper_Form_Element_Text(
	'JCustomFont',
	NULL,
	NULL,
	'自定义网站字体（非必填）',
	'介绍：用于修改全站字体，填写则使用引入的字体，不填写使用默认字体 <br>
		 格式：字体URL链接（推荐使用woff格式的字体，网页专用字体格式） <br>
		 注意：字体文件一般有几兆，建议使用cdn链接，同时参照<a href="https://segmentfault.com/a/1190000044119658" target="_blank">这篇文章</a>对字体进行分片处理'
);
$JCustomFont->setAttribute('class', 'joe_content joe_global');
$form->addInput($JCustomFont);

$JCustomAvatarSource = new Typecho_Widget_Helper_Form_Element_Text(
	'JCustomAvatarSource',
	NULL,
	NULL,
	'自定义头像源（非必填）',
	'介绍：用于修改全站头像源地址 <br>
		 例如：https://cdn.sep.cc/avatar/ <br>
		 其他：非必填，默认头像源为 https://cravatar.cn/avatar/<br>
		 注意：填写时，务必保证最后有一个/字符，否则不起作用！'
);
$JCustomAvatarSource->setAttribute('class', 'joe_content joe_global');
$form->addInput($JCustomAvatarSource);