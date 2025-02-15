<?php

/**
 * 壁纸
 * 
 * @package custom 
 * 
 **/

?>
<?php $this->need('public/head.php'); ?>
<?php $this->need('public/include.php'); ?>

<body>
<?php $this->need('public/header.php'); ?>
<?php $this->need('Xccx/picture_post.php'); ?>
<div class="Xc_total Xc_Pjax showInUp">
<div class="Xc_main  Xc_page">
<div class="Xc_wallpaper__type">
<div class="Xc_wallpaper__type-title">壁纸分类</div>
<ul class="Xc_wallpaper__type-list">
<li class="error">正在拼命加载中...</li>
</ul>
</div>
<div class="Xc_wallpaper__list"></div>
<ul class="Xc_wallpaper__pagination"></ul>
</div>
<?php if ($this->options->JAside_cblpage === 'on') : ?>
<?php $this->need('public/aside.php'); ?>
<?php endif; ?>
</div>
<?php $this->need('public/footer.php'); ?>
</body>
</html>