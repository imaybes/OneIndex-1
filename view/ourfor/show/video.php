<?php view::layout('layout')?>
<?php
$item['thumb'] = onedrive::thumbnail($item['path']);
?>
<?php view::begin('content');?>
<link class="dplayer-css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.css">
<div class="mdui-container-fluid">
	<br>
	<div id="dplayer"></div>
	<br>
	<!-- 固定标签 -->
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">下载地址</label>
	  <pre>"<?php e($url);?>"</pre>
	</div>
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">引用地址</label>
	  <pre>&lt;video&gt;&lt;source src="<?php e($url);?>" type="video/mp4"&gt;&lt;/video&gt;</pre>
	</div>
</div>
<?php if(pathinfo($item["name"], PATHINFO_EXTENSION) === 'flv') { e('<script src="https://cdn.jsdelivr.net/npm/flv.js/dist/flv.min.js"></script>'); } ?>
<script src="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script>
<script>
const dp = new DPlayer({
	container: document.getElementById('dplayer'),
	lang:'zh-cn',
	video: {
	    url: '<?php e($item['downloadUrl']);?>',
	    pic: '<?php @e($item['thumb']);?>',
	    type: '<?php e((pathinfo($item["name"], PATHINFO_EXTENSION) === 'flv') ? 'flv' : 'auto'); ?>'
	}
});
</script>
<a href="<?php e($url);?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
<?php view::end('content');?>
