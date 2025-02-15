<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

//获取主题版本号
function _getVersion(){return "3.0";};

require_once("core/core.php");
function themeConfig($form){
$_db = Typecho_Db::get();
$_prefix = $_db->getPrefix();
try {
if (!array_key_exists('views', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {$_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `views` INT DEFAULT 0;');}
if (!array_key_exists('agree', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {$_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `agree` INT DEFAULT 0;');}}
catch (Exception $e) {}
?>
<link rel="stylesheet" href="<?php Helper::options()->themeUrl('assets/typecho/config/css/Xc.admin.css') ?>">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:400" />
<script src="<?php Helper::options()->themeUrl('assets/typecho/config/js/Xc.admin.js') ?>"></script>
<div class="Xc_config"><div>
<div class="Xc_config__aside">
<div class="logo">Xc <?php echo _getVersion() ?></div>
<ul class="tabs">
<li class="item" data-current="Xc_notice"><span>最新公告</span></li>
<li class="item" data-current="Xc_pattern"><span>主题样式</span></li>
<li class="item" data-current="Xc_global"><span>全局设置</span></li>
<li class="item" data-current="Xc_image"><span>图片设置</span></li>
<li class="item" data-current="Xc_post"><span>文章设置</span></li>
<li class="item" data-current="Xc_aside"><span>侧栏设置</span></li>
<li class="item" data-current="Xc_home"><span>首页设置</span></li>
<li class="item" data-current="Xc_other"><span>其他设置</span></li>
<li class="item" data-current="Xc_top"><span>顶部设置</span></li>
<li class="item" data-current="Xc_beautify"><span>增强设置</span></li>
<li class="item" data-current="Xc_daohang"><span>站点导航</span></li>
</ul>
<?php require_once('core/storage.php'); ?>
</div></div>
<div class="Xc_config__notice">请求数据中...</div>
<?php
$JFavicon = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFavicon',
NULL,
'/usr/themes/Xc/assets/img/link.png',
'网站 Favicon 设置',
'介绍：用于设置网站 Favicon <br />
 格式：图片 URL地址 或 Base64 地址 <br />
 其他：免费转换 Favicon 网站 <a target="_blank" href="//tool.lu/favicon">tool.lu/favicon</a>'
);
$JFavicon->setAttribute('class', 'Xc_content Xc_image');
$form->addInput($JFavicon);

$JLogo = new Typecho_Widget_Helper_Form_Element_Textarea(
'JLogo',
NULL,
'/usr/themes/Xc/assets/img/link.png',
'网站 Logo 设置（白天模式）',
'介绍：用于设置网站 Logo，一个好的 Logo 能为网站带来有效的流量 <br />
 格式：图片 URL地址 或 Base64 地址 <br />
 其他：免费制作 logo 网站 <a target="_blank" href="//www.uugai.com">www.uugai.com</a>'
);
$JLogo->setAttribute('class', 'Xc_content Xc_image');
$form->addInput($JLogo);

$JLogo2 = new Typecho_Widget_Helper_Form_Element_Textarea(
'JLogo2',
NULL,
'/usr/themes/Xc/assets/img/link.png',
'网站 Logo 设置（夜间模式）',
'介绍：用于设置网站 Logo，一个好的 Logo 能为网站带来有效的流量 <br />
 格式：图片 URL地址 或 Base64 地址 <br />
 其他：免费制作 logo 网站 <a target="_blank" href="//www.uugai.com">www.uugai.com</a>'
);
$JLogo2->setAttribute('class', 'Xc_content Xc_image');
$form->addInput($JLogo2);

$Xc_The_notebook = new Typecho_Widget_Helper_Form_Element_Textarea(
'Xc_The_notebook',
NULL,
NULL,
'笔记本',
'介绍：可以记录一些不想发布的内容以及代码类<br />
 说明：只能当笔记用，不会有任何的操作'
);
$Xc_The_notebook->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($Xc_The_notebook);

$JAssetsURL = new Typecho_Widget_Helper_Form_Element_Text(
'JAssetsURL',
NULL,
NULL,
'自定义静态资源CDN地址（非必填）',
'介绍：自定义静态资源CDN地址，不填则走本地资源 <br />
 教程：<br />
 将整个assets目录上传至你的CDN根目录 <br />
 那就直接填写CDN地址：https://cdn.xxx.com（结尾不要加/） <br />
 如果assets放在CDN目录的文件夹内，则地址也需要加文件夹名'
);
$JAssetsURL->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JAssetsURL);

$JCommentStatus = new Typecho_Widget_Helper_Form_Element_Select(
'JCommentStatus',
array(
'on' => '开启（默认）',
'off' => '关闭'
),
'3',
'开启或关闭全站评论',
'介绍：用于一键开启关闭所有页面的评论 <br>
 注意：此处的权重优先级最高 <br>
 若关闭此项而文章内开启评论，评论依旧为关闭状态'
);
$JCommentStatus->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCommentStatus->multiMode());


$comment_login = new Typecho_Widget_Helper_Form_Element_Select(
'comment_login',
array(
'01' => '关闭（默认）',
'02' => '开启',
),
'01',
'开启登录评论',
'介绍：开启后游客需要登入才能评论'
);
$comment_login->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($comment_login->multiMode());

$JNavMaxNum = new Typecho_Widget_Helper_Form_Element_Select(
'JNavMaxNum',
array(
'3' => '3个（默认）',
'4' => '4个',
'5' => '5个',
'6' => '6个',
'7' => '7个',
'8' => '8个',
'9' => '9个',
),
'3',
'选择导航栏最大显示的个数',
'介绍：用于设置最大多少个后，以更多下拉框显示'
);
$JNavMaxNum->setAttribute('class', 'Xc_content Xc_global');
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
$JCustomNavs->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCustomNavs);

$JFooter_Left = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFooter_Left',
NULL,
'<p>2020 - 2023 ©版权所有<a href="https://www.xccx.cc" target="_blank"> Xc </a>',
'自定义底部栏内容',
'介绍：用于修改全站底部上方内容<br>
 注意：每条内容都用&lt;p>内容&lt;/p>包裹起来，包裹一次即可，换行需从新包裹<br>
 例如单文字内容：&lt;p>2020 - 2023 ©版权所有&lt;/p><br>
 例如有链接内容：&lt;p>2020 - 2023 ©版权所有&lt;a href="http://beian.miit.gov.cn/">ICP备888888号-1&lt;/a>&lt;/p>'
);
$JFooter_Left->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JFooter_Left);

$footer_online = new Typecho_Widget_Helper_Form_Element_Select(
'footer_online',
array(
'off' => '关闭（默认）',
'on' => '开启',
),
'off',
'开启底部人数统计',
'介绍：显示总访问次数，和当前在线人数'
);
$footer_online->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($footer_online->multiMode());

$JBirthDay = new Typecho_Widget_Helper_Form_Element_Text(
'JBirthDay',
NULL,
NULL,
'网站成立日期（非必填）',
'介绍：用于显示当前站点已经运行了多少时间。<br>
 注意：填写时务必保证填写正确！例如：2021/1/1 00:00:00 <br>
 其他：不填写则不显示，若填写错误，则不会显示计时'
);
$JBirthDay->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JBirthDay);

$JDocumentTitle = new Typecho_Widget_Helper_Form_Element_Text(
'JDocumentTitle',
NULL,
NULL,
'网页被隐藏时显示的标题',
'介绍：在PC端切换网页标签时，网站标题显示的内容。如果不填写，则默认不开启 <br />
 注意：严禁加单引号或双引号！！！否则会导致网站出错！！'
);
$JDocumentTitle->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JDocumentTitle);

