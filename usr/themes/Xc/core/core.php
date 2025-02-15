<?php

// 获取资源路径
function _getAssets($assets, $type = true)
{
  $assetsURL = "";
// 是否本地化资源
  if (Helper::options()->JAssetsURL) {
$assetsURL = Helper::options()->JAssetsURL . '/' . $assets;
  } else {
$assetsURL = Helper::options()->themeUrl . '/' . $assets;
  }
  if ($type) echo $assetsURL;
  else return  $assetsURL;
}

// 页面加载计时
_startCountTime();

// 总访问量
function theAllViews(){
$db = Typecho_Db::get();
$row = $db->fetchAll('SELECT SUM(VIEWS) FROM `typecho_contents`');
echo number_format($row[0]['SUM(VIEWS)']);}

// 标签总数量
function _Tagtotal()
{
$db = Typecho_Db::get();
return $db->fetchObject($db->select(array('COUNT(mid)' => 'num'))
->from('table.metas')
->where('table.metas.type = ?', 'tag'))->num;
}

// 首页顶部图 可随机
function _Xc_img($item) {
$custom_thumbnail = Helper::options()->JWallpaper_picture_index;
$result = [];
if ($custom_thumbnail) {
$custom_thumbnail_arr = explode("\r", $custom_thumbnail);
$randomIndex = array_rand($custom_thumbnail_arr, 1);
// 开启随机key  $result[] = $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);
$result[] = trim(strtok($custom_thumbnail_arr[$randomIndex], "?"));
} else {
// 如果自定义图配置项为空，设置默认图片链接
$result[] = "";
}
return $result;
}

// 全局懒加载图
function _getLazyload($type = true){
if ($type) echo Helper::options()->JLazyload;
else return Helper::options()->JLazyload;}
require_once('thecore.php');

// 头像懒加载图
function _getAvatarLazyload($type = true){
$str = "/usr/themes/Xc/assets/img/txlazyload.png";
if ($type) echo $str;
else return $str;}

// 文章浏览量
function _getViews($item, $type = true){
$db = Typecho_Db::get();
$result = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $item->cid))['views'];
if ($type) echo number_format($result);
else return number_format($result);}

// 文章点赞量
function _getAgree($item, $type = true){
$db = Typecho_Db::get();
$result = $db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $item->cid))['agree'];
if ($type) echo number_format($result);
else return number_format($result);}

// 页面开始计时
function _startCountTime(){
global $timeStart;
$mTime = explode(' ', microtime());
$timeStart = $mTime[1] + $mTime[0];
return true;}

// 页面结束计时
function _endCountTime($precision = 3){
global $timeStart, $timeEnd;
$mTime = explode(' ', microtime());
$timeEnd   = $mTime[1] + $mTime[0];
$timeTotal = number_format($timeEnd - $timeStart, $precision);
echo $timeTotal < 1 ? $timeTotal * 1000 . 'ms' : $timeTotal . 's';}

// 父级评论
function _getParentReply($parent){
if ($parent !== "0") {
$db = Typecho_Db::get();
$commentInfo = $db->fetchRow( $db->select('author') ->from('table.comments') ->where('coid = ?', $parent) ->limit(1) );
if ($commentInfo) {
echo '<div class="parent"><span style="vertical-align: 0px;">@</span>' . $commentInfo['author'] . '</div>';
}}}


// 判断是否是手机
function _isMobile(){
if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
return true;
if (isset($_SERVER['HTTP_VIA'])) {
return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;}
if (isset($_SERVER['HTTP_USER_AGENT'])) {
$clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
return true;}
if (isset($_SERVER['HTTP_ACCEPT'])) {
if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
return true;}}
return false;}


