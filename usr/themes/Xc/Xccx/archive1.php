<?php if ($this->options->Xc_html_Pjax === 'off') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index1.css'); ?>" />
<?php endif; ?>

<div class="Xc_archive_list Xc_home_article-list">
<?php while ($this->next()) : ?>
<?php if ($this->fields->mode === "default" || !$this->fields->mode) : ?>
<li class="Xc_home_article-si default Xct">
<div class="line"></div>
<a href="<?php $this->permalink() ?>" class="thumbnail" title="<?php $this->title() ?>">
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" alt="<?php $this->title() ?>" />
</a>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>">
<?php $this->title() ?>
</a>
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
</div>
</div>
</li>
<?php elseif ($this->fields->mode === "single") : ?>
<li class="Xc_home_article-si single Xct">
<div class="line"></div>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>">
<?php $this->title() ?>
</a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
</div>
</div>
<a href="<?php $this->permalink() ?>" class="thumbnail" title="<?php $this->title() ?>">
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" alt="<?php $this->title() ?>" />
</a>
<div class="information" style="margin-bottom: 0;">
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
</div>
</li>
<?php elseif ($this->fields->mode === "multiple") : ?>
<li class="Xc_home_article-si multiple Xct">
<div class="line"></div>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>">
<?php $this->title() ?>
</a>
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
</div>
<a href="<?php $this->permalink() ?>" class="thumbnail" title="<?php $this->title() ?>">
<?php $image = _getThumbnails($this) ?>
<?php for ($x = 0; $x < 3; $x++) : ?>
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo $image[$x]; ?>" alt="<?php $this->title() ?>" />
<?php endfor; ?>
</a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
</div>
</li>
<?php else : ?>
<li class="Xc_home_article-si none Xct">
<div class="line"></div>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>">
<?php $this->title() ?>
</a>
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要"><?php _getAbstract($this) ?></a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-time"></use></svg><?php echo formatTime($this->created); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php _getViews($this) ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $this->commentsNum('%d'); ?></li>
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php _getAgree($this) ?></li>
</ul>
</div>
</div>
</li>
<?php endif; ?>
<?php endwhile; ?>
</div>