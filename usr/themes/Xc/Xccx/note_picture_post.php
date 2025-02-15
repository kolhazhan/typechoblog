<div class="Xc_reads_topic">
<?php if ($this->is('page')): ?>
<h1 class="Xc_reads_title"><?php $this->title() ?></h1>
<?php endif; ?>
<?php if ($this->is('post')): ?>
<h1 class="Xc_reads_title"><?php $this->title() ?></h1>
<div class="Xc_post_Rotation">
<li class="Xc_post_Rotation_source">
<span><i class="iconfont Xc-icon-user"></i><?php $this->author(); ?></span>
<span><span class="line">丨</span><i class="iconfont Xc-icon-B1"></i><?php $this->date('Y年m月d日'); ?></span>
<span><span class="line">丨</span><i class="iconfont Xc-icon-B2"></i><?php Postviews($this); ?>阅读</span>
<span><span class="line">丨</span><i class="iconfont Xc-icon-B3"></i><?php $this->commentsNum('%d'); ?>评论</span>
</li>
</div>
<?php endif; ?>
</div>