$JCursorEffects = new Typecho_Widget_Helper_Form_Element_Select(
'JCursorEffects',
array(
'off' => '关闭（默认）',
'cursor1.js' => '效果1',
'cursor2.js' => '效果2',
'cursor3.js' => '效果3',
'cursor4.js' => '效果4',
'cursor5.js' => '效果5',
'cursor6.js' => '效果6',
'cursor7.js' => '效果7',
'cursor8.js' => '效果8',
'cursor9.js' => '效果9',
'cursor10.js' => '效果10',
'cursor11.js' => '效果11',
),
'off',
'选择鼠标特效',
'介绍：用于开启炫酷的鼠标特效'
);
$JCursorEffects->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCursorEffects->multiMode());

$JCustomCSS = new Typecho_Widget_Helper_Form_Element_Textarea(
'JCustomCSS',
NULL,
NULL,
'自定义CSS（非必填）',
'介绍：请填写自定义CSS内容，填写时无需填写style标签。<br />
 其他：如果想修改主题色、卡片透明度等，都可以通过这个实现 <br />
 例如：body { --theme: #ff6800; --background: rgba(255,255,255,0.85) }'
);
$JCustomCSS->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCustomCSS);

$JCustomScript = new Typecho_Widget_Helper_Form_Element_Textarea(
'JCustomScript',
NULL,
NULL,
'自定义JS（非必填）',
'介绍：请填写自定义JS内容，例如网站统计等，填写时无需填写script标签。'
);
$JCustomScript->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCustomScript);

$JCustomHeadEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
'JCustomHeadEnd',
NULL,
NULL,
'自定义增加&lt;head&gt;&lt;/head&gt;里内容（非必填）',
'介绍：此处用于在&lt;head&gt;&lt;/head&gt;标签里增加自定义内容 <br />
 例如：可以填写引入第三方css、js等等'
);
$JCustomHeadEnd->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCustomHeadEnd);

$JCustomBodyEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
'JCustomBodyEnd',
NULL,
NULL,
'自定义&lt;body&gt;&lt;/body&gt;末尾位置内容（非必填）',
'介绍：此处用于填写在&lt;body&gt;&lt;/body&gt;标签末尾位置的内容 <br>
 例如：可以填写引入第三方js脚本等等'
);
$JCustomBodyEnd->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCustomBodyEnd);