// 通过邮箱生成头像地址
function _getAvatarByMail($mail, $type = true){
$gravatarsUrl = Helper::options()->JCustomAvatarSource ? Helper::options()->JCustomAvatarSource : 'https://gravatar.helingqi.com/wavatar/';
$mailLower = strtolower($mail);
$md5MailLower = md5($mailLower);
$qqMail = str_replace('@qq.com', '', $mailLower);
if (strstr($mailLower, "qq.com") && is_numeric($qqMail) && strlen($qqMail) < 11 && strlen($qqMail) > 4) {
if ($type) {echo 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';}
else {return 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';}}
else {if ($type) {echo $gravatarsUrl . $md5MailLower . '?d=mm';} 
else {return $gravatarsUrl . $md5MailLower . '?d=mm';}}};

// 侧边栏随机一言
function _getAsideAuthorMotto(){
$JMottoRandom = explode("\r\n", Helper::options()->JAside_Author_Motto);
echo $JMottoRandom[array_rand($JMottoRandom, 1)];}

// 文章摘要
function _getAbstract($item, $type=true, $maxLength=200){
$abstract = "";
if ($item->password) {
$abstract = "加密文章，请前往内页查看详情";
} else {
if ($item->fields->abstract) {
$abstract = $item->fields->abstract;
} else {
$abstract = strip_tags($item->excerpt);
if (strpos($abstract, '{hide') !== false) {
$abstract = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '隐藏内容，请前往内页查看详情', $abstract);
}
$abstract = preg_replace('/{dplayer[^}]*}/', '视频内容，请前往内页查看详情', $abstract);
$abstract = preg_replace('/{bilibili[^}]*}/', '视频内容，请前往内页查看详情', $abstract);
$abstract = preg_replace('/{mp3[^}]*\/}/', '在线音乐，请前往内页查看详情', $abstract);
$abstract = preg_replace('/{music[^}]*\/}/', '在线音乐，请前往内页查看详情', $abstract);
$abstract = preg_replace('/{music-list[^}]*\/}/', '在线音乐，请前往内页查看详情', $abstract);
}
}
if ($abstract === '') {
$abstract = "暂无简介";
}
if (mb_strlen($abstract, 'utf-8') > $maxLength) {
$abstract = mb_substr($abstract, 0, $maxLength, 'utf-8') . '...';
}
if ($type) {
echo $abstract;
} else {
return $abstract;
}
}

// 文章缩略图
function _getThumbnails($item){
$result = [];
$pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
$patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
$patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
if ($item->fields->thumb) {
$fields_thumb_arr = explode("\r\n", $item->fields->thumb);
foreach ($fields_thumb_arr as $list) $result[] = $list;}
if (preg_match_all($pattern, $item->content, $thumbUrl)) {
foreach ($thumbUrl[1] as $list) $result[] = $list;}
if (preg_match_all($patternMD, $item->content, $thumbUrl)) {
foreach ($thumbUrl[1] as $list) $result[] = $list;}
if (preg_match_all($patternMDfoot, $item->content, $thumbUrl)) {
foreach ($thumbUrl[1] as $list) $result[] = $list;}
if (sizeof($result) < 3) {
$custom_thumbnail = Helper::options()->JThumbnail;
if ($custom_thumbnail) {$custom_thumbnail_arr = explode("\r\n", $custom_thumbnail);
for ($i = 0; $i < 3; $i++) {
$result[] = $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);}}
else {for ($i = 0; $i < 3; $i++) {$result[] = _getAssets('assets/thumb/' . rand(1, 42) . '.jpg', false);}}}return $result;}

// 侧边栏作者随机文章
function _getAsideAuthorNav(){
if (Helper::options()->JAside_Author_Nav && Helper::options()->JAside_Author_Nav !== "off") {
$limit = Helper::options()->JAside_Author_Nav;
$db = Typecho_Db::get();
$prefix = $db->getPrefix();
$sql = "SELECT * FROM `{$prefix}contents` WHERE cid >= (SELECT floor( RAND() * ((SELECT MAX(cid) FROM `{$prefix}contents`)-(SELECT MIN(cid) FROM `{$prefix}contents`)) + (SELECT MIN(cid) FROM `{$prefix}contents`))) and type='post' and status='publish' and (password is NULL or password='') ORDER BY cid LIMIT $limit";
$result = $db->query($sql);
if ($result instanceof Traversable) {
foreach ($result as $item) {
$item = Typecho_Widget::widget('Widget_Abstract_Contents')->push($item);
$title = htmlspecialchars($item['title']);
$permalink = $item['permalink'];
echo "<li class='item'>
<a class='link' href='{$permalink}' title='{$title}'>{$title}</a>
<svg class='icon' viewBox='0 0 1024 1024' xmlns='http://www.w3.org/2000/svg' width='16' height='16'><path d='M448.12 320.331a30.118 30.118 0 0 1-42.616-42.586L552.568 130.68a213.685 213.685 0 0 1 302.2 0l38.552 38.551a213.685 213.685 0 0 1 0 302.2L746.255 618.497a30.118 30.118 0 0 1-42.586-42.616l147.034-147.035a153.45 153.45 0 0 0 0-217.028l-38.55-38.55a153.45 153.45 0 0 0-216.998 0L448.12 320.33zM575.88 703.67a30.118 30.118 0 0 1 42.616 42.586L471.432 893.32a213.685 213.685 0 0 1-302.2 0l-38.552-38.551a213.685 213.685 0 0 1 0-302.2l147.065-147.065a30.118 30.118 0 0 1 42.586 42.616L173.297 595.125a153.45 153.45 0 0 0 0 217.027l38.55 38.551a153.45 153.45 0 0 0 216.998 0L575.88 703.64zm-234.256-63.88L639.79 341.624a30.118 30.118 0 0 1 42.587 42.587L384.21 682.376a30.118 30.118 0 0 1-42.587-42.587z'/></svg></li>";}}}}

function _curl($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 3000);
curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
if (strpos($url, 'https') !== false) {
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);}
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36');
$result = curl_exec($ch);
curl_close($ch);
return $result;}

// 判断敏感词是否在字符串内
function _checkSensitiveWords($words_str, $str){
$words = explode("||", $words_str);
if (empty($words)) {
return false;}
foreach ($words as $word) {
if (false !== strpos($str, trim($word))) {
return true;}}
return false;}


// 获取文章列表
function _getPost($self)
{
$self->response->setStatus(200);

$page = $self->request->page;
$pageSize = $self->request->pageSize;
$type = $self->request->type;

// sql注入校验
if (!preg_match('/^\d+$/', $page)) {
return $self->response->throwJson(array("data" => "非法请求！已屏蔽！"));
}
if (!preg_match('/^\d+$/', $pageSize)) {
return $self->response->throwJson(array("data" => "非法请求！已屏蔽！"));
}
if (!preg_match('/^[created|views|commentsNum|agree]+$/', $type)) {
return $self->response->throwJson(array("data" => "非法请求！已屏蔽！"));
}

// 如果传入0，强制赋值1
if ($page == 0) $page = 1;
$result = [];
// 置顶文章
$sticky_text = Helper::options()->JIndexSticky;
if ($sticky_text && $page == 1) {
$sticky_arr = explode("||", $sticky_text);
foreach ($sticky_arr as $cid) {
$self->widget('Widget_Contents_Post@' . $cid, 'cid=' . $cid)->to($item);
if ($item->next()) {
$result[] = array(
"mode" => $item->fields->mode ? $item->fields->mode : 'default',
"image" => _getThumbnails($item),
"time" => date('Y-m-d', $item->created),
"created" => date(formatTime($item->created)),
"title" => $item->title,
"abstract" => _getAbstract($item, false),
"category" => $item->categories,
"views" => _getViews($item, false),
"commentsNum" => number_format($item->commentsNum),
"agree" => _getAgree($item, false),
"permalink" => $item->permalink,
"lazyload" => _getLazyload(false),
"type" => "sticky",
);
}}}
$self->widget('Widget_Contents_Sort', 'page=' . $page . '&pageSize=' . $pageSize . '&type=' . $type)->to($item);
while ($item->next()) {
$result[] = array(
"mode" => $item->fields->mode ? $item->fields->mode : 'default',
"image" => _getThumbnails($item),
"time" => date('Y-m-d', $item->created),
"created" => date(formatTime($item->created)),
"title" => $item->title,
"abstract" => _getAbstract($item, false),
"category" => $item->categories,
"views" => number_format($item->views),
"commentsNum" => number_format($item->commentsNum),
"agree" => number_format($item->agree),
"permalink" => $item->permalink,
"lazyload" => _getLazyload(false),
"type" => "normal"
);
};

$self->response->throwJson(array("data" => $result));
}


/**
* 时间友好化<?php echo formatTime($this->created); ?>
*/
function formatTime($older_date) {
if($older_date=="no"){return;}
$chunks = array(
array(31536000 , '年'),
array(2592000 , '个月'),
array(86400 , '天'),
array(3600 , '小时'),
array(60 , '分'),
array(1 , '秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);

for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.'前';
return $output;
}

/**
* 阅读数友好化<?php Postviews($this); ?>
*/
function convert($num) 
{
if ($num >= 100000)
{
$num = round($num / 10000) .'w';
} 
else if ($num >= 10000) 
{
$num = round($num / 10000, 1) .'w';
} 
else if($num >= 1000) 
{
$num = round($num / 1000, 1) . 'k';
}
return $num;
}


// 增加浏览量
function _handleViews($self)
{
$self->response->setStatus(200);

$cid = $self->request->cid;

// sql注入校验
if (!preg_match('/^\d+$/',  $cid)) {
return $self->response->throwJson(array("code" => 0, "data" => "非法请求！已屏蔽！"));
}
$db = Typecho_Db::get();
$row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
if (sizeof($row) > 0) {
$db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
$self->response->throwJson(array(
"code" => 1,
"data" => array('views' => number_format($db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views']))
));
} else {
$self->response->throwJson(array("code" => 0, "data" => null));
}
}

function Postviews($archive) {
$db = Typecho_Db::get();
$cid = $archive->cid;
if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
$db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `views` INT(10) DEFAULT 0;');
}
$exist = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
if ($archive->is('single')) {
$cookie = Typecho_Cookie::get('contents_views');
$cookie = $cookie ? explode(',', $cookie) : array();
if (!in_array($cid, $cookie)) {
$db->query($db->update('table.contents')
->rows(array('views' => (int)$exist+1))
->where('cid = ?', $cid));
$exist = (int)$exist+1;
array_push($cookie, $cid);
$cookie = implode(',', $cookie);
Typecho_Cookie::set('contents_views', $cookie);
}
}

if( $exist == 0 ){
  echo '0';
}
else{  
  $exist = convert($exist);
  echo $exist;
}
}

// 点赞和取消点赞
function _handleAgree($self)
{
$self->response->setStatus(200);

$cid = $self->request->cid;
$type = $self->request->type;

// sql注入校验
if (!preg_match('/^\d+$/',  $cid)) {
return $self->response->throwJson(array("code" => 0, "data" => "非法请求！已屏蔽！"));
}
// sql注入校验
if (!preg_match('/^[agree|disagree]+$/', $type)) {
return $self->response->throwJson(array("code" => 0, "data" => "非法请求！已屏蔽！"));
}
$db = Typecho_Db::get();
$row = $db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $cid));
if (sizeof($row) > 0) {
if ($type === "agree") {
$db->query($db->update('table.contents')->rows(array('agree' => (int)$row['agree'] + 1))->where('cid = ?', $cid));
} else {
if(intval($row['agree'])-1>=0)
$db->query($db->update('table.contents')->rows(array('agree' => (int)$row['agree'] - 1))->where('cid = ?', $cid));
}
$self->response->throwJson(array(
"code" => 1,
"data" => array('agree' => number_format($db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $cid))['agree']))
));
} else {
$self->response->throwJson(array("code" => 0, "data" => null));}}

// 查询是否收录
function _getRecord($self)
{
    $self->response->setStatus(200);

    $site = $self->request->site;
    $encryption = md5(mt_rand(1655, 100860065) . time());
    $baiduSite = "https://www.baidu.com/s?ie=utf-8&newi=1&mod=1&isid={$encryption}&wd={$site}&rsv_spt=1&rsv_iqid={$encryption}&issp=1&f=8&rsv_bp=1&rsv_idx=2&ie=utf-8&tn=baiduhome_pg&rsv_enter=0&rsv_dl=ib&rsv_sug3=2&rsv_sug1=1&rsv_sug7=001&rsv_n=2&rsv_btype=i&inputT=3083&rsv_sug4=3220&rsv_sug=9&rsv_sid=32818_1460_33042_33060_31660_33099_33101_32961_26350_22159&_ss=1&clist=&hsug=&f4s=1&csor=38&_cr1=32951";
    $ip = mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
    $header[] = "accept-encoding: gzip, deflate";
    $header[] = "accept-language: en-US,en;q=0.8";
    $header[] = "CLIENT-IP:" . $ip;
    $header[] = "X-FORWARDED-FOR:" . $ip;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baiduSite);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_REFERER, "https://www.baidu.com/s?ie=UTF-8&wd={$site}");
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $output = curl_exec($ch);
    curl_close($ch);
    $res = str_replace([' ', "\n", "\r"], '', $output);
    if (strpos($res, "抱歉，没有找到与") || strpos($res, "找到相关结果约0个") || strpos($res, "没有找到该URL") || strpos($res, "抱歉没有找到")) {
        $self->response->throwJson(array("data" => "未收录"));
    } else {
        $self->response->throwJson(array("data" => "已收录"));
    }
}

