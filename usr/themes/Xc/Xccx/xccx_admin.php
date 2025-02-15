<?php 


// 主题样式
$Xc_Theme_pattern = new Typecho_Widget_Helper_Form_Element_Select(
'Xc_Theme_pattern',
array(
'01' => '样式1（默认）',
'02' => '样式2',
'03' => '样式3',
'04' => '样式4',
'05' => '样式5',
'06' => '样式6',
),
'01',
'主题样式',
'介绍：选择你喜欢的一款样式'
);
$Xc_Theme_pattern->setAttribute('class', 'Xc_content Xc_pattern');
$form->addInput($Xc_Theme_pattern->multiMode());

// 左边文章main模块宽度
$template_main = new Typecho_Widget_Helper_Form_Element_Text(
'template_main',
NULL,
"980px",
'左边文章main模块宽度（PC端）',
'介绍：自定义左边文章main模块宽度，根据自己美化调整<br>
 例如：980px'
 
);
$template_main->setAttribute('class', 'Xc_content Xc_pattern');
$form->addInput($template_main);

// 右边侧边栏aside模块宽度
$template_aside = new Typecho_Widget_Helper_Form_Element_Text(
'template_aside',
NULL,
"260px",
'右边侧边栏aside模块宽度（PC端）',
'介绍：自定义右边侧边栏aside模块宽度，根据自己美化调整<br>
 例如：260px'
 
);
$template_aside->setAttribute('class', 'Xc_content Xc_pattern');
$form->addInput($template_aside);

// 顶部导航栏header模块宽度
$template_header = new Typecho_Widget_Helper_Form_Element_Text(
'template_header',
NULL,
"1280px",
'顶部导航栏header模块宽度（PC端）',
'介绍：自定义顶部导航栏header模块宽度，根据自己美化调整<br>
 例如：居中对齐就用文章模块宽度980px + 侧边栏模块宽度260px + 网页的间隔边距40px = 总宽度1280px<br>
 左右分开直接填写100%或者95%'
 
);
$template_header->setAttribute('class', 'Xc_content Xc_pattern');
$form->addInput($template_header);

/// 导航栏样式
$xccx_header = new Typecho_Widget_Helper_Form_Element_Select(
'xccx_header',
array(
'01' => '单栏（默认）',
'02' => '双栏',
'03' => '自定义',
),
'01',
'顶部导航栏样式 （PC）',
'介绍：选择你喜欢的顶部导航栏样式'
);
$xccx_header->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($xccx_header->multiMode());

$topzdydhl = new Typecho_Widget_Helper_Form_Element_Textarea(
'topzdydhl',
NULL,
NULL,
'自定义导航栏（开启自定义生效）',
'说明：一行一个，前后随意，结尾不要留空行<br />
 例如格式以下：<br />
首页 || 首页链接 <br />
页面单菜单1 || 链接1 <br />
页面单菜单2 || 链接2 <br />
分类主菜单1 || 主菜单链接 || 二级菜单1,二级菜单2 || 二级菜单链接1,二级菜单链接2 <br />
分类主菜单2 || 主菜单链接 || 二级菜单1,二级菜单2 || 二级菜单链接1,二级菜单链接2
 '
);
$topzdydhl->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($topzdydhl);

// 顶部导航栏透明
$JAside_dhltm = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_dhltm',
array(
'off' => '关闭（默认）',
'on' => '开启',
),
'off',
'顶部导航栏透明',
'介绍：导航栏在最顶部时才透明，并且只在导航栏单栏样式中有效'
);
$JAside_dhltm->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($JAside_dhltm->multiMode());

// 导航栏显示近期浏览
$JAside_dhlliulan = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_dhlliulan',
array(
'off' => '关闭（默认）',
'on' => '开启',
),
'off',
'导航栏显示近期浏览',
'这个可能会略微拖慢一点网页加载速度 但不明显'
);
$JAside_dhlliulan->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($JAside_dhlliulan->multiMode());

// 顶部模式
$top_img_datu = new Typecho_Widget_Helper_Form_Element_Select(
'top_img_datu',
array(
'01' => '大图模式（默认）',
'02' => '无图模式',
),
'01',
'顶部模式',
'顶部模式'
);
$top_img_datu->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($top_img_datu->multiMode());

// 首页顶部图链接
$JWallpaper_picture_index = new Typecho_Widget_Helper_Form_Element_Textarea(
'JWallpaper_picture_index',
NULL,
"https://p3.qhimg.com/bdr/__85/t0166ec9da6a6f9a6c3.jpg",
'首页 分类页 顶部图',
'说明：只限于首页和分类页的顶部图<br />
 格式：图片地址，一行一个，多行则随机显示<br />
 注意：结尾不要留空行'
);
$JWallpaper_picture_index->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($JWallpaper_picture_index);

// 手机端首页顶部图链接
$wap_picture_index = new Typecho_Widget_Helper_Form_Element_Text(
'wap_picture_index',
NULL,
NULL,
'首页顶部图（手机端）',
'说明：只限于手机端首页的顶部图（非必填）<br>
 格式：图片URL地址 或 随机图片api地址'
 
);
$wap_picture_index->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($wap_picture_index);