// 网页字体
$Xc_Theme_font = new Typecho_Widget_Helper_Form_Element_Select(
'Xc_Theme_font',
array(
'01' => '关闭字体',
'02' => '思源黑体（默认）',
'03' => '思源宋体',
'04' => '小米字体',
'05' => '程序员字体',
),
'02',
'网页字体',
'注意：使用此选项字体请勿填写自定义字体链接'
);
$Xc_Theme_font->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($Xc_Theme_font->multiMode());

$JCustomFont = new Typecho_Widget_Helper_Form_Element_Text(
'JCustomFont',
NULL,
NULL,
'自定义网页字体',
'格式：填写字体链接即可 <br>
 注意：使用自定义字体请关闭选项字体 <br>
 oppo字体（细）：https://dsfs.oppo.com/store/public/font/OPPOSans-Regular.woff2 <br>
 oppo字体（粗）：https://dsfs.oppo.com/store/public/font/OPPOSans-Medium.woff2'
);
$JCustomFont->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCustomFont);

$JCustomAvatarSource = new Typecho_Widget_Helper_Form_Element_Text(
'JCustomAvatarSource',
NULL,
NULL,
'自定义头像源（非必填）',
'介绍：用于修改全站头像源地址 <br>
 例如：https://gravatar.ihuan.me/avatar/ <br>
 其他：非必填，默认头像源为https://gravatar.helingqi.com/wavatar/ <br>
 注意：填写时，务必保证最后有一个/字符，否则不起作用！'
);
$JCustomAvatarSource->setAttribute('class', 'Xc_content Xc_global');
$form->addInput($JCustomAvatarSource);

// 侧边栏位子
$aside_weizi = new Typecho_Widget_Helper_Form_Element_Select(
'aside_weizi',
array(
'01' => '侧边栏靠右（默认）',
'02' => '侧边栏靠左'
),
'on',
'侧边栏显示位子',
'介绍：侧边栏靠左显示或靠右显示 默认靠右'
);
$aside_weizi->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($aside_weizi->multiMode());

// 首页 分类 搜索侧边栏
$JAside_cebianlan = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_cebianlan',
array(
'on' => '开启（默认）',
'off' => '关闭'
),
'on',
'是否显示首页 分类 搜索页侧边栏',
'介绍：显示首页侧边栏'
);
$JAside_cebianlan->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_cebianlan->multiMode());

// 文章页侧边栏（PC）
$JAside_cblpost = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_cblpost',
array(
'on' => '开启（默认）',
'off' => '关闭'
),
'on',
'是否显示文章页侧边栏',
'介绍：显示文章页侧边栏'
);
$JAside_cblpost->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_cblpost->multiMode());

// 独立页侧边栏
$JAside_cblpage = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_cblpage',
array(
'on' => '开启（默认）',
'off' => '关闭'
),
'on',
'是否显示独立页侧边栏',
'介绍：显示独立页侧边栏'
);
$JAside_cblpage->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_cblpage->multiMode());


$JAside_Author_Nick = new Typecho_Widget_Helper_Form_Element_Text(
'JAside_Author_Nick',
NULL,
"Typecho",
'博主栏博主昵称 - PC/WAP',
'介绍：用于修改博主栏的博主昵称 <br />
 注意：如果不填写时则显示 *个人设置* 里的昵称'
);
$JAside_Author_Nick->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Author_Nick);

$JAside_Author_Avatar = new Typecho_Widget_Helper_Form_Element_Textarea(
'JAside_Author_Avatar',
NULL,
NULL,
'博主栏博主头像 - PC/WAP',
'介绍：用于修改博主栏的博主头像 <br />
 注意：如果不填写时则显示 *个人设置* 里的头像'
);
$JAside_Author_Avatar->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Author_Avatar);

$JAside_Author_Image = new Typecho_Widget_Helper_Form_Element_Textarea(
'JAside_Author_Image',
NULL,
"/usr/themes/Xc/assets/img/aside_author_image.jpg",
'博主栏背景壁纸 - PC',
'介绍：用于修改PC端博主栏的背景壁纸 <br/>
 格式：图片地址 或 Base64地址'
);
$JAside_Author_Image->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Author_Image);

$JAside_Wap_Image = new Typecho_Widget_Helper_Form_Element_Textarea(
'JAside_Wap_Image',
NULL,
"/usr/themes/Xc/assets/img/wap_aside_image.jpg",
'博主栏背景壁纸 - WAP',
'介绍：用于修改WAP端博主栏的背景壁纸 <br/>
 格式：图片地址 或 Base64地址'
);
$JAside_Wap_Image->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Wap_Image);

$JAside_Author_Link = new Typecho_Widget_Helper_Form_Element_Text(
'JAside_Author_Link',
NULL,
"https://www.xccx.cc",
'博主栏昵称跳转地址 - PC/WAP',
'介绍：用于修改博主栏点击博主昵称后的跳转地址'
);
$JAside_Author_Link->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Author_Link);

