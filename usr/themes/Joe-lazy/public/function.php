<?php

namespace joe;

/* 获取全局懒加载图 */

function getLazyload($type = true)
{
	if ($type)
		echo \Helper::options()->JLazyload ?? theme_url('assets/images/lazyload.gif');
	else
		return \Helper::options()->JLazyload ?? theme_url('assets/images/lazyload.gif');
}

/* 获取头像懒加载图 */
function getAvatarLazyload($type = true)
{
	$str = theme_url('assets/images/AvatarLazyload.png');
	if ($type) echo $str;
	else return $str;
}

/* 查询文章浏览量 */
function getViews($item, $type = true)
{
	$db = \Typecho_Db::get();
	$result = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $item->cid))['views'];
	if ($type) echo number_format($result);
	else return number_format($result);
}

/* 查询文章点赞量 */
function getAgree($item, $type = true)
{
	$db = \Typecho_Db::get();
	$result = $db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $item->cid))['agree'];
	if ($type) echo number_format($result);
	else return number_format($result);
}

/**
 * 格式化时间戳为更易读的格式
 *
 * @param int|null $olderTimestamp 需要格式化的时间戳。如果为null，函数将返回null。
 *
 * @return string|null 格式化后的时间字符串，如果输入为null，则返回null。
 */
function formatTime(?int $olderTimestamp): ?string
{
	if ($olderTimestamp === null) {
		return null;
	}

	$timeUnits = [
		[31536000, '年'],
		[2592000, '个月'],
		[86400, '天'],
		[3600, '小时'],
		[60, '分'],
		[1, '秒'],
	];

	$timeDifference = abs(time() - $olderTimestamp);

	foreach ($timeUnits as [$seconds, $name]) {
		if (($count = intdiv($timeDifference, $seconds)) > 0) {
			return "{$count}{$name}前";
		}
	}

	return '刚刚';
}

/* 通过邮箱生成头像地址 */
function getAvatarByMail($mail, $return = false)
{
	$mail = $mail ?: \Typecho_Db::get()->fetchRow(\Typecho_Db::get()->select()->from('table.users')->where('uid = ?', 1))['mail'];

	if (preg_match('/^([0-9]{5,10})@qq\.com$/i', $mail, $matches)) {
		$url = 'https://s.p.qq.com/pub/get_face?img_type=3&uin=' . $matches[1];
		$result = 'https://q.qlogo.cn/g?b=qq&k=' . explode("&s=", explode("&k=", json_encode(get_headers($url, true)['Location']))[1])[0] . '&s=640';
	} else {
		$result = (\Helper::options()->JCustomAvatarSource ?? 'https://cravatar.cn/avatar/') . md5(strtolower($mail)) . '?d=mm';
	}

	if ($return) {
		return $result;
	} else {
		echo $result;
	}
};

/**
 * 昵称首字母头像
 * @param string $text
 * @return void
 */
function letter_avatar(string $text)
{
	$total = unpack('L', hash('adler32', $text, true))[1];
	$hue = $total % 360;
	$h = $hue / 360;
	$s = 0.3;
	$v = 0.9;
	$i = floor($h * 6);
	$f = $h * 6 - $i;
	$p = $v * (1 - $s);
	$q = $v * (1 - $f * $s);
	$t = $v * (1 - (1 - $f) * $s);
	$rgb = match ($i % 6) {
		0 => [$v, $t, $p],
		1 => [$q, $v, $p],
		2 => [$p, $v, $t],
		3 => [$p, $q, $v],
		4 => [$t, $p, $v],
		5 => [$v, $p, $q],
		default => [0, 0, 0],
	};
	list($r, $g, $b) = array_map(fn ($value) => floor($value * 255), $rgb);
	$bg = "rgb({$r},{$g},{$b})";
	$color = "#ffffff";
	$first = mb_strtoupper(mb_substr($text, 0, 1));
	$src = base64_encode('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="100" width="100"><rect fill="' . $bg . '" x="0" y="0" width="100" height="100"></rect><text x="50" y="50" font-size="50" text-copy="fast" fill="' . $color . '" text-anchor="middle" text-rights="admin" alignment-baseline="central">' . $first . '</text></svg>');
	return 'data:image/svg+xml;base64,' . $src;
}

/* 获取侧边栏随机一言 */
function getAsideAuthorMotto()
{
	$JMottoRandom = explode("\r\n", \Helper::options()->JAside_Author_Motto);
	echo $JMottoRandom[array_rand($JMottoRandom, 1)];
}