// 首页顶部标题
$JWallpaper_top_title = new Typecho_Widget_Helper_Form_Element_Text(
'JWallpaper_top_title',
NULL,
"Xc-Theme 标题",
'首页顶部标题',
'说明：要啥标题自己写'
 
);
$JWallpaper_top_title->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($JWallpaper_top_title);

// 首页顶部介绍
$JWallpaper_top_introduce = new Typecho_Widget_Helper_Form_Element_Text(
'JWallpaper_top_introduce',
NULL,
"Xc-Theme 介绍",
'首页顶部介绍',
'说明：要啥介绍自己写'
 
);
$JWallpaper_top_introduce->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($JWallpaper_top_introduce);

// 首页顶部图尺寸
$JWallpaper_picturezhi = new Typecho_Widget_Helper_Form_Element_Text(
'JWallpaper_picturezhi',
NULL,
"50vh",
'首页顶部尺寸',
'介绍：设置首页顶部图片  或视频高低尺寸，只限PC端有效<br>
 例如：固定尺寸则填写500px  百分比尺寸则填写50vh（等于半屏）'
 
);
$JWallpaper_picturezhi->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($JWallpaper_picturezhi);


// 分类页 文章页 独立页 顶部图尺寸
$JWallpaper_picturepost = new Typecho_Widget_Helper_Form_Element_Text(
'JWallpaper_picturepost',
NULL,
"50vh",
'分类页 文章页 独立页 顶部图尺寸（PC）',
'介绍：除了首页，所以页面的顶部图尺寸都在这里设置，只限PC端有效<br>
 例如：固定尺寸则填写500px  百分比尺寸则填写50vh（等于半屏）'
 
);
$JWallpaper_picturepost->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($JWallpaper_picturepost);

// 首页滚动引导
$index_picture_roll = new Typecho_Widget_Helper_Form_Element_Select(
'index_picture_roll',
array(
'off' => '关闭（默认）',
'on' => '开启'
),
'off',
'是否开启首页滚动引导标志',
'介绍：点击标志可向下滚动，只在首页显示'
);
$index_picture_roll->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($index_picture_roll->multiMode());

// 顶部特效
$index_picture_wave = new Typecho_Widget_Helper_Form_Element_Select(
'index_picture_wave',
array(
'01' => '默认（无特效）',
'02' => '波浪效果',
'03' => '阴影效果',
),
'01',
'顶部特效',
'介绍：选择你喜欢的一款效果样式'
);
$index_picture_wave->setAttribute('class', 'Xc_content Xc_top');
$form->addInput($index_picture_wave->multiMode());

// 首页文章样式
$JAside_xccx_ck = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_xccx_ck',
array(
'01' => '每行1篇文章（默认）',
'02' => '每行2篇文章'
),
'01',
'首页文章样式（主题样式1 6）',
'介绍：首页的文章列表默认为一行<br>
 注意：开启此功能建议关闭首页侧边栏（PC）'
);
$JAside_xccx_ck->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($JAside_xccx_ck->multiMode());

// 加载动画样式
$JAside_Loadanimation = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_Loadanimation',
array(
'off' => '关闭（默认）',
'01' => '样式1'
),
'off',
'加载动画样式',
'介绍：选择一款刷新加载页面的图标动画样式'
);
$JAside_Loadanimation->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($JAside_Loadanimation->multiMode());

// 夜间效果样式
$JAside_xingguang = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_xingguang',
array(
'off' => '关闭（默认）',
'01' => '样式1',
),
'off',
'夜间效果样式',
'介绍：选择一款夜间效果样式'
);
$JAside_xingguang->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($JAside_xingguang->multiMode());

// 友链样式
$FriendLinkStyle = new Typecho_Widget_Helper_Form_Element_Select(
'FriendLinkStyle',
array(
'01' => '样式1（默认）',
'02' => '样式2',
'03' => '样式3',
),
'01',
'友链样式',
'介绍：选择你喜欢的友链卡片样式'
);
$FriendLinkStyle->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($FriendLinkStyle->multiMode());

// 留言墙卡片
$Messagewall_card = new Typecho_Widget_Helper_Form_Element_Select(
'Messagewall_card',
array('on' => '开启（默认）', 'off' => '关闭'),
'on',
'是否开启留言墙卡片',
'介绍：开启后将在留言页面以卡片方式显示最近的留言信息'
);
$Messagewall_card->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($Messagewall_card);

// 留言墙排名开关
$Messagewall_ranking = new Typecho_Widget_Helper_Form_Element_Select(
'Messagewall_ranking',
array('off' => '关闭（默认）', 'on' => '开启'),
'off',
'是否开启留言墙排名',
'介绍：显示评论相关用户，开启后将在留言页面呈现'
);
$Messagewall_ranking->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($Messagewall_ranking);

// 留言墙排名时间
$JReader_Ranking_Time = new Typecho_Widget_Helper_Form_Element_Select(
'JReader_Ranking_Time',
array(
'180' => '最近180天（默认）',
'30' => '最近30天',
'60' => '最近60天',
'90' => '最近90天',
'120' => '最近120天',
'360' => '最近360天',
'99999' => '最近99999天'
),
'180',
'留言墙排名时间显示范围（默认为 180 天）'
);
$JReader_Ranking_Time->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($JReader_Ranking_Time->multiMode());

