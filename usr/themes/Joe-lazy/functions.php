<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

define('JOE_VERSION', '3.0');
define('JOE_ROOT', dirname(__FILE__) . '/');

/* Joe核心文件 */
require_once(__DIR__ . '/public/common.php');

function themeConfig($form)
{
	$_db = Typecho_Db::get();
	$_prefix = $_db->getPrefix();
	$fieldsToAdd = ['views', 'agree'];
	try {
		$existingFields = array_keys($_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)));

		foreach ($fieldsToAdd as $field) {
			if (!in_array($field, $existingFields)) {
				$_db->query("ALTER TABLE `{$_prefix}contents` ADD `{$field}` INT DEFAULT 0;");
			}
		}
	} catch (Exception $e) {
	}

?>
	<script>
		window.Joe = {
			version: `<?= JOE_VERSION ?>`,
		}
	</script>
	<link rel="stylesheet" href="<?= joe\theme_url('assets/typecho/config/css/joe.config.min.css') ?>">
	<script src="<?= joe\theme_url('assets/lib/sweetalert2/sweetalert2.js'); ?>"></script>

	<script src="<?= joe\theme_url('assets/typecho/config/js/joe.config.min.js') ?>"></script>
	<div class="joe_config">
		<div>
			<div class="joe_config__aside">
				<div class="logo">Joe懒人版</div>
				<ul class="tabs">
					<li class="item" data-current="joe_notice">最新公告</li>
					<li class="item" data-current="joe_global">全局设置</li>
					<li class="item" data-current="joe_safe">安全设置</li>
					<li class="item" data-current="joe_image">图片设置</li>
					<li class="item" data-current="joe_post">文章设置</li>
					<li class="item" data-current="joe_aside">侧栏设置</li>
					<li class="item" data-current="joe_index">首页设置</li>
					<li class="item" data-current="joe_decoration">特效设置</li>
					<li class="item" data-current="joe_user">登录设置</li>
					<li class="item" data-current="joe_music">音乐设置</li>
					<li class="item" data-current="joe_friend">友链设置</li>
					<li class="item" data-current="joe_comment">评论设置</li>
					<li class="item" data-current="joe_statistic">统计设置</li>
					<li class="item" data-current="joe_message">消息推送</li>
					<li class="item" data-current="joe_code">插入代码</li>
					<li class="item" data-current="joe_other">其他设置</li>
				</ul>
				<?php require_once('public/backup.php'); ?>
			</div>
		</div>
		<div class="joe_config__notice">请求数据中...</div>
	<?php

	// 全局设置
	require_once('options/global.php');

	// 安全设置
	require_once('options/safe.php');

	// 图片设置
	require_once('options/image.php');

	// 文章设置
	require_once('options/post.php');

	// 侧栏设置
	require_once('options/aside.php');

	// 首页设置
	require_once('options/index.php');

	// 特效设置
	require_once('options/decoration.php');

	// 登录设置
	require_once('options/user.php');

	// 音乐设置
	require_once('options/music.php');

	// 友链设置
	require_once('options/friend.php');

	// 评论设置
	require_once('options/comment.php');

	// 统计设置
	require_once('options/statistic.php');

	// 消息推送
	require_once('options/message.php');

	// 自定义代码
	require_once('options/code.php');

	// 其他设置
	require_once('options/other.php');
}
