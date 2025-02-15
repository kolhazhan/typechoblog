<?php $this->need('public/head.php'); ?>
<?php $this->need('public/include.php'); ?>

<body>
<?php $this->need('public/header.php'); ?>
<?php $this->need('Xccx/picture_index.php'); ?>

<div class="Xc_total Xc_Pjax showInUp">
<div class="Xc_main index">
<div class="Xc_home">
<!-- 置顶轮播 -->
<?php if ($this->options->JIndexSticky) : ?>
<?php
$recommend = [];
$recommend_text = $this->options->JIndexSticky;
if ($recommend_text) {
$recommend_arr = explode("||", $recommend_text);
$recommend = $recommend_arr;
}
?>

<div class="swiper-container" style="margin-bottom: 30px">
<div class="swiper-wrapper">
<?php foreach ($recommend as $cid) : ?>
<?php $this->widget('Widget_Contents_Post@' . $cid, 'cid=' . $cid)->to($item); ?>
<div class="swiper-slide">
<li class="Topping">
<div class="Xc_Topping_img"> 
<img src="<?php echo _getThumbnails($item)[0] ?>" />
</div>

<div class="information">
<a href="<?php $item->permalink() ?>" class="title" title="<?php $item->title() ?>" rel="noopener noreferrer">
<?php $item->title() ?>
</a>

<div class="meta">
<ul class="items">
<li><svg class="icon2 sj" aria-hidden="true"><use xlink:href="#icon-rili"></use></svg><?php echo formatTime($item->created); ?></li>
<li><span>丨</span><svg class="icon2 yd" aria-hidden="true"><use xlink:href="#icon-huore"></use></svg><?php Postviews($item); ?>阅读</li>
<li><span>丨</span><svg class="icon2 pl" aria-hidden="true"><use xlink:href="#icon-xiaoxi"></use></svg><?php $item->commentsNum('%d'); ?>评论</li>
</ul>
<div class="last">
<a class="link" rel="noopener noreferrer" href="<?php echo $item->categories[0]['permalink']; ?>"> 
<span>丨</span><svg class="icon2 bq" aria-hidden="true"><use xlink:href="#icon-biaoqian"></use></svg><?php echo $item->categories[0]['name']; ?>
</a>
</div></div></div></li>
</div>
<?php endforeach; ?>
</div>
<div class="swiper-pagination"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-button-next"></div>
</div>
<?php endif; ?>


<?php if ($this->options->JIndexSticky) : ?>
<!-- 自定义模块 -->
<?php $this->options->Xct_index_customize() ?>
<?php endif; ?>
<div class="Xc_home_article">
<div class="Xc_home_article-list">

<?php while($this->next()): ?>
<li class="Xc_home_article-si Xct index4">
<div class="Xc_home4_img"> 
<img src="<?php echo _getThumbnails($this)[0] ?>" />
</div>
<a href="<?php $this->permalink() ?>" class="thumbnail" rel="noopener noreferrer">
<img class="Xc_img lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" />
</a>
<div class="information">
<a href="<?php $this->permalink() ?>" class="title" title="<?php $this->title() ?>" rel="noopener noreferrer"><?php $this->title() ?></a>
<a class="abstract" href="<?php $this->permalink() ?>" title="文章摘要" rel="noopener noreferrer"><?php _getAbstract($this) ?></a>
<div class="meta">
<ul class="items">
<li><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-rili"></use></svg><?php echo formatTime($this->created); ?></li>
<li><span>丨</span><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-huore"></use></svg><?php Postviews($this); ?>阅读</li>
<li><span>丨</span><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-xiaoxi"></use></svg><?php $this->commentsNum('%d'); ?>评论</li>
</ul>
<div class="last">
<a class="link" rel="noopener noreferrer" href="<?php echo $this->categories[0]['permalink']; ?>"> 
<svg class="icon2" aria-hidden="true"><use xlink:href="#icon-biaoqian"></use></svg><?php echo $this->categories[0]['name']; ?>
</a>
</div></div>
</div></li>
<?php endwhile; ?>
</div></div></div>

<?php if ($this->options->JPageStatus === 'default') : ?>
<?php $this->pageNav(
'<svg class="icon icon-prev" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
'<svg class="icon icon-next" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',1,'...',
array(
'wrapTag' => 'ul',
'wrapClass' => 'Xc_pagination',
'itemTag' => 'li',
'textTag' => 'a',
'currentClass' => 'active',
'prevClass' => 'prev',
'nextClass' => 'next'
)
);?>
<?php else : ?>
<div class="Xc_load" data-type="article">
<?php $this->pageLink('查看更多', 'next'); ?>
</div>

<script>
jQuery(document).ready(function ($) {
  var $next = $(".next");
  var $archiveList = $(".Xc_home_article-list");
  $next.click(function () {
    var $this = $(this).addClass("Xc").text("加载中...");
    var href = $this.attr("href");
    if (href != null) {
      $.ajax({
        url: href,
        type: "get",
        success: function (data) {
          $this.removeClass("loadingbibi-arrow-repeat").text("加载更多");
          var $list = $(data).find(".Xc_home_article-si.Xct:not(.sticky)");
          $archiveList.append($list);
          var newHref = $(data).find(".next").attr("href");
          $next.attr("href", newHref);
          if (!newHref) {
            $next.remove().hide();
            Qmsg.warning("没有更多内容了");
          }
        }
      });
    }
    return false;
  });
});
</script>

<?php endif ?>
</div>

<?php if ($this->options->JAside_cebianlan === 'on') : ?>
<?php $this->need('public/aside.php'); ?>
<?php endif; ?>
</div>
