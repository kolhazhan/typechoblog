<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
	'JFriends',
	NULL,
	'浅梦blog || https://letanml.xyz || https://api.letanml.xyz/logo.jpg || 分享每一天，留住每一刻',
	'友情链接（非必填）',
	'介绍：用于填写友情链接 <br />
         注意：您需要先增加友链链接页面（新增独立页面-右侧模板选择友链），该项才会生效 <br />
         格式：博客名称 || 博客地址 || 博客头像 || 博客简介 <br />
         其他：一行一个，一行代表一个友链'
);
$JFriends->setAttribute('class', 'joe_content joe_friend');
$form->addInput($JFriends);

$JFriends_Submit = new Typecho_Widget_Helper_Form_Element_Select(
	'JFriends_Submit',
	array('off' => '关闭（默认）', 'on' => '开启'),
	'off',
	'是否开启友情链接在线申请',
	'注意：需正确配置邮箱 否则收不到申请'
);
$JFriends_Submit->setAttribute('class', 'joe_content joe_friend');
$form->addInput($JFriends_Submit->multiMode());

$JFriends_shuffle = new Typecho_Widget_Helper_Form_Element_Select(
	'JFriends_shuffle',
	array('off' => '关闭（默认）', 'on' => '开启'),
	'off',
	'是否开启友情链接随机排序',
	NULL
);
$JFriends_shuffle->setAttribute('class', 'joe_content joe_friend');
$form->addInput($JFriends_shuffle->multiMode());