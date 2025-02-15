<Xc_Pjax_top><script>localStorage.getItem("data-night") && document.querySelector("html").setAttribute("data-night", "night");window.Xc={THEME_URL:`<?php Helper::options()->themeUrl()?>`,PAGE_INDEX:`<?php echo $this->_currentPage;?>`||1,BASE_API:`<?php echo $this->options->rewrite==0?Helper::options()->rootUrl.'/index.php/Xc/api':Helper::options()->rootUrl.'/Xc/api'?>`,DYNAMIC_BACKGROUND:`<?php $this->options->JDynamic_Background()?>`,WALLPAPER_BACKGROUND_PC:`<?php $this->options->JWallpaper_Background_PC()?>`,IS_MOBILE:/windows phone|iphone|android/gi.test(window.navigator.userAgent),BAIDU_PUSH:<?php echo $this->options->JBaiduToken?'true':'false'?>,DOCUMENT_TITLE:`<?php $this->options->JDocumentTitle()?>`,LAZY_LOAD:`<?php _getLazyload()?>`,BIRTHDAY:`<?php $this->options->JBirthDay()?>`,MOTTO:`<?php _getAsideAuthorMotto()?>`,PAGE_SIZE:`<?php $this->parameter->pageSize()?>`}</script></Xc_Pjax_top>
<?php
$fontUrl = $this->options->JCustomFont;
if (strpos($fontUrl, 'woff2') !== false) {
    $fontFormat = 'woff2';
} elseif (strpos($fontUrl, 'woff') !== false) {
    $fontFormat = 'woff';
} elseif (strpos($fontUrl, 'ttf') !== false) {
    $fontFormat = 'truetype';
} elseif (strpos($fontUrl, 'eot') !== false) {
    $fontFormat = 'embedded-opentype';
} elseif (strpos($fontUrl, 'svg') !== false) {
    $fontFormat = 'svg';
} else {
    $fontFormat = ''; 
}
?>
<style>
<?php if ($this->options->JCustomFont) : ?>@font-face {font-family: 'Xc Font'; font-weight: 400; font-style: normal; font-display: swap; src: url('<?php echo $fontUrl ?>'); <?php if ($fontFormat) : ?>src: url('<?php echo $fontUrl ?>') format('<?php echo $fontFormat ?>');<?php endif; ?>}
*{font-family:'Xc Font',sans-serif !important}<?php endif; ?>

html .header_internal .Xc_total{max-width:<?php $this->options->template_header() ?>} 
html .header_below .Xc_total{max-width:<?php $this->options->template_header() ?>} 
html .header_search .Xc_total{max-width:<?php $this->options->template_header() ?>} 
html .Xc_main{max-width:<?php $this->options->template_main() ?>} 
html .Xc_aside{width:<?php $this->options->template_aside() ?>}
<?php if ($this->options->aside_weizi === '02') : ?>html .Xc_aside{order:-1 !important;margin-right:20px;margin-left:0}<?php endif; ?>

body::before {
background: #f0f0f0;
background: <?php if (_isMobile()) {
echo $this->options->JWallpaper_Background_WAP ? "url(" . $this->options->JWallpaper_Background_WAP . ")" : "";
} else {
echo $this->options->JWallpaper_Background_PC ? "url(" . $this->options->JWallpaper_Background_PC . ")" : "";
} ?>;
background-position: center 0;
background-repeat: no-repeat;
background-size: cover;
}

<?php $this->options->JCustomCSS() ?>
</style>

<link rel="stylesheet" href="<?php _getAssets('assets/css/Xc.global.css'); ?>" />
<link rel="stylesheet" href="<?php _getAssets('assets/css/Xc.style.css'); ?>" />
<link rel="stylesheet" href="<?php _getAssets('assets/css/Xc.theme.css'); ?>" />
<link rel="stylesheet" href="<?php _getAssets('assets/css/swiper.css'); ?>" />
<?php if ($this->options->JPrismTheme) : ?>
<link rel="stylesheet" href="<?php $this->options->JPrismTheme() ?>">
<?php else : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/code/prism.css'); ?>" />
<?php endif; ?>
<script src="<?php _getAssets('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/Xc.style.min.js'); ?>"></script>
<script src="<?php _getAssets('assets/js/swiper.min.js'); ?>"></script>
<link rel="stylesheet" href="//at.alicdn.com/t/c/font_4380197_smrki4hojn.css" />
<script src="//at.alicdn.com/t/c/font_3863156_af9gg1ogdhn.js"></script>

<?php if ($this->options->JAside_Loadanimation === '01') : ?>
<!-- 加载动画 -->
<div id="Loadanimation" style="z-index:999999;">
<div id="Loadanimation-center">
<div class="xccx_object" id="xccx_four"></div>
<div class="xccx_object" id="xccx_three"></div>
<div class="xccx_object" id="xccx_two"></div>
<div class="xccx_object" id="xccx_one"></div>
</div></div>
<script>$(function(){ $("#Loadanimation").fadeOut(530); });</script>
<?php endif; ?>

<?php if ($this->options->Xc_Theme_pattern === '01') : ?>
<?php if ($this->options->JAside_xccx_ck === '02') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/xccx.ck.css'); ?>" />
<?php endif; ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index1.css'); ?>" />
<?php endif; ?>

<?php if ($this->options->Xc_Theme_pattern === '02') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index2.css'); ?>" />
<?php endif; ?>

<?php if ($this->options->Xc_Theme_pattern === '03') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index3.css'); ?>" />
<?php endif; ?>

<?php if ($this->options->Xc_Theme_pattern === '04') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index4.css'); ?>" />
<?php endif; ?>

<?php if ($this->options->Xc_Theme_pattern === '05') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index5.css'); ?>" />
<?php endif; ?>

<?php if ($this->options->Xc_Theme_pattern === '06') : ?>
<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.index6.css'); ?>" />
<?php if ($this->options->JAside_xccx_ck === '02') : ?>
<style>
@media(max-width:992px){html .Xc_home_article-list{display:grid;grid-template-columns:repeat(1,1fr);-webkit-column-gap:20px;column-gap:20px;}}
.Xc_home_article-list{display:grid;grid-template-columns:repeat(2,1fr);-webkit-column-gap:20px;}
.Xc_home_article-si.default .thumbnail{width:190px;height:130px;}
.Xc_home_article-si .meta{display:flex;align-items:center;margin-top:auto;color:var(--minor);font-size:12px;}
</style>
<?php endif; ?>
<?php endif; ?>
<?php $this->options->JCustomHeadEnd() ?>