/* 获取文章摘要 */
function getAbstract($item, $type = true)
{
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
		}
	}
	if ($abstract === '') {
		$abstract = "暂无简介";
	} else {
		$abstract = markdown_filter($abstract);
	}
	if ($type) echo $abstract;
	else return $abstract;
}

/* 获取列表缩略图 */
function getThumbnails($item)
{
	$result = [];
	$patterns = [
		'/\<img.*?src\=\"(.*?)\"[^>]*>/i',
		'/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i',
		'/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i'
	];

	// 如果填写了自定义缩略图，则优先显示填写的缩略图
	if ($item->fields->thumb) {
		$result = explode("\r\n", $item->fields->thumb);
	}

	// 如果匹配到正则，则继续补充匹配到的图片
	foreach ($patterns as $pattern) {
		if (preg_match_all($pattern, $item->content, $thumbUrl)) {
			array_push($result, ...$thumbUrl[1]);
		}
	}
	$generateRandomImageUrl = function () {
		$custom_thumbnail = \Helper::options()->JThumbnail;
		if ($custom_thumbnail) {
			$custom_thumbnail_arr = explode("\r\n", $custom_thumbnail);
			return $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);
		}
		return 'https://tu.ltyuanfang.cn/api/fengjing.php?random=' . rand();
	};
	$result = array_pad($result, 3, $generateRandomImageUrl());

	return $result;
}

/* 获取父级评论 */
function getParentReply($parent)
{
	if ($parent !== "0") {
		$db = \Typecho_Db::get();
		$commentInfo = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ?', $parent));
		if (empty($commentInfo['author'])) return;
		return '<div class="parent"><span style="vertical-align: 1px;">@</span> ' . $commentInfo['author'] . '</div>';
	}
}

/* 获取侧边栏作者随机文章 */
function getAsideAuthorNav()
{
	if (\Helper::options()->JAside_Author_Nav && \Helper::options()->JAside_Author_Nav !== "off") {
		$limit = \Helper::options()->JAside_Author_Nav;
		$db = \Typecho_Db::get();
		$prefix = $db->getPrefix();
		$sql = "SELECT * FROM `{$prefix}contents` WHERE cid >= (SELECT floor( RAND() * ((SELECT MAX(cid) FROM `{$prefix}contents`)-(SELECT MIN(cid) FROM `{$prefix}contents`)) + (SELECT MIN(cid) FROM `{$prefix}contents`))) and type='post' and status='publish' and (password is NULL or password='') ORDER BY cid LIMIT $limit";
		$result = $db->query($sql);
		if ($result instanceof \Traversable) {
			foreach ($result as $item) {
				$item = \Typecho_Widget::widget('Widget_Abstract_Contents')->push($item);
				$title = htmlspecialchars($item['title']);
				$permalink = $item['permalink'];
				echo "<li class='item'><a class='link' href='{$permalink}' title='{$title}'>{$title}</a><svg class='icon' viewBox='0 0 1024 1024' xmlns='http://www.w3.org/2000/svg' width='16' height='16'><path d='M448.12 320.331a30.118 30.118 0 0 1-42.616-42.586L552.568 130.68a213.685 213.685 0 0 1 302.2 0l38.552 38.551a213.685 213.685 0 0 1 0 302.2L746.255 618.497a30.118 30.118 0 0 1-42.586-42.616l147.034-147.035a153.45 153.45 0 0 0 0-217.028l-38.55-38.55a153.45 153.45 0 0 0-216.998 0L448.12 320.33zM575.88 703.67a30.118 30.118 0 0 1 42.616 42.586L471.432 893.32a213.685 213.685 0 0 1-302.2 0l-38.552-38.551a213.685 213.685 0 0 1 0-302.2l147.065-147.065a30.118 30.118 0 0 1 42.586 42.616L173.297 595.125a153.45 153.45 0 0 0 0 217.027l38.55 38.551a153.45 153.45 0 0 0 216.998 0L575.88 703.64zm-234.256-63.88L639.79 341.624a30.118 30.118 0 0 1 42.587 42.587L384.21 682.376a30.118 30.118 0 0 1-42.587-42.587z'/></svg></li>";
			}
		}
	}
}

function theme_url($path)
{
	if (empty(\Helper::options()->JStaticAssetsUrl)) {
		$path = url_builder($path, ['version' => JOE_VERSION]);
		return \Helper::options()->themeUrl . '/' . $path;
	}
	$url = \Helper::options()->JStaticAssetsUrl . '/' . $path;
	$url = url_builder($url, ['version' => JOE_VERSION]);
	return $url;
}

