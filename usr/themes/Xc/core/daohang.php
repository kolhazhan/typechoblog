<!-- 站长平台 -->
<?php
$friends = [];
$friends_text = $this->options->JFriends1;
if ($friends_text) {
$friends_arr = explode("\r\n", $friends_text);
if (count($friends_arr) > 0) {
for ($i = 0; $i < count($friends_arr); $i++) {
$name = explode("||", $friends_arr[$i])[0];
$url = explode("||", $friends_arr[$i])[1];
$avatar = explode("||", $friends_arr[$i])[2];
$desc = explode("||", $friends_arr[$i])[3];
$friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
};
}
}
?>
<?php if (sizeof($friends) > 0) : ?>
<div class="xccx_Toolbox">
<div class="xccx_Toolbox_title">
<svg class="icon2" aria-hidden="true" style="width:18px;height:18px;margin-right:5px"><use xlink:href="#icon-toolbox"></use></svg><span class="title">站长平台</span>
</div>

<ul class="Xc_reads_Toolbox">
<?php foreach ($friends as $item) : ?>
<li class="Xc_reads_friends-item">
<a class="contain" href="<?php echo $item['url']; ?>" target="_blank">
<div class="xccx_img">
<img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>">
</div>
<div class="xccx_title">

<span class="name">
<span class="xccx-name"><?php echo $item['name']; ?></span> 
</span>
 
<div class="desc">
<div class="xccx-desc" title="<?php echo $item['desc']; ?>"><?php echo $item['desc']; ?></div>
</div>
</div>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>


<!-- 在线工具 -->
<?php
$friends = [];
$friends_text = $this->options->JFriends2;
if ($friends_text) {
$friends_arr = explode("\r\n", $friends_text);
if (count($friends_arr) > 0) {
for ($i = 0; $i < count($friends_arr); $i++) {
$name = explode("||", $friends_arr[$i])[0];
$url = explode("||", $friends_arr[$i])[1];
$avatar = explode("||", $friends_arr[$i])[2];
$desc = explode("||", $friends_arr[$i])[3];
$friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
};
}
}
?>
<?php if (sizeof($friends) > 0) : ?>
<div class="xccx_Toolbox">
<div class="xccx_Toolbox_title">
<svg class="icon2" aria-hidden="true" style="width:18px;height:18px;margin-right:5px"><use xlink:href="#icon-toolbox"></use></svg><span class="title">在线工具</span>
</div>

<ul class="Xc_reads_Toolbox">
<?php foreach ($friends as $item) : ?>
<li class="Xc_reads_friends-item">
<a class="contain" href="<?php echo $item['url']; ?>" target="_blank">
<div class="xccx_img">
<img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>">
</div>
<div class="xccx_title">

<span class="name">
<span class="xccx-name"><?php echo $item['name']; ?></span> 
</span>
 
<div class="desc">
<div class="xccx-desc" title="<?php echo $item['desc']; ?>"><?php echo $item['desc']; ?></div>
</div>
</div>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>


<!-- 网站程序 -->
<?php
$friends = [];
$friends_text = $this->options->JFriends3;
if ($friends_text) {
$friends_arr = explode("\r\n", $friends_text);
if (count($friends_arr) > 0) {
for ($i = 0; $i < count($friends_arr); $i++) {
$name = explode("||", $friends_arr[$i])[0];
$url = explode("||", $friends_arr[$i])[1];
$avatar = explode("||", $friends_arr[$i])[2];
$desc = explode("||", $friends_arr[$i])[3];
$friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
};
}
}
?>
<?php if (sizeof($friends) > 0) : ?>
<div class="xccx_Toolbox">
<div class="xccx_Toolbox_title">
<svg class="icon2" aria-hidden="true" style="width:18px;height:18px;margin-right:5px"><use xlink:href="#icon-toolbox"></use></svg><span class="title">网站程序</span>
</div>

<ul class="Xc_reads_Toolbox">
<?php foreach ($friends as $item) : ?>
<li class="Xc_reads_friends-item">
<a class="contain" href="<?php echo $item['url']; ?>" target="_blank">
<div class="xccx_img">
<img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>">
</div>
<div class="xccx_title">

<span class="name">
<span class="xccx-name"><?php echo $item['name']; ?></span> 
</span>
 
<div class="desc">
<div class="xccx-desc" title="<?php echo $item['desc']; ?>"><?php echo $item['desc']; ?></div>
</div>
</div>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>


