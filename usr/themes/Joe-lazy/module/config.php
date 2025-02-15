<script>
(()=>{const ua=window.navigator.userAgent;if(ua.includes("MSIE ")||ua.includes("Trident/")||ua.includes("Edge/")){alert('当前站点不支持IE浏览器或您开启了兼容模式，请使用其他浏览器访问或关闭兼容模式。');window.location.href='https://www.baidu.com'}window.Joe={TITLE:`<?=$this->options->title()?>`,THEME_URL:`<?=$this->options->themeUrl()?>`,BASE_API:`<?=$this->options->rewrite==0?Helper::options()->rootUrl.'/index.php/joe/api':Helper::options()->rootUrl.'/joe/api'?>`,BAIDU_PUSH:<?=$this->options->JBaiduToken?'true':'false'?>,BING_PUSH:<?=$this->options->JBingToken?'true':'false'?>,DOCUMENT_TITLE:`<?=$this->options->JDocumentTitle()?>`,LAZY_LOAD:`<?=joe\getLazyload()?>`,BIRTHDAY:`<?=$this->options->JBirthDay()?>`,MOTTO:`<?=joe\getAsideAuthorMotto()?>`,PAGE_SIZE:`<?=$this->parameter->pageSize()?>`}})();
</script>
<style>
	<?php
	$fontFormats = ['woff2', 'woff', 'ttf', 'eot', 'svg'];
	$fontUrl = $this->options->JCustomFont ?? '';
	$fontFormat = array_reduce($fontFormats, function ($carry, $item) use ($fontUrl) {
		return strpos($fontUrl, $item) !== false ? $item : $carry;
	}, '');
	$mobileAgents = ['nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile'];
	$isMobile = $_SERVER['HTTP_X_WAP_PROFILE'] ?? false ||
		stristr($_SERVER['HTTP_VIA'] ?? '', "wap") ||
		preg_match("/(" . implode('|', $mobileAgents) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'] ?? '')) ||
		((strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'text/html'))));
	$deviceType = $isMobile ? 'wap' : 'pc';
	$css = ($this->is('index') ? ".joe_index__hot-list .item>.item-body>.item-tags-category" . ($isMobile ? '::-webkit-scrollbar {display: none;}' : ' {padding-bottom: 3px;}') : '') .
		(($this->options->JWallpaper_Background_Optimal == 'all' || $this->options->JWallpaper_Background_Optimal == $deviceType) ? 'html .joe_footer .joe_container>.item,html .joe_footer .joe_container a,html .joe_bread__bread .item,html .joe_bread__bread .item .link,html .text-muted,html .joe_index__title-title>.item,html .joe_index__title-notice>a{color:var(--classC);}html .joe_bread__bread>.item>.icon{fill:var(--classC);}html .text-muted>a{color:var(--classD);}html .joe_action_item{background:var(--back-trn-85);}' : '') .
		($this->options->{"JWallpaper_Background_$deviceType"} ? "html body::before {background: url(" . $this->options->{"JWallpaper_Background_$deviceType"} . ")}" : '') .
		($this->options->JGrey_Model == 'on' ? 'html {-webkit-filter: grayscale(1);}' : '') .
		(($this->is('index') || $this->is('archive')) && $this->options->JIndex_Article_Double_Column == 'on' ? '@media(min-width:1200px){.joe_aside{display:none;}.joe_list{display:grid;grid-template-columns:repeat(2,1fr);column-gap:15px;}.joe_list>.joe_list__item{border-radius:var(--radius-wrap);}}' : '') .
		"@font-face{font-family:'Joe Font';font-weight:400;font-style:normal;font-display:swap;src:url('" . ($fontUrl ?? '') . "');" . ($fontFormat ? "src:url('$fontUrl') format('$fontFormat');" : '') . "}" .
		"body {" . ($fontUrl ? "font-family: 'Joe Font';" : "font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif;") . "}";
	echo preg_replace(array('/\s+/', '/\*.*?\*/', '/\n/', '/\r/', '/\r\n/', '/\t/'), '', $css . $this->options->JCustomCSS);
	?>
</style>
<?php if ($this->options->JIndex_Link_Active == 'on') : ?>
	<link rel="stylesheet" href="<?= joe\theme_url('assets/css/options/JIndex_Link_Active.min.css') ?>">
<?php endif; ?>