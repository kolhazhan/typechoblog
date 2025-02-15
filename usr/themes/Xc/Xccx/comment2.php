<?php
function Xc_rz($widget, $email = NULL){
if (empty($email)) return;
$handsome = array(
'111999@qq.com','111999@163.com',  //这里可以添加认证用户的邮箱，评论区就会有认证两个字
);
if ($widget->authorId == $widget->ownerId) {
echo '';
} else if (in_array($email, $handsome)) {
echo '<span class="autlv aut-1">认证</span>';      
}}
?>


<link rel="stylesheet" href="<?php _getAssets('assets/Xc/css/Xc.comment.css'); ?>" />
<?php $this->comments()->to($comments); ?>
<div class="Xc_comment">
<h3 class="Xc_comment_title">—— 评论区 ——</h3>
<?php if ($this->hidden) : ?>
<div class="Xc_comment_close">
<svg class="Xc_comment_close-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
<path d="M512.307.973c282.317 0 511.181 201.267 511.181 449.587a402.842 402.842 0 0 1-39.27 173.26 232.448 232.448 0 0 0-52.634-45.977c16.384-39.782 25.293-82.688 25.293-127.283 0-211.098-199.117-382.157-444.621-382.157-245.555 0-444.57 171.06-444.57 382.157 0 133.427 79.514 250.88 200.039 319.18v107.982l102.041-65.127a510.157 510.157 0 0 0 142.49 20.122l19.405-.359c19.405-.716 38.758-2.508 57.958-5.427l3.584 13.415a230.607 230.607 0 0 0 22.323 50.688l-20.633 3.328a581.478 581.478 0 0 1-227.123-12.288L236.646 982.426c-19.66 15.001-35.635 7.168-35.635-17.664v-157.39C79.411 725.198 1.024 595.969 1.024 450.56 1.024 202.24 229.939.973 512.307.973zm318.464 617.011c97.485 0 176.794 80.435 176.794 179.2S928.256 976.23 830.77 976.23c-97.433 0-176.742-80.281-176.742-179.046 0-98.816 79.309-179.149 176.742-179.149zM727.757 719.002a131.174 131.174 0 0 0-25.754 78.182c0 71.885 57.805 130.406 128.768 130.406 28.877 0 55.552-9.625 77.056-26.01zm103.014-52.327c-19.712 0-39.117 4.557-56.678 13.312L946.33 854.58c8.499-17.305 13.158-36.864 13.158-57.395 0-71.987-57.805-130.509-128.717-130.509zM512.307 383.13l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072 67.072 67.072 0 0 1 66.662-67.43zm266.752 0l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072h-.051l.307-6.86a67.072 67.072 0 0 1 66.406-60.57zm-533.504 0l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072 67.072 67.072 0 0 1 66.662-67.43z" />
</svg>
<span>当前文章受密码保护，无法评论</span>
</div>
<?php else : ?>
<?php if ($this->allow('comment') && $this->options->JCommentStatus !== "off") : ?>

<?php if ($this->options->comment_login === '01' || !$this->options->comment_login) : ?>
<?php $this->need('Xccx/interaction.php'); ?>
<?php endif; ?>

<?php if ($this->options->comment_login === '02' || !$this->options->comment_login) : ?>
<?php if($this->user->hasLogin()): ?>
<?php $this->need('Xccx/interaction.php'); ?>
<?php else: ?>
<div id="<?php $this->respondId(); ?>" class="Xc_comment_respond">
<form method="post" class="Xc_comment_respond-form" action="<?php $this->commentUrl() ?>" data-type="text">
<div class="Xc_comment_Xcoff">
<div class="Xc_comment_Xclogin"> 请登录后发表评论 </div>
<a href="/admin" target="_blank" rel="noopener noreferrer nofollow">立即登录</a>
<?php if ($this->options->allowRegister) : ?>
<a href="/admin/register.php" target="_blank" rel="noopener noreferrer nofollow" style="margin-left:30px">用户注册</a>
<?php endif; ?>
<div class="Xc_comment_Xcbottom">LOGIN</div> </div>
</form></div>
<?php endif; ?>
<?php endif; ?>