// 自动推送到百度收录
function _pushRecord($self)
{
    $self->response->setStatus(200);

    $token = Helper::options()->JBaiduToken;
    $domain = $self->request->domain;
    $url = $self->request->url;
    $urls = explode(",", $url);
    $api = "http://data.zz.baidu.com/urls?site={$domain}&token={$token}";
    $ch = curl_init();
    $options =  array(
        CURLOPT_URL => $api,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => implode("\n", $urls),
        CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
    );
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    curl_close($ch);
    $self->response->throwJson(array(
        'domain' => $domain,
        'url' => $url,
        'data' => json_decode($result, TRUE)
    ));
}

// 获取壁纸分类
function _getWallpaperType($self)
{
$self->response->setStatus(200);

$json = _curl("http://cdn.apc.360.cn/index.php?c=WallPaper&a=getAllCategoriesV2&from=360chrome");
$res = json_decode($json, TRUE);
if ($res['errno'] == 0) {
$self->response->throwJson([
"code" => 1,
"data" => $res['data']
]);
} else {
$self->response->throwJson([
"code" => 0,
"data" => null
]);
}
}

// 获取壁纸列表
function _getWallpaperList($self)
{
$self->response->setStatus(200);

$cid = $self->request->cid;
$start = $self->request->start;
$count = $self->request->count;
$json = _curl("http://wallpaper.apc.360.cn/index.php?c=WallPaper&a=getAppsByCategory&cid={$cid}&start={$start}&count={$count}&from=360chrome");
$res = json_decode($json, TRUE);
if ($res['errno'] == 0) {
$self->response->throwJson([
"code" => 1,
"data" => $res['data'],
"total" => $res['total']
]);
} else {
$self->response->throwJson([
"code" => 0,
"data" => null
]);}}


