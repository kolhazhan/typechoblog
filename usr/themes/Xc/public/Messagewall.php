<?php if ($this->options->Messagewall_ranking === 'on') : ?>

<style>
.Xc_reads_leaving-ranking{display:grid;grid-template-columns:repeat(auto-fill,minmax(135px,1fr));gap:15px;margin-bottom:15px}
.Xc_reads_leaving-ranking .item{height:150px;display:flex;flex-direction:column;align-items:center;justify-content:center}
.Xc_reads_leaving-ranking .item .user{display:flex;position:relative;flex-direction:column;align-items:center;justify-content:center}
.Xc_reads_leaving-ranking .item .user img{width:55px;height:55px;border-radius:50%;overflow:hidden;margin-bottom:10px;-o-object-fit:cover;object-fit:cover;transition:transform .75s;}
.Xc_reads_leaving-ranking .item .user a{color:var(--main);width:105px;text-align:center;white-space:nowrap;text-overflow:ellipsis;overflow:hidden}
.Xc_reads_leaving-ranking .item .user a:hover{color:var(--theme)}
.Xc_reads_leaving-ranking .item .user span{display:-webkit-box;overflow:hidden;text-overflow:ellipsis;-webkit-line-clamp:1;-webkit-box-orient:vertical;flex-shrink:1;font-size:15px;}
.Xc_reads_leaving-ranking .item ul{color:var(--routine);}
</style>

<ul class="Xc_reads_leaving-ranking">
<?php
$time = time() - 60 * 60 * 24 * Helper::options()->JReader_Ranking_Time;
$mail = Helper::options()->JReader_Ranking_Mail;
$limit = Helper::options()->JReader_Ranking_Limit;
$counts = Typecho_Db::get()->fetchAll(
Typecho_Db::get()
->select('COUNT(author) AS cnt', 'author', 'max(url) url', 'max(authorId) authorId', 'max(mail) mail')
->from('table.comments')
->where('created > ?', $time)
->where('status = ?', 'approved')
->where('type = ?', 'comment')
->where('mail != ?', $mail)
->group('author')
->order('cnt', Typecho_Db::SORT_DESC)
->limit($limit)
);
foreach ($counts as $count) {
echo '
<li class="item">
<div class="user">
<a target="_blank" href=' . $count['url'] . '>
<img src="' . _getAvatarByMail($count['mail'], false) . '"><span>' . $count['author'] . '</span>
</a></div> <ul>留言 ' . $count['cnt'] . ' 次</ul></li>
';
}
?>
</ul>
<?php endif; ?>


<?php if ($this->options->Messagewall_card === 'on') : ?>
<div class="Xc_reads_leaving">
<?php $this->comments()->to($comments); ?>
<?php if ($comments->have()) : ?>
<ul class="Xc_reads_leaving-list">
<?php while ($comments->next()) : ?>
<li class="item">
<div class="user">
<img class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php _getAvatarByMail($comments->mail) ?>" alt="用户头像" />
<div class="nickname"><?php $comments->author(); ?></div>
<div class="date"><?php $comments->date('Y/m/d'); ?></div>
</div>
<div class="wrapper">
<div class="content"><?php _parseLeavingReply($comments->content); ?></div>
</div>
</li>
<?php endwhile; ?>
</ul>
<?php else : ?>
<div class="Xc_reads_leaving-none">暂无留言，期待第一个脚印。</div>
<?php endif; ?>
</div>
<?php endif; ?>