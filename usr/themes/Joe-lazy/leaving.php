<?php

/**
 * 留言
 *
 * @package custom
 *
 **/

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
	<?php $this->need('module/head.php'); ?>
	<script src="<?= joe\theme_url('assets/lib/draggabilly/draggabilly.pkgd.min.js'); ?>"></script>
	<script src="<?= joe\theme_url('assets/js/joe.leaving.min.js'); ?>"></script>
</head>

<body>
	<div id="Joe">
		<?php $this->need('module/header.php'); ?>
		<div class="joe_container">
			<div class="joe_main">
				<div class="joe_detail" data-cid="<?php echo $this->cid ?>">
					<?php $this->need('module/batten.php'); ?>
					<div class="joe_detail__leaving">
						<?php $this->comments()->to($comments); ?>
						<?php if ($comments->have()) : ?>
							<ul class="joe_detail__leaving-list">
								<?php while ($comments->next()) : ?>
									<li class="item">
										<div class="user">
											<div class="zetx">
												<img   class="avatar lazyload a" src="<?php joe\getAvatarLazyload() ?>" data-src="<?php joe\getAvatarByMail($comments->mail); ?>" alt="头像" />
												<img   class="avatar lazyload b" src="<?php joe\getAvatarLazyload() ?>" data-src="<?php joe\letter_avatar($comments->author); ?>" alt="头像" />
											</div>
											<div class="nickname"><?php $comments->author(); ?></div>
											<div class="date"><?php $comments->date('Y/m/d'); ?></div>
										</div>
										<div class="wrapper">
											<div class="content"><?php echo _parseCommentReply($comments, 'leaving'); ?></div>
										</div>
									</li>
								<?php endwhile; ?>
							</ul>
						<?php else : ?>
							<div class="joe_detail__leaving-none">暂无留言，期待第一个脚印。</div>
						<?php endif; ?>
					</div>
				</div>
				<?php $this->need('module/comment.php'); ?>
			</div>
		</div>
		<?php $this->need('module/footer.php'); ?>
	</div>
</body>

</html>