// 留言墙排名排除
$JReader_Ranking_Mail = new Typecho_Widget_Helper_Form_Element_Text(
'JReader_Ranking_Mail',
NULL,
NULL,
'留言墙排名，排除不上榜的邮箱',
'例如：123456@qq.com'
);
$JReader_Ranking_Mail->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($JReader_Ranking_Mail->multiMode());

// 留言墙排名个数显示
$JReader_Ranking_Limit = new Typecho_Widget_Helper_Form_Element_Text(
'JReader_Ranking_Limit',
NULL,
"24",
'留言墙排名个数显示',
'显示的数量自己填（默认24个）'
 
);
$JReader_Ranking_Limit->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($JReader_Ranking_Limit);

// 评论区样式
$Xccx_comment = new Typecho_Widget_Helper_Form_Element_Select(
'Xccx_comment',
array(
'01' => '样式1（默认）',
'02' => '样式2',
),
'01',
'评论区样式',
'介绍：选择你喜欢的评论区样式'
);
$Xccx_comment->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($Xccx_comment->multiMode());

// 首页的分页形式
$JPageStatus = new Typecho_Widget_Helper_Form_Element_Select(
'JPageStatus',
array(
'ajax' => '加载更多（默认）',
'default' => '按钮分页',
),
'ajax',
'首页文章分页形式',
'介绍：选择一款您所喜欢的分页形式'
);
$JPageStatus->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($JPageStatus->multiMode());

// HTML压缩
$Xc_htmlys = new Typecho_Widget_Helper_Form_Element_Select(
'Xc_htmlys',
array(
'off' => '关闭（默认）',
'on' => '开启',
),
'off',
'是否开启HTML压缩',
'介绍：能够有效的加快网页速度'
);
$Xc_htmlys->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($Xc_htmlys->multiMode());

// Pjax加载
$Xc_html_Pjax = new Typecho_Widget_Helper_Form_Element_Select(
'Xc_html_Pjax',
array(
'off' => '关闭（默认）',
'on' => '开启',
),
'off',
'是否开启Pjax加载',
'介绍：能够无刷新加载网页，不懂请勿开启'
);
$Xc_html_Pjax->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($Xc_html_Pjax->multiMode());

// Pjax自定义函数回调
$Xc_html_Pjax_zdy = new Typecho_Widget_Helper_Form_Element_Textarea(
'Xc_html_Pjax_zdy',
NULL,
NULL,
'Pjax自定义函数回调',
'可添加Pjax自定义回调<br />
 说明：如某些插件失效并不能加载js之类的'
);
$Xc_html_Pjax_zdy->setAttribute('class', 'Xc_content Xc_beautify');
$form->addInput($Xc_html_Pjax_zdy);

// 站长平台
$JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFriends1',
NULL,
'狱长 || https://www.xccx.cc || https://www.xccx.cc/tp/tx.png || 心中无女人，代码自然神',
'站长平台',
'介绍：用于添加导航站点 <br />
 注意：需要先增加站点导航页面（新增独立页面-右侧模板选择站点导航），该项才会生效 <br />
 格式：网站名称 || 网站地址 || 网站头像 || 网站简介 <br />
 其他：一行一个，不要填乱'
);
$JFriends->setAttribute('class', 'Xc_content Xc_daohang');
$form->addInput($JFriends);

// 在线工具
$JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFriends2',
NULL,
NULL,
'在线工具',
'格式：网站名称 || 网站地址 || 网站头像 || 网站简介 <br />
 其他：一行一个，不要填乱'
);
$JFriends->setAttribute('class', 'Xc_content Xc_daohang');
$form->addInput($JFriends);

// 网站程序
$JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFriends3',
NULL,
NULL,
'网站程序',
'格式：网站名称 || 网站地址 || 网站头像 || 网站简介 <br />
 其他：一行一个，不要填乱'
);
$JFriends->setAttribute('class', 'Xc_content Xc_daohang');
$form->addInput($JFriends);

// 网站收录
$JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFriends4',
NULL,
NULL,
'网站收录',
'格式：网站名称 || 网站地址 || 网站头像 || 网站简介 <br />
 其他：一行一个，不要填乱'
);
$JFriends->setAttribute('class', 'Xc_content Xc_daohang');
$form->addInput($JFriends);

// 放松福利
$JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFriends5',
NULL,
NULL,
'放松福利',
'格式：网站名称 || 网站地址 || 网站头像 || 网站简介 <br />
 其他：一行一个，不要填乱'
);
$JFriends->setAttribute('class', 'Xc_content Xc_daohang');
$form->addInput($JFriends);

// 其他资源
$JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFriends6',
NULL,
NULL,
'其他资源',
'格式：网站名称 || 网站地址 || 网站头像 || 网站简介 <br />
 其他：一行一个，不要填乱'
);
$JFriends->setAttribute('class', 'Xc_content Xc_daohang');
$form->addInput($JFriends);


?>