$JAside_Author_Motto = new Typecho_Widget_Helper_Form_Element_Textarea(
'JAside_Author_Motto',
NULL,
"有钱终成眷属，没钱亲眼目睹",
'博主栏座右铭（一言）- PC/WAP',
'介绍：用于修改博主栏的座右铭（一言） <br />
 格式：可以填写多行也可以填写一行，填写多行时，每次随机显示其中的某一条，也可以填写API地址 <br />
 其他：API和自定义的座右铭完全可以一起写（换行填写），不会影响 <br />
 注意：API需要开启跨域权限才能调取，否则会调取失败！<br />
 推荐API：https://api.vvhan.com/api/ian'
);
$JAside_Author_Motto->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Author_Motto);

// 手机端数据统计
$JAside_waptj = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_waptj',
array(
'off' => '关闭（默认）',
'on' => '开启',
),
'off',
'手机端数据统计（WAP）',
'是否显示手机端侧边栏数据统计'
);
$JAside_waptj->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_waptj->multiMode());

$JAside_Author_Nav = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_Author_Nav',
array(
'off' => '关闭（默认）',
'3' => '开启，并显示3条最新文章',
'4' => '开启，并显示4条最新文章',
'5' => '开启，并显示5条最新文章',
'6' => '开启，并显示6条最新文章',
'7' => '开启，并显示7条最新文章',
'8' => '开启，并显示8条最新文章',
'9' => '开启，并显示9条最新文章',
'10' => '开启，并显示10条最新文章'
),
'off',
'博主栏下方随机文章条目 - PC',
'介绍：用于设置博主栏下方的随机文章显示数量'
);
$JAside_Author_Nav->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Author_Nav->multiMode());

$JAside_Timelife_Status = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_Timelife_Status',
array(
'off' => '关闭（默认）',
'on' => '开启'
),
'off',
'是否开启人生倒计时模块 - PC',
'介绍：用于控制是否显示人生倒计时模块'
);
$JAside_Timelife_Status->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Timelife_Status->multiMode());

$JAside_Hot_Num = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_Hot_Num',
array(
'off' => '关闭（默认）',
'3' => '显示3条',
'4' => '显示4条',
'5' => '显示5条',
'6' => '显示6条',
'7' => '显示7条',
'8' => '显示8条',
'9' => '显示9条',
'10' => '显示10条',
),
'off',
'是否开启热门文章栏 - PC',
'介绍：用于控制是否开启热门文章栏'
);
$JAside_Hot_Num->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Hot_Num->multiMode());

$JAside_Newreply_Status = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_Newreply_Status',
array(
'off' => '关闭（默认）',
'on' => '开启'
),
'off',
'是否开启最新回复栏 - PC',
'介绍：用于控制是否开启最新回复栏 <br>
 注意：如果您关闭了全站评论，将不会显示最新回复！'
);
$JAside_Newreply_Status->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Newreply_Status->multiMode());

$JADContent = new Typecho_Widget_Helper_Form_Element_Textarea(
'JADContent',
NULL,
NULL,
'侧边栏广告 - PC',
'介绍：用于设置侧边栏广告 <br />
 格式：广告图片 || 跳转链接 （中间使用两个竖杠分隔）<br />
 注意：如果您只想显示图片不想跳转，可填写：广告图片 || javascript:void(0)'
);
$JADContent->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JADContent);

$JCustomAside = new Typecho_Widget_Helper_Form_Element_Textarea(
'JCustomAside',
NULL,
NULL,
'自定义侧边栏模块 - PC',
'介绍：用于自定义侧边栏模块 <br />
 格式：请填写前端代码，不会写请勿填写 <br />
 例如：您可以在此处添加一个公告、时间、宠物、恋爱计时等等'
);
$JCustomAside->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JCustomAside);

// 自定义侧边栏模块（WAP）
$JCustomAside2 = new Typecho_Widget_Helper_Form_Element_Textarea(
'JCustomAside2',
NULL,
NULL,
'自定义侧边栏模块（WAP）',
'介绍：用于自定义手机端的侧边栏模块 <br />
 格式：请填写前端代码，不会写请勿填写，以免乱码 <br />
 例如：您可以在此处添加一个公告、时间、宠物、恋爱计时等等'
);
$JCustomAside2->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JCustomAside2);

$JAside_3DTag = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_3DTag',
array(
'off' => '关闭（默认）',
'on' => '开启'
),
'off',
'是否开启云标签 - PC',
'介绍：用于设置侧边栏是否显示云标签'
);
$JAside_3DTag->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_3DTag->multiMode());

$JAside_Flatterer = new Typecho_Widget_Helper_Form_Element_Select(
'JAside_Flatterer',
array(
'off' => '关闭（默认）',
'on' => '开启'
),
'off',
'是否开启舔狗日记 - PC',
'介绍：用于设置侧边栏是否显示舔狗日记'
);
$JAside_Flatterer->setAttribute('class', 'Xc_content Xc_aside');
$form->addInput($JAside_Flatterer->multiMode());