function url_builder($url, array $param)
{
	$param = http_build_query($param);
	$url = strstr($url, '?') ? trim($url, '&') . '&' . $param : $url . '?' . $param;
	return $url;
}

/** 过滤Markdown语法代码 */
function markdown_filter($text)
{
	$text = preg_replace('/{.*?}/', '', $text);
	return $text;
}

function user_login($uid, $expire = 30243600)
{
	$db = \Typecho_Db::get();
	\Typecho_Widget::widget('Widget_User')->simpleLogin($uid);
	$authCode = function_exists('openssl_random_pseudo_bytes') ? bin2hex(openssl_random_pseudo_bytes(16)) : sha1(\Typecho_Common::randString(20));
	\Typecho_Cookie::set('__typecho_uid', $uid, time() + $expire);
	\Typecho_Cookie::set('__typecho_authCode', \Typecho_Common::hash($authCode), time() + $expire);
	//更新最后登录时间以及验证码
	$db->query($db->update('table.users')->expression('logged', 'activated')->rows(array('authCode' => $authCode))->where('uid = ?', $uid));
}

function user_url($action)
{
	$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
	$relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);
	$url = urlencode($sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url);
	switch ($action) {
		case 'register':
			$url = \Typecho_Common::url('user/register', \Helper::options()->index) . '?from=' . $url;
			break;
		case 'login':
			$url = \Typecho_Common::url('user/login', \Helper::options()->index) . '?from=' . $url;
			break;
		case 'forget':
			$url = \Typecho_Common::url('user/forget', \Helper::options()->index) . '?from=' . $url;
			break;
	}
	return $url;
}


/** 获取百度统计配置 */
function baidu_statistic_config()
{
	$statistics_config = \Helper::options()->baidu_statistics ? explode(PHP_EOL, \Helper::options()->baidu_statistics) : null;
	if (is_array($statistics_config) && count($statistics_config) == 4) {
		return [
			'access_token' => trim($statistics_config[0]),
			'refresh_token' => trim($statistics_config[1]),
			'client_id' => trim($statistics_config[2]),
			'client_secret' => trim($statistics_config[3])
		];
	}
	return null;
}

/** 检测主题设置是否配置邮箱 */
function email_config()
{
	if (
		empty(\Helper::options()->JCommentMailHost) ||
		empty(\Helper::options()->JCommentMailPort) ||
		empty(\Helper::options()->JCommentMailAccount) ||
		empty(\Helper::options()->JCommentMailFromName) ||
		empty(\Helper::options()->JCommentSMTPSecure) ||
		empty(\Helper::options()->JCommentMailPassword)
	) {
		return false;
	} else {
		return true;
	}
}

/** 发送电子邮件 */
function send_email($title, $subtitle, $content, $email = '')
{
	if (!email_config()) {
		return false;
	}
	if (empty($email)) {
		$db = \Typecho_Db::get();
		$authoInfo = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', 1));
		if (empty($authoInfo['mail'])) {
			$email = \Helper::options()->JCommentMailAccount;
		} else {
			$email = $authoInfo['mail'];
		}
	}
	$mail = new \PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->CharSet = 'UTF-8';
	$mail->SMTPSecure = \Helper::options()->JCommentSMTPSecure;
	$mail->Host = \Helper::options()->JCommentMailHost;
	$mail->Port = \Helper::options()->JCommentMailPort;
	$mail->FromName = \Helper::options()->JCommentMailFromName;
	$mail->Username = \Helper::options()->JCommentMailAccount;
	$mail->From = \Helper::options()->JCommentMailAccount;
	$mail->Password = \Helper::options()->JCommentMailPassword;
	$mail->isHTML(true);
	$html = '<style>.Joe{width:550px;margin:0 auto;border-radius:8px;overflow:hidden;font-family:"Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;box-shadow:0 2px 12px 0 rgba(0,0,0,0.1);word-break:break-all}.Joe_title{color:#fff;background:linear-gradient(-45deg,rgba(9,69,138,0.2),rgba(68,155,255,0.7),rgba(117,113,251,0.7),rgba(68,155,255,0.7),rgba(9,69,138,0.2));background-size:400% 400%;background-position:50% 100%;padding:15px;font-size:15px;line-height:1.5}</style><div class="Joe"><div class="Joe_title">{title}</div><div style="background: #fff;padding: 20px;font-size: 13px;color: #666;"><div style="margin-bottom: 20px;line-height: 1.5;">{subtitle}</div><div style="padding: 15px;margin-bottom: 20px;line-height: 1.5;background: repeating-linear-gradient(145deg, #f2f6fc, #f2f6fc 15px, #fff 0, #fff 25px);">{content}</div><div style="line-height: 2">请注意：此邮件由系统自动发送，请勿直接回复。<br>若此邮件不是您请求的，请忽略并删除！</div></div></div>';
	$mail->Body = strtr(
		$html,
		array(
			"{title}" => $title . ' - ' . \Helper::options()->title,
			"{subtitle}" => $subtitle,
			"{content}" => $content,
		)
	);
	$mail->addAddress($email);
	$mail->Subject = $title . ' - ' . \Helper::options()->title;
	if ($mail->send()) {
		return 'success';
	} else {
		return $mail->ErrorInfo;
	}
}

