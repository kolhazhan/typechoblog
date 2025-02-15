<?php if ($this->options->Xc_html_Pjax === 'off') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index5.css'); ?>" />
<?php endif; ?>

<div class="Xc_archive_list Xc_home_article-list">
<?php while ($this->next()) : ?>
<li class="Xc_home_article-si Xct index5">
<div class="Xc_home5_img"> 
<img src="<?php echo _getThumbnails($this)[0] ?>" />
</div>

<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>" rel="noopener noreferrer"><?php $this->title() ?></a>

<div class="meta">
<ul class="items">
<li><svg class="icon2 sj" aria-hidden="true"><use xlink:href="#icon-rili"></use></svg><?php echo formatTime($this->created); ?></li>
<li><span>丨</span><svg class="icon2 yd" aria-hidden="true"><use xlink:href="#icon-huore"></use></svg><?php Postviews($this); ?>阅读</li>
<li><span>丨</span><svg class="icon2 pl" aria-hidden="true"><use xlink:href="#icon-xiaoxi"></use></svg><?php $this->commentsNum('%d'); ?>评论</li>
</ul>
<div class="last">
<a class="link" rel="noopener noreferrer" href="<?php echo $this->categories[0]['permalink']; ?>"> 
<span>丨</span><svg class="icon2 bq" aria-hidden="true"><use xlink:href="#icon-biaoqian"></use></svg><?php echo $this->categories[0]['name']; ?>
</a>
</div></div>
</div></li>
<?php endwhile; ?>
</div>