$JThumbnail = new Typecho_Widget_Helper_Form_Element_Textarea(
'JThumbnail',
NULL,
NULL,
'自定义缩略图',
'介绍：用于修改主题默认缩略图 <br/>
 格式：图片地址，一行一个 <br />
 注意：不填写时，则使用主题内置的默认缩略图
 '
);
$JThumbnail->setAttribute('class', 'Xc_content Xc_image');
$form->addInput($JThumbnail);

$JLazyload = new Typecho_Widget_Helper_Form_Element_Textarea(
'JLazyload',
NULL,
"/usr/themes/Xc/assets/img/lazyload.jpg",
'自定义懒加载图',
'介绍：用于修改主题默认懒加载图 <br/>
 格式：图片地址'
);
$JLazyload->setAttribute('class', 'Xc_content Xc_image');
$form->addInput($JLazyload);

$JDynamic_Background = new Typecho_Widget_Helper_Form_Element_Select(
'JDynamic_Background',
array(
'off' => '关闭（默认）',
'backdrop1.js' => '效果1',
'backdrop2.js' => '效果2',
'backdrop3.js' => '效果3',
'backdrop4.js' => '效果4',
'backdrop5.js' => '效果5',
'backdrop6.js' => '效果6'
),
'off',
'是否开启动态背景图（仅限PC）',
'介绍：用于设置PC端动态背景<br />
 注意：如果您填写了下方PC端静态壁纸，将优先展示下方静态壁纸！如需显示动态壁纸，请将PC端静态壁纸设置成空'
);
$JDynamic_Background->setAttribute('class', 'Xc_content Xc_image');
$form->addInput($JDynamic_Background->multiMode());

$JWallpaper_Background_PC = new Typecho_Widget_Helper_Form_Element_Textarea(
'JWallpaper_Background_PC',
NULL,
NULL,
'PC端网站背景图片（非必填）',
'介绍：PC端网站的背景图片，不填写时显示默认的灰色。<br />
 格式：图片URL地址 或 随机图片api 例如：https://api.btstu.cn/sjbz/?lx=dongman <br />
 注意：如果需要显示上方动态壁纸，请不要填写此项，此项优先级最高！'
);
$JWallpaper_Background_PC->setAttribute('class', 'Xc_content Xc_image');
$form->addInput($JWallpaper_Background_PC);

$JWallpaper_Background_WAP = new Typecho_Widget_Helper_Form_Element_Textarea(
'JWallpaper_Background_WAP',
NULL,
NULL,
'WAP端网站背景图片（非必填）',
'介绍：WAP端网站的背景图片，不填写时显示默认的灰色。<br />
 格式：图片URL地址 或 随机图片api 例如：https://api.btstu.cn/sjbz/?lx=m_dongman'
);
$JWallpaper_Background_WAP->setAttribute('class', 'Xc_content Xc_image');
$form->addInput($JWallpaper_Background_WAP);

$JIndex_Carousel = new Typecho_Widget_Helper_Form_Element_Textarea(
'JIndex_Carousel',
NULL,
NULL,
'首页轮播图',
'介绍：用于显示首页轮播图，请务必填写正确的格式 <br />
 格式：图片地址 || 跳转链接 || 标题 （中间使用两个竖杠分隔）<br />
 其他：一行一个，一行代表一个轮播图 <br />
 例如：<br />
https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0 || https://baidu.com || 百度一下 <br />
https://puui.qpic.cn/tv/0/1223447268_1680580/0 || https://v.qq.com || 腾讯视频
 '
);
$JIndex_Carousel->setAttribute('class', 'Xc_content Xc_home');
$form->addInput($JIndex_Carousel);

$JIndex_Recommend = new Typecho_Widget_Helper_Form_Element_Text(
'JIndex_Recommend',
NULL,
NULL,
'首页推荐文章（主题样式1 2 3 6生效）',
'介绍：用于显示推荐文章，请务必填写正确的格式 <br/>
 格式：文章的id || 文章的id （中间使用两个竖杠分隔）<br />
 例如：1 || 2 <br />
 注意：必须填写两个，如果填写的不是2个，将不会显示'
);
$JIndex_Recommend->setAttribute('class', 'Xc_content Xc_home');
$form->addInput($JIndex_Recommend);

$JIndexSticky = new Typecho_Widget_Helper_Form_Element_Text(
'JIndexSticky',
NULL,
NULL,
'首页置顶文章',
'介绍：请务必填写正确的格式 <br />
 格式：文章的ID || 文章的ID || 文章的ID （中间使用两个竖杠分隔）<br />
 例如：1 || 2 || 3'
);
$JIndexSticky->setAttribute('class', 'Xc_content Xc_home');
$form->addInput($JIndexSticky);

