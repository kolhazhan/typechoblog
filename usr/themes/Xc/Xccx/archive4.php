<?php if ($this->options->Xc_html_Pjax === 'off') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index4.css'); ?>" />
<?php endif; ?>

<div class="Xc_archive_list Xc_home_article-list">
<?php while ($this->next()) : ?>
<li class="Xc_home_article-si Xct index4">
<div class="Xc_home4_img"> 
<img src="<?php echo _getThumbnails($this)[0] ?>" />
</div>
<a href="<?php $this->permalink() ?>" class="thumbnail">
<img class="Xc_img lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" />
</a>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>"><?php $this->title() ?></a>
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-rili"></use></svg><?php echo formatTime($this->created); ?></li>
<li><span>丨</span><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-huore"></use></svg><?php Postviews($this); ?>阅读</li>
<li><span>丨</span><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-xiaoxi"></use></svg><?php $this->commentsNum('%d'); ?>评论</li>
</ul>
<div class="last">
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>"> 
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-biaoqian"></use></svg><?php echo $this->categories[0]['name']; ?>
</a>
</div></div></div>
</li>
<?php endwhile; ?>
</div>
