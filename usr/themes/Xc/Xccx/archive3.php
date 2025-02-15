<?php if ($this->options->Xc_html_Pjax === 'off') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index3.css'); ?>" />
<?php endif; ?>

<div class="Xc_archive_list Xc_home_article-list">
<?php while ($this->next()) : ?>
<div class="Xc_home_article-si Xct index3">
<div class="Xc_card-img">
<a href="<?php $this->permalink() ?>">
<img class="lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" alt="<?php $this->title() ?>" />
</a>
</div>
<div class="Xc_card-main">
<div class="Xc_card-title">
<a class="Xc_card-title-link" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
</div>
<div class="Xc_card-region">
 <div class="Xc_card-category">
<a class="link" href="<?php echo $this->categories[0]['permalink']; ?>" title="<?php echo $this->categories[0]['name']; ?>"><?php echo $this->categories[0]['name']; ?></a>
</div>
<div class="Xc_card-tags">
<?php $this->tags(''); ?>
</div>
</div>
<ul class="Xc_card-information">
<div class="Xc_card-details-left">
<li><?php $this->date('Y年m月d日'); ?></li>
</div>
<div class="Xc_card-details-right">
<li style="margin-right:5px"><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php Postviews($this); ?></li>
<li style="margin-right:5px"><svg class="icon2 pl" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2 zan" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</div>
</ul></div>
</div>
<?php endwhile; ?>
</div>