function filterCommentText(string $text): string
{
	$options = \Helper::options();
	$status = '';

	if (preg_match('/\{!\{(.*)\}!\}/', $text, $matches)) {
		/* 用户输入内容画图模式 */
		$status = (strpos($matches[1], '"') !== false || _checkXSS($matches[1])) ? 'waiting' : $status;
	} elseif (
		($options->JTextLimit && strlen($text) > $options->JTextLimit) ||
		($options->JSensitiveWords && count(array_filter(array_map('trim', explode('||', $options->JSensitiveWords)), fn ($word) => false !== strpos($text, $word))) > 0) ||
		($options->JLimitOneChinese === "on" && preg_match("/[\x{4e00}-\x{9fa5}]/u", $text) == 0)
	) {
		$status = 'waiting';
	}

	\Typecho_Cookie::delete('__typecho_remember_text');
	return $status;
}

/**
 * ajaxComment
 * 实现Ajax评论的方法(实现feedback中的comment功能)
 * @param Widget_Archive $archive
 * @return void
 */
function ajaxComment($archive)
{
	$options = \Helper::options();
	$user = \Typecho_Widget::widget('Widget_User');
	$db = \Typecho_Db::get();
	// Security 验证不通过时会直接跳转，所以需要自己进行判断
	// 需要开启反垃圾保护，此时将不验证来源
	if ($archive->request->get('_') != \Helper::security()->getToken($archive->request->getReferer())) {
		$archive->response->throwJson(array('status' => 0, 'msg' => _t('非法请求')));
	}
	/** 评论关闭 */
	if (!$archive->allow('comment')) {
		$archive->response->throwJson(array('status' => 0, 'msg' => _t('评论已关闭')));
	}
	/** 检查ip评论间隔 */
	if (
		!$user->pass('editor', true) && $archive->authorId != $user->uid &&
		$options->commentsPostIntervalEnable
	) {
		$latestComment = $db->fetchRow($db->select('created')->from('table.comments')
			->where('cid = ?', $archive->cid)
			->where('ip = ?', $archive->request->getIp())
			->order('created', \Typecho_Db::SORT_DESC)
			->limit(1));

		if ($latestComment && ($options->gmtTime - $latestComment['created'] > 0 &&
			$options->gmtTime - $latestComment['created'] < $options->commentsPostInterval)) {
			$archive->response->throwJson(array('status' => 0, 'msg' => _t('对不起, 您的发言过于频繁, 请稍侯再次发布')));
		}
	}

	$comment = array(
		'cid'       =>  $archive->cid,
		'created'   =>  $options->gmtTime,
		'agent'     =>  isset($_COOKIE['win11']) ? str_replace("Windows NT 10.0", "Windows NT 11.0", $archive->request->getAgent()) : $archive->request->getAgent(),
		'ip'        =>  $archive->request->getIp(),
		'ownerId'   =>  $archive->author->uid,
		'type'      =>  'comment',
		'status'    =>  !$archive->allow('edit') && $options->commentsRequireModeration ? 'waiting' : 'approved'
	);

	/** 判断父节点 */
	if ($parentId = $archive->request->filter('int')->get('parent')) {
		if ($options->commentsThreaded && ($parent = $db->fetchRow($db->select('coid', 'cid')->from('table.comments')
			->where('coid = ?', $parentId))) && $archive->cid == $parent['cid']) {
			$comment['parent'] = $parentId;
		} else {
			$archive->response->throwJson(array('status' => 0, 'msg' => _t('父级评论不存在')));
		}
	}
	$feedback = \Typecho_Widget::widget('Widget_Feedback');
	//检验格式
	$validator = new \Typecho_Validate();
	$validator->addRule('author', 'required', _t('必须填写用户名'));
	$validator->addRule('author', 'xssCheck', _t('请不要在用户名中使用特殊字符'));
	$validator->addRule('author', array($feedback, 'requireUserLogin'), _t('您所使用的用户名已经被注册,请登录后再次提交'));
	$validator->addRule('author', 'maxLength', _t('用户名最多包含200个字符'), 200);

	if ($options->commentsRequireMail && !$user->hasLogin()) {
		$validator->addRule('mail', 'required', _t('必须填写电子邮箱地址'));
	}

	$validator->addRule('mail', 'email', _t('邮箱地址不合法'));
	$validator->addRule('mail', 'maxLength', _t('电子邮箱最多包含200个字符'), 200);

	if ($options->commentsRequireUrl && !$user->hasLogin()) {
		$validator->addRule('url', 'required', _t('必须填写个人主页'));
	}
	$validator->addRule('url', 'url', _t('个人主页地址格式错误'));
	$validator->addRule('url', 'maxLength', _t('个人主页地址最多包含200个字符'), 200);

	$validator->addRule('text', 'required', _t('必须填写评论内容'));

	$comment['text'] = $archive->request->text;

	/** 对一般匿名访问者,将用户数据保存一个月 */
	if (!$user->hasLogin()) {
		/** Anti-XSS */
		$comment['author'] = $archive->request->filter('trim')->author;
		$comment['mail'] = $archive->request->filter('trim')->mail;
		$comment['url'] = $archive->request->filter('trim')->url;

		/** 修正用户提交的url */
		if (!empty($comment['url'])) {
			$urlParams = parse_url($comment['url']);
			if (!isset($urlParams['scheme'])) {
				$comment['url'] = 'http://' . $comment['url'];
			}
		}

		$expire = $options->gmtTime + $options->timezone + 30 * 24 * 3600;
		\Typecho_Cookie::set('__typecho_remember_author', $comment['author'], $expire);
		\Typecho_Cookie::set('__typecho_remember_mail', $comment['mail'], $expire);
		\Typecho_Cookie::set('__typecho_remember_url', $comment['url'], $expire);
	} else {
		$comment['author'] = $user->screenName;
		$comment['mail'] = $user->mail;
		$comment['url'] = $user->url;

		/** 记录登录用户的id */
		$comment['authorId'] = $user->uid;
	}

	/** 评论者之前须有评论通过了审核 */
	if (!$options->commentsRequireModeration && $options->commentsWhitelist) {
		if ($feedback->size($feedback->select()->where('author = ? AND mail = ? AND status = ?', $comment['author'], $comment['mail'], 'approved'))) {
			$comment['status'] = 'approved';
		} else {
			$comment['status'] = 'waiting';
		}
	}

	if ($error = $validator->run($comment)) {
		$archive->response->throwJson(array('status' => 0, 'msg' => implode(';', $error)));
	}

	/*评论过滤*/
	$comment['status'] = filterCommentText($comment['text']);

	/** 添加评论 */
	$commentId = $feedback->insert($comment);
	if (!$commentId) {
		$archive->response->throwJson(array('status' => 0, 'msg' => _t('评论失败')));
	}
	\Typecho_Cookie::delete('__typecho_remember_text');
	$db->fetchRow($feedback->select()->where('coid = ?', $commentId)
		->limit(1), array($feedback, 'push'));

	/** 评论成功 */
	$feedback->pluginHandle()->finishComment($feedback);
	// 返回评论数据
	$data = array(
		'coid' => $feedback->coid,
		'parent' => $feedback->parent,
		'parentcontent' => getParentReply($feedback->parent) ?? '',
		'author' => $feedback->author,
		'datetime' => $feedback->date->format('Y-m-d H:i:s'),
		'content' => _parseCommentReply($feedback),
		'avatarlazyload' => getAvatarLazyload(false),
		'avatarbymail' => getAvatarByMail($feedback->mail, true),
		'letter_avatar' => letter_avatar($feedback->author),
		'ips' => \XQLocation_Plugin::render($feedback->ip, true),
		'owner' => ($feedback->authorId === $feedback->ownerId) ? '<i class="owner">作者</i>' : '',
		'status' => ($feedback->status === "waiting") ? '<em class="waiting">（评论审核中...）</em>' : '',
		'agent' => \XQUserAgent_Plugin::render($feedback->agent, true),
	);

	$archive->response->throwJson(array('status' => 1, 'comment' => $data));
}