$JIndex_Hot = new Typecho_Widget_Helper_Form_Element_Radio(
'JIndex_Hot',
array('off' => '关闭（默认）', 'on' => '开启'),
'off',
'首页热门文章（主题样式1 2 3 6生效）',
'介绍：开启后，网站首页将会显示浏览量最多的4篇热门文章'
);
$JIndex_Hot->setAttribute('class', 'Xc_content Xc_home');
$form->addInput($JIndex_Hot->multiMode());

$JIndex_Ad = new Typecho_Widget_Helper_Form_Element_Textarea(
'JIndex_Ad',
NULL,
NULL,
'首页大屏广告',
'介绍：请务必填写正确的格式 <br />
 格式：广告图片 || 广告链接 （中间使用两个竖杠分隔，限制一个）<br />
 例如：https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0 || https://baidu.com'
);
$JIndex_Ad->setAttribute('class', 'Xc_content Xc_home');
$form->addInput($JIndex_Ad);

// 自定义首页文章顶部公告（WAP）
$Xct_index_customize = new Typecho_Widget_Helper_Form_Element_Textarea(
'Xct_index_customize',
NULL,
NULL,
'首页自定义模块',
'介绍：用于自定义首页文章列表顶上的模块 <br />
 格式：请填写前端代码，不会写请勿填写，以免乱码 <br />
 例如：自由发挥吧 程序猿！'
);
$Xct_index_customize->setAttribute('class', 'Xc_content Xc_home');
$form->addInput($Xct_index_customize);

$JIndex_Notice = new Typecho_Widget_Helper_Form_Element_Textarea(
'JIndex_Notice',
NULL,
NULL,
'首页通知文字（主题样式1生效）',
'介绍：请务必填写正确的格式 <br />
 格式：通知文字 || 跳转链接（中间使用两个竖杠分隔，限制一个）<br />
 例如：欢迎加入Xc官方QQ群 || https://baidu.com'
);
$JIndex_Notice->setAttribute('class', 'Xc_content Xc_home');
$form->addInput($JIndex_Notice);

$JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
'JFriends',
NULL,
'狱长 || https://www.xccx.cc || https://www.xccx.cc/tp/tx.png || 心中无女人，代码自然神',
'友情链接（非必填）',
'介绍：用于填写友情链接 <br />
 注意：您需要先增加友链链接页面（新增独立页面-右侧模板选择友链），该项才会生效 <br />
 格式：博客名称 || 博客地址 || 博客头像 || 博客简介 <br />
 其他：一行一个，一行代表一个友链'
);
$JFriends->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JFriends);

$JCustomPlayer = new Typecho_Widget_Helper_Form_Element_Text(
'JCustomPlayer',
NULL,
NULL,
'自定义视频播放器（非必填）',
'介绍：用于修改主题自带的默认播放器 <br />
 例如：https://v.ini0.com/player/?url= <br />
 注意：主题自带的播放器只能解析M3U8的视频格式'
);
$JCustomPlayer->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JCustomPlayer);

$JSensitiveWords = new Typecho_Widget_Helper_Form_Element_Textarea(
'JSensitiveWords',
NULL,
'你妈死了 || 傻逼 || 操你妈 || 射你妈一脸',
'评论敏感词（非必填）',
'介绍：用于设置评论敏感词汇，如果用户评论包含这些词汇，则将会把评论置为审核状态 <br />
 例如：你妈死了 || 你妈炸了 || 我是你爹 || 你妈坟头冒烟 （多个使用 || 分隔开）'
);
$JSensitiveWords->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JSensitiveWords);

$JLimitOneChinese = new Typecho_Widget_Helper_Form_Element_Select(
'JLimitOneChinese',
array('off' => '关闭（默认）', 'on' => '开启'),
'off',
'是否开启评论至少包含一个中文',
'介绍：开启后如果评论内容未包含一个中文，则将会把评论置为审核状态 <br />
 其他：用于屏蔽国外机器人刷的全英文垃圾广告信息'
);
$JLimitOneChinese->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JLimitOneChinese->multiMode());

$JTextLimit = new Typecho_Widget_Helper_Form_Element_Text(
'JTextLimit',
NULL,
NULL,
'限制用户评论最大字符',
'介绍：如果用户评论的内容超出字符限制，则将会把评论置为审核状态 <br />
 其他：请输入数字格式，不填写则不限制'
);
$JTextLimit->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JTextLimit->multiMode());

$JSiteMap = new Typecho_Widget_Helper_Form_Element_Select(
'JSiteMap',
array(
'off' => '关闭（默认）',
'100' => '显示最新 100 条链接',
'200' => '显示最新 200 条链接',
'300' => '显示最新 300 条链接',
'400' => '显示最新 400 条链接',
'500' => '显示最新 500 条链接',
'600' => '显示最新 600 条链接',
'700' => '显示最新 700 条链接',
'800' => '显示最新 800 条链接',
'900' => '显示最新 900 条链接',
'1000' => '显示最新 1000 条链接',
),
'off',
'是否开启主题自带SiteMap功能',
'介绍：开启后博客将享有SiteMap功能 <br />
 其他：链接为博客最新实时链接 <br />
 好处：无需手动生成，无需频繁提交，提交一次即可 <br />
 开启后SiteMap访问地址：<br />
 http(s)://域名/sitemap.xml （开启了伪静态）<br />  
 http(s)://域名/index.php/sitemap.xml （未开启伪静态）
 '
);
$JSiteMap->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JSiteMap->multiMode());