<?php if ($comments->have()) : ?>
<?php $comments->listComments(); ?>
<?php
$comments->pageNav(
'<svg class="icon icon-prev" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
'<svg class="icon icon-next" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
1,
'...',
array(
'wrapTag' => 'ul',
'wrapClass' => 'Xc_pagination',
'itemTag' => 'li',
'textTag' => 'a',
'currentClass' => 'active',
'prevClass' => 'prev',
'nextClass' => 'next'
)
);
?>
<?php endif; ?>
<?php else : ?>
<div class="Xc_comment_close">
<svg class="Xc_comment_close-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
<path d="M512.307.973c282.317 0 511.181 201.267 511.181 449.587a402.842 402.842 0 0 1-39.27 173.26 232.448 232.448 0 0 0-52.634-45.977c16.384-39.782 25.293-82.688 25.293-127.283 0-211.098-199.117-382.157-444.621-382.157-245.555 0-444.57 171.06-444.57 382.157 0 133.427 79.514 250.88 200.039 319.18v107.982l102.041-65.127a510.157 510.157 0 0 0 142.49 20.122l19.405-.359c19.405-.716 38.758-2.508 57.958-5.427l3.584 13.415a230.607 230.607 0 0 0 22.323 50.688l-20.633 3.328a581.478 581.478 0 0 1-227.123-12.288L236.646 982.426c-19.66 15.001-35.635 7.168-35.635-17.664v-157.39C79.411 725.198 1.024 595.969 1.024 450.56 1.024 202.24 229.939.973 512.307.973zm318.464 617.011c97.485 0 176.794 80.435 176.794 179.2S928.256 976.23 830.77 976.23c-97.433 0-176.742-80.281-176.742-179.046 0-98.816 79.309-179.149 176.742-179.149zM727.757 719.002a131.174 131.174 0 0 0-25.754 78.182c0 71.885 57.805 130.406 128.768 130.406 28.877 0 55.552-9.625 77.056-26.01zm103.014-52.327c-19.712 0-39.117 4.557-56.678 13.312L946.33 854.58c8.499-17.305 13.158-36.864 13.158-57.395 0-71.987-57.805-130.509-128.717-130.509zM512.307 383.13l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072 67.072 67.072 0 0 1 66.662-67.43zm266.752 0l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072h-.051l.307-6.86a67.072 67.072 0 0 1 66.406-60.57zm-533.504 0l6.861.358a67.072 67.072 0 0 1 59.853 67.072l-.307 6.86a67.072 67.072 0 0 1-66.407 60.57l-6.81-.358a67.072 67.072 0 0 1-59.852-67.072 67.072 67.072 0 0 1 66.662-67.43z" />
</svg>
<?php if ($this->options->JCommentStatus === "off") : ?>
<span>博主关闭了所有页面的评论</span>
<?php else : ?>
<span>博主关闭了当前页面的评论</span>
<?php endif; ?>
</div>
<?php endif; ?>
<?php endif; ?>
</div>

<?php
function threadedComments($comments, $options)
{ ?>
<li class="comment_list_item">
<div class="comment_list_item-contain" id="<?php $comments->theId(); ?>">
<div class="Xc_comment<?php $comments->authorId(); ?> term">
<a rel="Xc" href="javascript:void(0);" class="reply Xc_comment_reply" data-id="<?php $comments->theId(); ?>" data-coid="<?php $comments->coid(); ?>">
<div style="font-size:28px;" class="reply Xc_comment_reply" data-id="<?php $comments->theId(); ?>" data-coid="<?php $comments->coid(); ?>" title="回复Ta">@</div>
<img width="45" height="45" class="avatar lazyload" src="<?php _getAvatarLazyload() ?>" data-src="<?php _getAvatarByMail($comments->mail); ?>" alt="头像" />
</a>
<div class="content">
<div class="user">
<span class="author"><?php $comments->author(); ?></span>
<?php _getParentReply($comments->parent) ?>
<?php Xc_rz($comments, $comments->mail); ?> 
<?php if ($comments->authorId === $comments->ownerId) : ?>
<span class="autlv aut-0">博主</span>
<?php endif; ?>

<?php if ($comments->status === "waiting") : ?>
<em class="waiting">（评论审核中...）</em>
<?php endif; ?>
<div class="agent"><?php XCCXOS_Plugin::render($comments->agent); ?></div>

</div>
<div class="substance">
<?php echo _parseCommentReply($comments->content); ?>
</span>
</div>
<div class="handle">
<time class="date" datetime="<?php $comments->date('Y年m月d日 H:i'); ?>"><?php $comments->date('Y年m月d日 H:i'); ?></time>
</div>
</div>
</div>
<?php if ($comments->children) : ?>
<div class="comment_list_item-children">
<?php $comments->threadedComments($options); ?>
</div>
<?php endif; ?>
</li>
<?php } ?>