// 获取最近评论
function _getCommentLately($self)
{
$self->response->setStatus(200);

$time = time();
$num = 7;
$categories = [];
$series = [];
$db = Typecho_Db::get();
$prefix = $db->getPrefix();
for ($i = ($num - 1); $i >= 0; $i--) {
$date = date("Y/m/d", $time - ($i * 24 * 60 * 60));
$sql = "SELECT coid FROM `{$prefix}comments` WHERE FROM_UNIXTIME(created, '%Y/%m/%d') = '{$date}' limit 100";
$count = count($db->fetchAll($sql));
$categories[] = $date;
$series[] = $count;
}
$self->response->throwJson([
"categories" => $categories,
"series" => $series,
]);
}

// 获取文章归档
function _getArticleFiling($self)
{
$self->response->setStatus(200);

$page = $self->request->page;
$pageSize = 8;
if (!preg_match('/^\d+$/', $page)) return $self->response->throwJson(array("data" => "非法请求！已屏蔽！"));
if ($page == 0) $page = 1;
$offset = $pageSize * ($page - 1);
$time = time();
$db = Typecho_Db::get();
$prefix = $db->getPrefix();
$result = [];
$sql = "SELECT FROM_UNIXTIME(created, '%Y 年 %m 月') as date FROM `{$prefix}contents` WHERE created < {$time} AND (password is NULL or password = '') AND status = 'publish' AND type = 'post' GROUP BY FROM_UNIXTIME(created, '%Y 年 %m 月') DESC LIMIT {$pageSize} OFFSET {$offset}";
$temp = $db->fetchAll($sql);
$options = Typecho_Widget::widget('Widget_Options');
foreach ($temp as $item) {
$date = $item['date'];
$list = [];
$sql = "SELECT * FROM `{$prefix}contents` WHERE created < {$time} AND (password is NULL or password = '') AND status = 'publish' AND type = 'post' AND FROM_UNIXTIME(created, '%Y 年 %m 月') = '{$date}' ORDER BY created DESC LIMIT 100";
$_list = $db->fetchAll($sql);
foreach ($_list as $_item) {
$type = $_item['type'];
$_item['categories'] = $db->fetchAll($db->select()->from('table.metas')
->join('table.relationships', 'table.relationships.mid = table.metas.mid')
->where('table.relationships.cid = ?', $_item['cid'])
->where('table.metas.type = ?', 'category')
->order('table.metas.order', Typecho_Db::SORT_ASC));
$_item['category'] = urlencode(current(Typecho_Common::arrayFlatten($_item['categories'], 'slug')));
$_item['slug'] = urlencode($_item['slug']);
$_item['date'] = new Typecho_Date($_item['created']);
$_item['year'] = $_item['date']->year;
$_item['month'] = $_item['date']->month;
$_item['day'] = $_item['date']->day;
$routeExists = (NULL != Typecho_Router::get($type));
$_item['pathinfo'] = $routeExists ? Typecho_Router::url($type, $_item) : '#';
$_item['permalink'] = Typecho_Common::url($_item['pathinfo'], $options->index);
$list[] = array(
"title" => date('m/d', $_item['created']) . '：' . $_item['title'],
"permalink" => $_item['permalink'],);}
$result[] = array("date" => $date, "list" => $list);}
$self->response->throwJson($result);}

