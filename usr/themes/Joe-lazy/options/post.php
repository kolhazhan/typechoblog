<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$JPost_Header_Img_Switch = new Typecho_Widget_Helper_Form_Element_Select(
	'JPost_Header_Img_Switch',
	array(
		'on' => '开启（默认）',
		'off' => '关闭',
	),
	'on',
	'是否开启文章页面顶部大图',
	'介绍：开启后顶部大图将背景将使用文章缩略图 文字将使用文字标题 如果没有文章没有缩略图那么使用首页顶部大图和侧边栏随机一言充当文字'
);
$JPost_Header_Img_Switch->setAttribute('class', 'joe_content joe_post');
$form->addInput($JPost_Header_Img_Switch);

$JPost_Header_Img = new Typecho_Widget_Helper_Form_Element_Textarea(
	'JPost_Header_Img',
	NULL,
	NULL,
	'文章页顶部大图背景壁纸',
	'介绍：填写后将强制代替文章页顶部大图所有背景壁纸并忽略顶部大图开关<br>
	格式：图片地址 或 Base64地址<br>'
);
$JPost_Header_Img->setAttribute('class', 'joe_content joe_post');
$form->addInput($JPost_Header_Img);

$JArticle_Bottom_Text = new Typecho_Widget_Helper_Form_Element_Textarea(
	'JArticle_Bottom_Text',
	NULL,
	NULL,
	'文章底部自定义信息',
	'介绍：暂无 <br>
		 格式：一行代表一列<br>
		 例：<br>
		 本站资源多为网络收集，如涉及版权问题请及时与站长联系，我们会在第一时间内删除资源。<br>
		 本站用户发帖仅代表本站用户个人观点，并不代表本站赞同其观点和对其真实性负责。<br>
		 本站一律禁止以任何方式发布或转载任何违法的相关信息，访客发现请向站长举报。<br>
		 本站资源大多存储在云盘，如发现链接失效，请及时与站长联系，我们会第一时间更新。<br>
		 转载本网站任何内容，请按照转载方式正确书写本站原文地址。<br>'
);
$JArticle_Bottom_Text->setAttribute('class', 'joe_content joe_post');
$form->addInput($JArticle_Bottom_Text);

$JPost_Ad = new Typecho_Widget_Helper_Form_Element_Textarea(
	'JPost_Ad',
	NULL,
	NULL,
	'文章页大屏广告',
	'介绍：请务必填写正确的格式 <br />
		 格式：广告图片 || 广告链接 （中间使用两个竖杠分隔，可填写多个，换行分割）<br />
		 例如：https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0 || https://baidu.com'
);
$JPost_Ad->setAttribute('class', 'joe_content joe_post');
$form->addInput($JPost_Ad);

$JBaiduToken = new Typecho_Widget_Helper_Form_Element_Text(
	'JBaiduToken',
	NULL,
	NULL,
	'百度推送Token',
	'介绍：填写此处，前台文章页如果未收录，则会自动将当前链接推送给百度加快收录 <br />
		 其他：Token在百度收录平台注册账号获取'
);
$JBaiduToken->setAttribute('class', 'joe_content joe_post');
$form->addInput($JBaiduToken);

$JBingToken = new Typecho_Widget_Helper_Form_Element_Text(
	'JBingToken',
	NULL,
	NULL,
	'必应推送Token',
	'介绍：填写此处，则会自动将当前链接推送给必应加快收录 <br />
		 其他：Token在必应收录平台注册账号获取'
);
$JBingToken->setAttribute('class', 'joe_content joe_post');
$form->addInput($JBingToken);

$Jsearch_target = new Typecho_Widget_Helper_Form_Element_Select(
	'Jsearch_target',
	array(
		'_blank' => '_blank（默认，新窗口）',
		'_parent' => '_parent（当前窗口）',
		'_self' => '_self（同窗口）',
		'_top' => '_top（顶端打开窗口）',
	),
	'_blank',
	'其他页面文章列表打开方式',
);
$Jsearch_target->setAttribute('class', 'joe_content joe_post');
$form->addInput($Jsearch_target->multiMode());

$JOverdue = new Typecho_Widget_Helper_Form_Element_Select(
	'JOverdue',
	array(
		'off' => '关闭（默认）',
		'3' => '大于3天',
		'7' => '大于7天',
		'15' => '大于15天',
		'30' => '大于30天',
		'60' => '大于60天',
		'90' => '大于90天',
		'120' => '大于120天',
		'180' => '大于180天'
	),
	'off',
	'是否开启文章更新时间大于多少天提示（仅针对文章有效）',
	'介绍：开启后如果文章在多少天内无任何修改，则进行提示'
);
$JOverdue->setAttribute('class', 'joe_content joe_post');
$form->addInput($JOverdue->multiMode());

$JEditor = new Typecho_Widget_Helper_Form_Element_Select(
	'JEditor',
	array(
		'on' => '开启（默认）',
		'off' => '关闭',
	),
	'on',
	'是否启用Joe自定义编辑器',
	'介绍：开启后，文章编辑器将替换成Joe编辑器 <br>
		 其他：目前编辑器处于拓展阶段，如果想继续使用原生编辑器，关闭此项即可'
);
$JEditor->setAttribute('class', 'joe_content joe_post');
$form->addInput($JEditor->multiMode());

$JPrismTheme = new Typecho_Widget_Helper_Form_Element_Select(
	'JPrismTheme',
	array(
		'assets/lib/Prismjs/GrayMac.min.css' => 'GrayMac',
		'assets/lib/Prismjs/WhiteMac.min.css' => 'WhiteMac',
		'assets/lib/Prismjs/BlackMac.min.css' => 'BlackMac',
		'off' => '关闭内置代码高亮',
	),
	'assets/lib/Prismjs/GrayMac.min.css',
	'选择一款您喜欢的代码高亮样式',
	'介绍：用于修改代码块的高亮风格 <br>
		 其他：如果您有其他样式，可通过源代码修改此项，引入您的自定义样式链接 <br>
		 当前样式来源于 <a target="_blank" href="https://github.com/Xcnte/Code-Prettify-for-typecho" rel="noopener noreferrer">Typecho代码高亮插件CodePrettify</a>'
);
$JPrismTheme->setAttribute('class', 'joe_content joe_post');
$form->addInput($JPrismTheme->multiMode());