<!-- 网站收录 -->
<?php
$friends = [];
$friends_text = $this->options->JFriends4;
if ($friends_text) {
$friends_arr = explode("\r\n", $friends_text);
if (count($friends_arr) > 0) {
for ($i = 0; $i < count($friends_arr); $i++) {
$name = explode("||", $friends_arr[$i])[0];
$url = explode("||", $friends_arr[$i])[1];
$avatar = explode("||", $friends_arr[$i])[2];
$desc = explode("||", $friends_arr[$i])[3];
$friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
};
}
}
?>
<?php if (sizeof($friends) > 0) : ?>
<div class="xccx_Toolbox">
<div class="xccx_Toolbox_title">
<svg class="icon2" aria-hidden="true" style="width:18px;height:18px;margin-right:5px"><use xlink:href="#icon-toolbox"></use></svg><span class="title">网站收录</span>
</div>

<ul class="Xc_reads_Toolbox">
<?php foreach ($friends as $item) : ?>
<li class="Xc_reads_friends-item">
<a class="contain" href="<?php echo $item['url']; ?>" target="_blank">
<div class="xccx_img">
<img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>">
</div>
<div class="xccx_title">

<span class="name">
<span class="xccx-name"><?php echo $item['name']; ?></span> 
</span>
 
<div class="desc">
<div class="xccx-desc" title="<?php echo $item['desc']; ?>"><?php echo $item['desc']; ?></div>
</div>
</div>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>


<!-- 放松福利 -->
<?php
$friends = [];
$friends_text = $this->options->JFriends5;
if ($friends_text) {
$friends_arr = explode("\r\n", $friends_text);
if (count($friends_arr) > 0) {
for ($i = 0; $i < count($friends_arr); $i++) {
$name = explode("||", $friends_arr[$i])[0];
$url = explode("||", $friends_arr[$i])[1];
$avatar = explode("||", $friends_arr[$i])[2];
$desc = explode("||", $friends_arr[$i])[3];
$friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
};
}
}
?>
<?php if (sizeof($friends) > 0) : ?>
<div class="xccx_Toolbox">
<div class="xccx_Toolbox_title">
<svg class="icon2" aria-hidden="true" style="width:18px;height:18px;margin-right:5px"><use xlink:href="#icon-toolbox"></use></svg><span class="title">放松福利</span>
</div>

<ul class="Xc_reads_Toolbox">
<?php foreach ($friends as $item) : ?>
<li class="Xc_reads_friends-item">
<a class="contain" href="<?php echo $item['url']; ?>" target="_blank">
<div class="xccx_img">
<img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>">
</div>
<div class="xccx_title">

 <span class="name">
<span class="xccx-name"><?php echo $item['name']; ?></span> 
</span>

<div class="desc">
<div class="xccx-desc" title="<?php echo $item['desc']; ?>"><?php echo $item['desc']; ?></div>
</div>
</div>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>


<!-- 其他资源 -->
<?php
$friends = [];
$friends_text = $this->options->JFriends6;
if ($friends_text) {
$friends_arr = explode("\r\n", $friends_text);
if (count($friends_arr) > 0) {
for ($i = 0; $i < count($friends_arr); $i++) {
$name = explode("||", $friends_arr[$i])[0];
$url = explode("||", $friends_arr[$i])[1];
$avatar = explode("||", $friends_arr[$i])[2];
$desc = explode("||", $friends_arr[$i])[3];
$friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
};
}
}
?>
<?php if (sizeof($friends) > 0) : ?>
<div class="xccx_Toolbox">
<div class="xccx_Toolbox_title">
<svg class="icon2" aria-hidden="true" style="width:18px;height:18px;margin-right:5px"><use xlink:href="#icon-toolbox"></use></svg><span class="title">其他资源</span>
</div>

<ul class="Xc_reads_Toolbox">
<?php foreach ($friends as $item) : ?>
<li class="Xc_reads_friends-item">
 <a class="contain" href="<?php echo $item['url']; ?>" target="_blank">
<div class="xccx_img">
<img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>">
</div>
<div class="xccx_title">

<span class="name">
<span class="xccx-name"><?php echo $item['name']; ?></span> 
</span>

<div class="desc">
<div class="xccx-desc" title="<?php echo $item['desc']; ?>"><?php echo $item['desc']; ?></div>
</div>
</div>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>