// HTML压缩
function compressHtml($html_source) {
$chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
$compress = '';
foreach ($chunks as $c) {
if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
$c = substr($c, 19, strlen($c) - 19 - 20);
$compress .= $c;
continue;
} else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
$c = substr($c, 12, strlen($c) - 12 - 13);
$compress .= $c;
continue;
} else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
$compress .= $c;
continue;
} else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
$tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
$c = '';
foreach ($tmps as $tmp) {
if (strpos($tmp, '//') !== false) {
if (substr(trim($tmp), 0, 2) == '//') {
continue;
}
$chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
$is_quot = $is_apos = false;
foreach ($chars as $key => $char) {
if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
$is_quot = !$is_quot;
} else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
$is_apos = !$is_apos;
} else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
$tmp = substr($tmp, 0, $key);
break;
}
}
}
$c .= $tmp;
}
}
$c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
$c = preg_replace('/\\s{2,}/', ' ', $c);
$c = preg_replace('/>\\s</', '> <', $c);
$c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
$c = preg_replace('/<!--[^!]*-->/', '', $c);
$compress .= $c;
}
return $compress;
}

// 获取评论函数
require_once("Comments_core.php");
// 调用评论功能
Typecho_Plugin::factory('Widget_Feedback')->comment = array('Intercept', 'message');
class Intercept{public static function message($comment){
if (preg_match('/\{!\{(.*)\}!\}/', $comment['text'], $matches)) {
if (strpos($matches[1], '"') !== false || _checkXSS($matches[1])) {
$comment['status'] = 'waiting';}}
else {
if (Helper::options()->JTextLimit && strlen($comment['text']) > Helper::options()->JTextLimit) {
$comment['status'] = 'waiting';} 
else {if (Helper::options()->JSensitiveWords) {
if (_checkSensitiveWords(Helper::options()->JSensitiveWords, $comment['text'])) {
$comment['status'] = 'waiting';}}
if (Helper::options()->JLimitOneChinese === "on") {
if (preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
$comment['status'] = 'waiting';}}}}
Typecho_Cookie::delete('__typecho_remember_text');return $comment;}}