/* 评论发信 */
$JCommentMail = new Typecho_Widget_Helper_Form_Element_Select(
'JCommentMail',
array('off' => '关闭（默认）', 'on' => '开启'),
'off',
'是否开启评论邮件通知',
'介绍：开启后评论内容将会进行邮箱通知 <br />
 注意：此项需要您完整无错的填写下方的邮箱设置！！ <br />
 其他：下方例子以QQ邮箱为例，推荐使用QQ邮箱'
);
$JCommentMail->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JCommentMail->multiMode());

$JCommentMailHost = new Typecho_Widget_Helper_Form_Element_Text(
'JCommentMailHost',
NULL,
NULL,
'邮箱服务器地址',
'例如：smtp.qq.com'
);
$JCommentMailHost->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JCommentMailHost->multiMode());

$JCommentSMTPSecure = new Typecho_Widget_Helper_Form_Element_Select(
'JCommentSMTPSecure',
array('ssl' => 'ssl（默认）', 'tsl' => 'tsl'),
'ssl',
'加密方式',
'介绍：用于选择登录鉴权加密方式'
);
$JCommentSMTPSecure->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JCommentSMTPSecure->multiMode());

$JCommentMailPort = new Typecho_Widget_Helper_Form_Element_Text(
'JCommentMailPort',
NULL,
NULL,
'邮箱服务器端口号',
'例如：465'
);
$JCommentMailPort->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JCommentMailPort->multiMode());

$JCommentMailFromName = new Typecho_Widget_Helper_Form_Element_Text(
'JCommentMailFromName',
NULL,
NULL,
'发件人昵称',
'例如：帅气的象拔蚌'
);
$JCommentMailFromName->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JCommentMailFromName->multiMode());

$JCommentMailAccount = new Typecho_Widget_Helper_Form_Element_Text(
'JCommentMailAccount',
NULL,
NULL,
'发件人邮箱',
'例如：123456@qq.com'
);
$JCommentMailAccount->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JCommentMailAccount->multiMode());

$JCommentMailPassword = new Typecho_Widget_Helper_Form_Element_Text(
'JCommentMailPassword',
NULL,
NULL,
'邮箱授权码',
'介绍：这里填写的是邮箱生成的授权码 <br>
 获取方式（以QQ邮箱为例）：<br>
 QQ邮箱 > 设置 > 账户 > IMAP/SMTP服务 > 开启 <br>
 其他：这个可以百度一下开启教程，有图文教程'
);
$JCommentMailPassword->setAttribute('class', 'Xc_content Xc_other');
$form->addInput($JCommentMailPassword->multiMode());


$JBaiduToken = new Typecho_Widget_Helper_Form_Element_Text(
'JBaiduToken',
NULL,
NULL,
'百度推送Token',
'介绍：填写此处，前台文章页如果未收录，则会自动将当前链接推送给百度加快收录 <br />
 其他：Token在百度收录平台注册账号获取'
);
$JBaiduToken->setAttribute('class', 'Xc_content Xc_post');
$form->addInput($JBaiduToken);

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
$JOverdue->setAttribute('class', 'Xc_content Xc_post');
$form->addInput($JOverdue->multiMode());

$JEditor = new Typecho_Widget_Helper_Form_Element_Select(
'JEditor',
array(
'on' => '开启（默认）',
'off' => '关闭',
),
'on',
'是否启用主题内置编辑器',
'介绍：开启后，文章编辑器将替换成主题内置编辑器 <br>
 其他：如果想继续使用原生编辑器，关闭此项即可'
);
$JEditor->setAttribute('class', 'Xc_content Xc_post');
$form->addInput($JEditor->multiMode());

