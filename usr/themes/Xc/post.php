<?php $this->need('public/head.php'); ?>
<?php $this->need('public/include.php'); ?>

<body>
<?php $this->need('public/header.php'); ?>
<?php $this->need('Xccx/picture_post.php'); ?>

<div class="Xc_total Xc_Pjax showInUp">
<div class="Xc_main Xc_post">
<div class="Xc_reads" data-cid="<?php echo $this->cid ?>">
<?php $this->need('public/batten.php'); ?>
<?php if ($this->options->top_img_datu === '02') : ?><?php $this->need('Xccx/note_picture_post.php'); ?><?php endif; ?>
<?php $this->need('public/article.php'); ?>
<?php $this->need('public/handle.php'); ?>
<?php $this->need('public/operate.php'); ?>
</div>
<?php $this->need('public/copyright.php'); ?>
<?php $this->need('public/comment.php'); ?>
</div>
<?php if ($this->options->JAside_cblpost === 'on') : ?>
<?php $this->need('public/aside.php'); ?>
<?php endif; ?>
</div>
<?php $this->need('public/footer.php'); ?>
</body>
</html>