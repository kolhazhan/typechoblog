<?php if ($this->options->Xc_html_Pjax === 'off') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index6.css'); ?>" />
<?php endif; ?>

<div class="Xc_archive_list Xc_home_article-list">
<?php while ($this->next()) : ?>
<li class="Xc_home_article-si index6">
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
<div class="last" style="display: flex">
<a class="link" rel="noopener noreferrer" href="<?php echo $this->categories[0]['permalink']; ?>"> 
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-A21"></use></svg><?php echo $this->categories[0]['name']; ?>
</a>
</div>
</div>
</div>
</li>
<?php endwhile; ?>
</div>