$JPrismTheme = new Typecho_Widget_Helper_Form_Element_Select(
'JPrismTheme',
array(
'/usr/themes/Xc/assets/code/prism.css' => 'prism（默认）',
'/usr/themes/Xc/assets/code/prism-dark.css' => 'prism-dark',
'/usr/themes/Xc/assets/code/prism-okaidia.css' => 'prism-okaidia',
'/usr/themes/Xc/assets/code/prism-solarizedlight.css' => 'prism-solarizedlight',
'/usr/themes/Xc/assets/code/prism-tomorrow.css' => 'prism-tomorrow',
'/usr/themes/Xc/assets/code/prism-twilight.css' => 'prism-twilight',
'/usr/themes/Xc/assets/code/prism-a11y-dark.css' => 'prism-a11y-dark',
'/usr/themes/Xc/assets/code/prism-atom-dark.css' => 'prism-atom-dark',
'/usr/themes/Xc/assets/code/prism-basexc.light.css' => 'prism-base16-ateliersulphurpool.light',
'/usr/themes/Xc/assets/code/prism-cb.css' => 'prism-cb',
'/usr/themes/Xc/assets/code/prism-coldark-cold.css' => 'prism-coldark-cold',
'/usr/themes/Xc/assets/code/prism-coldark-dark.css' => 'prism-coldark-dark',
'/usr/themes/Xc/assets/code/prism-darcula.css' => 'prism-darcula',
'/usr/themes/Xc/assets/code/prism-dracula.css' => 'prism-dracula',
'/usr/themes/Xc/assets/code/prism-duotone-dark.css' => 'prism-duotone-dark',
'/usr/themes/Xc/assets/code/prism-duotone-earth.css' => 'prism-duotone-earth',
'/usr/themes/Xc/assets/code/prism-duotone-forest.css' => 'prism-duotone-forest',
'/usr/themes/Xc/assets/code/prism-duotone-light.css' => 'prism-duotone-light',
'/usr/themes/Xc/assets/code/prism-duotone-sea.css' => 'prism-duotone-sea',
'/usr/themes/Xc/assets/code/prism-duotone-space.css' => 'prism-duotone-space',
'/usr/themes/Xc/assets/code/prism-ghcolors.css' => 'prism-ghcolors',
'/usr/themes/Xc/assets/code/prism-gruvbox-dark.css' => 'prism-gruvbox-dark',
'/usr/themes/Xc/assets/code/prism-hopscotch.css' => 'prism-hopscotch',
'/usr/themes/Xc/assets/code/prism-lucario.css' => 'prism-lucario',
'/usr/themes/Xc/assets/code/prism-material-dark.css' => 'prism-material-dark',
'/usr/themes/Xc/assets/code/prism-material-light.css' => 'prism-material-light',
'/usr/themes/Xc/assets/code/prism-material-oceanic.css' => 'prism-material-oceanic',
'/usr/themes/Xc/assets/code/prism-night-owl.css' => 'prism-night-owl',
'/usr/themes/Xc/assets/code/prism-nord.css' => 'prism-nord',
'/usr/themes/Xc/assets/code/prism-pojoaque.css' => 'prism-pojoaque',
'/usr/themes/Xc/assets/code/prism-shades-of-purple.css' => 'prism-shades-of-purple',
'/usr/themes/Xc/assets/code/prism-synthwave84.css' => 'prism-synthwave84',
'/usr/themes/Xc/assets/code/prism-vs.css' => 'prism-vs',
'/usr/themes/Xc/assets/code/prism-vsc-dark-plus.css' => 'prism-vsc-dark-plus',
'/usr/themes/Xc/assets/code/prism-xonokai.css' => 'prism-xonokai',
'/usr/themes/Xc/assets/code/prism-onelight.css' => 'prism-onelight',
'/usr/themes/Xc/assets/code/prism-onedark.css' => 'prism-onedark',
'/usr/themes/Xc/assets/code/prism-onedark.css' => 'prism-onedark2',
),
'/usr/themes/Xc/assets/code/prism.css',
'选择一款您喜欢的代码高亮样式',
'介绍：用于修改代码块的高亮风格 <br>
 其他：如果您有其他样式，可通过源代码修改此项，引入您的自定义样式链接'
);
$JPrismTheme->setAttribute('class', 'Xc_content Xc_post');
$form->addInput($JPrismTheme->multiMode());

$post_dashang = new Typecho_Widget_Helper_Form_Element_Select(
'post_dashang',
array(
'off' => '关闭（默认）',
'on' => '开启',
),
'off',
'开启文章打赏',
'介绍：开启后需在下面设置二维码打赏地址'
);
$post_dashang->setAttribute('class', 'Xc_content Xc_post');
$form->addInput($post_dashang->multiMode());

$post_dashang_wx = new Typecho_Widget_Helper_Form_Element_Text(
'post_dashang_wx',
NULL,
NULL,
'微信打赏二维码',
'介绍：填写二维码图片地址即可 <br />
 说明：不填则不显示'
);
$post_dashang_wx->setAttribute('class', 'Xc_content Xc_post');
$form->addInput($post_dashang_wx->multiMode());

$post_dashang_zfb = new Typecho_Widget_Helper_Form_Element_Text(
'post_dashang_zfb',
NULL,
NULL,
'支付宝打赏二维码',
'介绍：填写二维码图片地址即可 <br />
 说明：不填则不显示'
);
$post_dashang_zfb->setAttribute('class', 'Xc_content Xc_post');
$form->addInput($post_dashang_zfb->multiMode());

$post_dashang_qq = new Typecho_Widget_Helper_Form_Element_Text(
'post_dashang_qq',
NULL,
NULL,
'ＱＱ打赏二维码',
'介绍：填写二维码图片地址即可 <br />
 说明：不填则不显示'
);
$post_dashang_qq->setAttribute('class', 'Xc_content Xc_post');
$form->addInput($post_dashang_qq->multiMode());

require_once("Xccx/xccx_admin.php");
} ?>