// 邮件通知
if (Helper::options()->JCommentMail === 'on' &&
Helper::options()->JCommentMailHost &&
Helper::options()->JCommentMailPort &&
Helper::options()->JCommentMailFromName &&
Helper::options()->JCommentMailAccount &&
Helper::options()->JCommentMailPassword &&
Helper::options()->JCommentSMTPSecure) {
Typecho_Plugin::factory('Widget_Feedback')->finishComment = array('Email', 'send');}

class Email{public static function send($comment){
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->CharSet = 'UTF-8';
$mail->SMTPSecure = Helper::options()->JCommentSMTPSecure;
$mail->Host = Helper::options()->JCommentMailHost;
$mail->Port = Helper::options()->JCommentMailPort;
$mail->FromName = Helper::options()->JCommentMailFromName;
$mail->Username = Helper::options()->JCommentMailAccount;
$mail->From = Helper::options()->JCommentMailAccount;
$mail->Password = Helper::options()->JCommentMailPassword;
$mail->isHTML(true);
$text = $comment->text;
$text = preg_replace_callback(
'/\:\$\(\s*(爱你|爱心|傲慢|白眼|棒棒糖|爆筋|抱拳|鄙视|闭嘴|擦汗|菜刀|呲牙|大兵|大哭|得意|doge|发呆|发怒|奋斗|尴尬|勾引|鼓掌|害羞|憨笑|哈欠|坏笑|饥饿|惊恐|惊喜|惊讶|可爱|可怜|抠鼻|酷|快哭了|骷髅|困|篮球|泪奔|冷汗|流汗|流泪|难过|OK|喷血|撇嘴|强|敲打|亲亲|糗大了|拳头|骚扰|色|胜利|手枪|衰|睡|调皮|偷笑|吐|托腮|委屈|微笑|握手|我最美|无奈|吓|小纠结|笑哭|斜眼笑|西瓜|嘘|羊驼|阴险|疑问|右哼哼|幽灵|晕|再见|眨眼睛|折磨|咒骂|抓狂|左哼哼)\s*\)/is',
function ($match) {
return '<img style="max-height: 22px;" src="' . Helper::options()->themeUrl . '/assets/owo/QQ/' . str_replace('%', '', urlencode($match[1])) . '.gif"/>';},
$text);

$text = preg_replace_callback(
'/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血|狗头)\s*\)/is',
function ($match) {
return '<img style="max-height: 22px;" src="' . Helper::options()->themeUrl . '/assets/owo/paopao/' . str_replace('%', '', urlencode($match[1])) . '_2x.png"/>';},
$text);

$text = preg_replace_callback(
'/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
function ($match) {
return '<img style="max-height: 22px;" src="' . Helper::options()->themeUrl . '/assets/owo/aru/' . str_replace('%', '', urlencode($match[1])) . '_2x.png"/>';},
$text);

$text = preg_replace_callback(
'/\:\#\(\s*(doge|亲亲|偷笑|再见|发怒|发财|可爱|吐血|呆|呕吐|困|坏笑|大佬|大哭|委屈|害羞|尴尬|微笑|思考|惊吓|打脸|抓狂|抠鼻子|斜眼笑|无奈|晕|流汗|流鼻血|点赞|生气|生病|疑问|白眼|睡着|笑哭|腼腆|色|调皮|鄙视|闭嘴|难过|馋|黑人问号|鼓掌)\s*\)/is',
function ($match) {
return '<img style="max-height: 22px;" src="' . Helper::options()->themeUrl . '/assets/owo/bilibili/' . str_replace('%', '', urlencode($match[1])) . '.gif"/>';},
$text);
$text = preg_replace('/\{!\{([^\"]*)\}!\}/', '<img style="max-width: 100%;vertical-align: middle;" src="$1"/>', $text);
$html = '
<style>.Xc{width:550px;margin:0 auto;border-radius:8px;overflow:hidden;font-family:"Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;box-shadow:0 2px 12px 0 rgba(0,0,0,0.1);word-break:break-all}.Xc_title{color:#fff;background:linear-gradient(-45deg,rgba(9,69,138,0.2),rgba(68,155,255,0.7),rgba(117,113,251,0.7),rgba(68,155,255,0.7),rgba(9,69,138,0.2));background-size:400% 400%;background-position:50% 100%;padding:15px;font-size:15px;line-height:1.5}</style>
<div class="Xc"><div class="Xc_title">{title}</div><div style="background: #fff;padding: 20px;font-size: 14px;color: #666;"><div style="margin-bottom: 20px;line-height: 1.5;">{subtitle}</div><div style="padding: 15px;margin-bottom: 20px;line-height: 1.5;background: repeating-linear-gradient(145deg, #f2f6fc, #f2f6fc 15px, #fff 0, #fff 25px);">{content}</div><div style="line-height: 2">请注意：此邮件由系统自动发送，请勿直接回复。<br>若此邮件不是您请求的，请忽略并删除！</div></div></div>';
// 如果是博主发的评论
if ($comment->authorId == $comment->ownerId) {
// 发表的评论是回复别人
if ($comment->parent != 0) {
$db = Typecho_Db::get();
$parentInfo = $db->fetchRow($db->select('mail')->from('table.comments')->where('coid = ?', $comment->parent));
$parentMail = $parentInfo['mail'];
// 被回复的人不是自己时，发送邮件
if ($parentMail != $comment->mail) {
$mail->Body = strtr(
$html,
array(
"{title}" => '您在 [' . $comment->title . '] 的评论有了新的回复！',
"{subtitle}" => '博主：[ ' . $comment->author . ' ] 在《 <a style="color: #12addb;text-decoration: none;" href="' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '" target="_blank">' . $comment->title . '</a> 》上回复了您:',
"{content}" => $text.'&nbsp;&nbsp;&nbsp;'.'<a style="color: #12addb;text-decoration: none;" href="' . $comment->permalink . '" target="_blank">查看回复</a>',));
$mail->addAddress($parentMail);
$mail->Subject = '您在 [' . $comment->title . '] 的评论有了新的回复！';
$mail->send();}}
// 如果是游客发的评论
} else {
// 如果是直接发表的评论，不是回复别人，那么发送邮件给博主
if ($comment->parent == 0) {
$db = Typecho_Db::get();
$authoInfo = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', $comment->ownerId));
$authorMail = $authoInfo['mail'];
if ($authorMail) {
$mail->Body = strtr(
$html,
array(
"{title}" => '您的文章 [' . $comment->title . '] 收到一条新的评论！',
"{subtitle}" => $comment->author . ' [' . $comment->ip . '] 在您的《 <a style="color: #12addb;text-decoration: none;" href="' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '" target="_blank">' . $comment->title . '</a> 》上发表评论:',
"{content}" => $text.'&nbsp;&nbsp;&nbsp;'.'<a style="color: #12addb;text-decoration: none;" href="' . $comment->permalink . '" target="_blank">查看评论</a>',));
$mail->addAddress($authorMail);
$mail->Subject = '您的文章 [' . $comment->title . '] 收到一条新的评论！';
$mail->send();}
// 如果发表的评论是回复别人
} else {
$db = Typecho_Db::get();
$parentInfo = $db->fetchRow($db->select('mail')->from('table.comments')->where('coid = ?', $comment->parent));
$parentMail = $parentInfo['mail'];
// 被回复的人不是自己时，发送邮件
if ($parentMail != $comment->mail) {
$mail->Body = strtr(
$html,
array(
"{title}" => '您在 [' . $comment->title . '] 的评论有了新的回复！',
"{subtitle}" => $comment->author . ' 在《 <a style="color: #12addb;text-decoration: none;" href="' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '" target="_blank">' . $comment->title . '</a> 》上回复了您:',
"{content}" => $text.'&nbsp;&nbsp;&nbsp;'.'<a style="color: #12addb;text-decoration: none;" href="' . $comment->permalink . '" target="_blank">查看回复</a>',));
$mail->addAddress($parentMail);
$mail->Subject = '您在 [' . $comment->title . '] 的评论有了新的回复！';
$mail->send();}}}}}



// 后台编辑器功能
if (Helper::options()->JEditor !== 'off') {
Typecho_Plugin::factory('admin/write-post.php')->richEditor  = array('Editor', 'Edit');
Typecho_Plugin::factory('admin/write-page.php')->richEditor  = array('Editor', 'Edit');
}

class Editor{public static function Edit(){
?>
<link rel="stylesheet" href="<?php _getAssets('assets/typecho/write/css/Xc.write.css') ?>" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:400" />

<script>
$(document).ready(function(){
$('#tags').after('<div class="Xc_tags"><ul class="Xc_tags-all"><?php
$i=0;
Typecho_Widget::widget('Widget_Metas_Tag_Cloud', 'sort=count&desc=1&limit=200')->to($tags);
while ($tags->next()) {
echo "<a id=".$i." onclick=\"$(\'#tags\').tokenInput(\'add\', {id: \'".$tags->name."\', tags: \'".$tags->name."\'});\">".$tags->name."</a>";
$i++;
}
?></ul></div>');
});
window.XcConfig = {
uploadAPI: '<?php Helper::security()->index('/action/upload'); ?>',
expressionAPI: '<?php _getAssets('assets/typecho/write/json/expression.json') ?>',
playerAPI: '<?php Helper::options()->JCustomPlayer ? Helper::options()->JCustomPlayer() : Helper::options()->themeUrl('library/player.php?url=') ?>',
autoSave: <?php Helper::options()->autoSave(); ?>,
themeURL: '<?php Helper::options()->themeUrl(); ?>',
canPreview: false}
</script>
<script src="<?php _getAssets('assets/typecho/write/parse/parse.min.js') ?>"></script>
<script src="<?php _getAssets('assets/typecho/write/dist/index.bundle.js') ?>"></script>
<?php
}
}


function themeInit($self){
Helper::options()->commentsAntiSpam = false; 
Helper::options()->commentsRequireMail = true;
Helper::options()->commentsRequireURL = false;
Helper::options()->commentsThreaded = true;
Helper::options()->commentsMaxNestingLevels = 999;

// 主题开放API 路由规则
if ($self->request->getPathInfo() == "/Xc/api") {
switch ($self->request->routeType) {
case 'publish_list':_getPost($self);
break;case 'baidu_record':_getRecord($self);
break;case 'baidu_push':_pushRecord($self);
break;case 'handle_views':_handleViews($self);
break;case 'handle_agree':_handleAgree($self);
break;case 'wallpaper_type':_getWallpaperType($self);
break;case 'wallpaper_list':_getWallpaperList($self);
break;case 'comment_lately':_getCommentLately($self);
break;case 'article_filing':_getArticleFiling($self);
break;
};
}

// 增加自定义SiteMap功能
if (Helper::options()->JSiteMap && Helper::options()->JSiteMap !== 'off') { if (strpos($self->request->getRequestUri(), 'sitemap.xml') !== false) { $self->response->setStatus(200); $self->setThemeFile("library/sitemap.php"); }}}

// 增加自定义字段
function themeFields($layout){$mode = new Typecho_Widget_Helper_Form_Element_Select('mode',array('default' => '默认模式','single' => '大图模式','multiple' => '三图模式','none' => '无图模式'
),'default','文章显示方式','介绍：用于设置当前文章在首页和搜索页的显示方式 <br /> 注意：独立页面该功能不会生效');$layout->addItem($mode);

$keywords = new Typecho_Widget_Helper_Form_Element_Text('keywords',NULL,NULL,'SEO关键词（非常重要！）','介绍：用于设置当前页SEO关键词 <br />注意：多个关键词使用英文逗号进行隔开 <br />例如：Typecho,Typecho主题,Typecho模板 <br />其他：如果不填写此项，则默认取文章标签');$layout->addItem($keywords);

$description = new Typecho_Widget_Helper_Form_Element_Textarea('description',NULL,NULL,'SEO描述语（非常重要！）','介绍：用于设置当前页SEO描述语 <br />注意：SEO描述语不应当过长也不应当过少 <br />其他：如果不填写此项，则默认截取文章片段');$layout->addItem($description);

$abstract = new Typecho_Widget_Helper_Form_Element_Textarea('abstract',NULL,NULL,'自定义摘要（非必填）','填写时：将会显示填写的摘要 <br>不填写时：默认取文章里的内容');$layout->addItem($abstract);

$thumb = new Typecho_Widget_Helper_Form_Element_Textarea('thumb',NULL,NULL,'自定义缩略图（非必填）','填写时：将会显示填写的文章缩略图 <br>不填写时：<br>1、若文章有图片则取文章内图片 <br>2、若文章无图片，并且外观设置里未填写·自定义缩略图·选项，则取模板自带图片 <br>3、若文章无图片，并且外观设置里填写了·自定义缩略图·选项，则取自定义缩略图图片 <br>注意：多个缩略图时换行填写，一行一个（仅在三图模式下生效）');$layout->addItem($thumb);
}

