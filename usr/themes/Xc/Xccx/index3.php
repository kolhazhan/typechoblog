<?php $this->need('public/head.php'); ?>
<?php $this->need('public/include.php'); ?>

<body>
<?php $this->need('public/header.php'); ?>
<?php $this->need('Xccx/picture_index.php'); ?>

<div class="Xc_total Xc_Pjax showInUp">
<div class="Xc_main index">
<div class="Xc_home">
<?php
$carousel = [];
$carousel_text = $this->options->JIndex_Carousel;
if ($carousel_text) {
$carousel_arr = explode("\r\n", $carousel_text);
if (count($carousel_arr) > 0) {
for ($i = 0; $i < count($carousel_arr); $i++) {
$img = explode("||", $carousel_arr[$i])[0];
$url = explode("||", $carousel_arr[$i])[1];
$title = explode("||", $carousel_arr[$i])[2];
$carousel[] = array("img" => trim($img), "url" => trim($url), "title" => trim($title));
};
}
}
$recommend = [];
$recommend_text = $this->options->JIndex_Recommend;
if ($recommend_text) {
$recommend_arr = explode("||", $recommend_text);
if (count($recommend_arr) === 2) $recommend = $recommend_arr;
}
?>
<?php if (sizeof($carousel) > 0 || sizeof($recommend) === 2) : ?>
<div class="Xc_home_roll">
<?php if (sizeof($carousel) > 0) : ?>
<div class="swiper-container">
<div class="swiper-wrapper">
<?php foreach ($carousel as $item) : ?>
<div class="swiper-slide">
<a class="item" href="<?php echo $item['url'] ?>" target="_blank" rel="noopener noreferrer nofollow">
<img width="100%" height="100%" class="thumbnail lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo $item['img'] ?>" alt="<?php echo $item['title'] ?>" />
<div class="title"><?php echo $item['title'] ?></div>
<svg class="icon" viewBox="0 0 1026 1024" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
<path d="M784.3 1007.961a33.2 33.2 0 0 1-27.106-9.062L540.669 854.55 431.766 962.813c-9.062 9.062-36.168 18.044-45.23 9.062a49.72 49.72 0 0 1-27.106-45.23V727.763a33.2 33.2 0 0 1 9.463-27.106l343.071-370.578a44.748 44.748 0 0 1 63.274 63.274l-334.17 361.515v72.175l63.273-54.211a42.583 42.583 0 0 1 54.212-9.062l198.64 126.386L910.847 140.34 151.647 510.837 323.343 619.34c18.044 9.062 27.106 45.23 9.062 63.273-9.062 18.044-45.23 27.106-63.273 18.044L34.082 547.005c-8.981-8.982-18.043-17.723-18.043-36.168s9.062-27.105 27.105-36.167l903.79-451.815c18.043-9.062 36.167-9.062 45.229 0 18.284 9.223 18.284 27.106 18.284 45.15L829.69 971.794c0 18.043-9.062 27.105-27.105 36.167z" />
</svg>
</a>
</div>
<?php endforeach; ?>
</div>
<div class="swiper-pagination"></div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
</div>
<?php endif; ?>
<?php if (sizeof($recommend) === 2) : ?>
<div class="Xc_home_roll-recommend <?php echo sizeof($carousel) === 0 ? 'noswiper' : '' ?>">
<?php foreach ($recommend as $cid) : ?>
<?php $this->widget('Widget_Contents_Post@' . $cid, 'cid=' . $cid)->to($item); ?>
<figure class="item">
<a class="thumbnail" href="<?php $item->permalink() ?>" title="<?php $item->title() ?>">
<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($item)[0]; ?>" alt="<?php $item->title() ?>" />
</a>
<figcaption class="information">
<span class="type">推荐</span>
<div class="text"><?php $item->title() ?></div>
</figcaption>
</figure>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div>
<?php endif; ?>
<?php if ($this->options->JIndex_Hot === "on") : ?>
<?php $this->widget('Widget_Contents_Hot@Index', 'pageSize=4')->to($item); ?>
<div class="Xc_home_hot">
<ul class="Xc_home_hot-list">
<?php while ($item->next()) : ?>
<li class="item">
<a class="link" href="<?php $item->permalink(); ?>" title="<?php $item->title(); ?>">
<figure class="inner">
<span class="views"><?php echo number_format($item->views); ?> ℃</span>
<img width="100%" height="120" class="image lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($item)[0]; ?>" alt="<?php $item->title(); ?>" />
<figcaption class="title"><?php $item->title(); ?></figcaption>
</figure>
</a>
</li>
<?php endwhile; ?>
</ul>
</div>
<?php endif; ?>
<?php
$index_ad_text = $this->options->JIndex_Ad;
$index_ad = null;
if ($index_ad_text) {
$index_ad_arr = explode("||", $index_ad_text);
if (count($index_ad_arr) === 2) $index_ad = array("image" => trim($index_ad_arr[0]), "url" => trim($index_ad_arr[1]));
}
?>
<?php if ($index_ad) : ?>
<div class="Xc_home_ad">
<a class="Xc_home_ad-link" href="<?php echo $index_ad['url'] ?>" target="_blank" rel="noopener noreferrer nofollow">
<img width="100%" height="200" class="image lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo $index_ad['image'] ?>" alt="<?php echo $index_ad['url'] ?>" />
<span class="icon">广告</span>
</a>
</div>
<?php endif; ?>

<?php if ($this->options->Xct_index_customize) : ?>
<!-- 自定义模块 -->
<?php $this->options->Xct_index_customize() ?>
<?php endif; ?>
<div class="Xc_home_article">
<div class="Xc_home_article-list">
<?php
$recommend = [];
$recommend_text = $this->options->JIndexSticky;
if ($recommend_text) {
$recommend_arr = explode("||", $recommend_text);
$recommend = $recommend_arr;
}
?>
<?php foreach ($recommend as $cid) : ?>
<?php $this->widget('Widget_Contents_Post@' . $cid, 'cid=' . $cid)->to($item); ?>
<div class="Xc_home_article-si index3">
<div class="Xc_card-img">
<a href="<?php $item->permalink() ?>" rel="noopener noreferrer">
<img class=" lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($item)[0]; ?>" alt="<?php $item->title() ?>" />
</a>
</div>
<div class="Xc_card-main">
<div class="Xc_card-title">
<span class="Xc_card-article-top">置顶</span>
<a class="Xc_card-title-link" href="<?php $item->permalink() ?>" title="<?php $item->title() ?>" rel="noopener noreferrer"><?php $item->title() ?></a>
</div>
<div class="Xc_card-region">
 <div class="Xc_card-category">
<a class="link" href="<?php echo $item->categories[0]['permalink']; ?>" title="<?php echo $item->categories[0]['name']; ?>"><?php echo $item->categories[0]['name']; ?></a>
</div>
<div class="Xc_card-tags">
<?php $item->tags(''); ?>
</div>
</div>
<ul class="Xc_card-information">
<div class="Xc_card-details-left">
<li><?php $item->date('Y年m月d日'); ?></li>
</div>
<div class="Xc_card-details-right">
<li style="margin-right:5px"><svg class="icon2" aria-hidden="true"><use xlink:href="#icon-yuedu"></use></svg><?php Postviews($item); ?></li>
<li style="margin-right:5px"><svg class="icon2 pl" aria-hidden="true"><use xlink:href="#icon-pinglun"></use></svg><?php $item->commentsNum() ?></li>
<li><svg class="icon2 zan" aria-hidden="true"><use xlink:href="#icon-zan"></use></svg><?php $item->agree() ?></li>
</div>
</ul>
</div>
</div>
<?php endforeach; ?>

<?php while($this->next()): ?>
<div class="Xc_home_article-si Xct index3">
<div class="Xc_card-img">
<a href="<?php $this->permalink() ?>" rel="noopener noreferrer">
<img class="lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" alt="<?php $this->title() ?>" />
</a>
</div>
<div class="Xc_card-main">
<div class="Xc_card-title">
<a class="Xc_card-title-link" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>" rel="noopener noreferrer"><?php $this->title() ?></a>
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
</ul>
</div>
</div>
<?php endwhile; ?>
</div>
</div></div>

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