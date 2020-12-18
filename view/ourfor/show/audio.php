<?php view::layout('layout')?>

<?php view::begin('content');?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.css">
<div class="mdui-container-fluid">
	<br>
	<center>
	<div id="aplayer"></div>
	</audio>
	</center>
	<br>
	<!-- 固定标签 -->
	<div>
	  <label class="mdui-textfield-label">下载地址</label>
	  <pre><?php e($url);?></pre>
	</div>
	<div>
	  <label class="mdui-textfield-label">引用地址</label>
	  <pre>&lt;audio src="<?php e($url);?>"&gt;&lt;/audio&gt;</pre>
	</div>
</div>
<a href="<?php e($url);?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
<script src="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.js"></script>
<script>
const ap = new APlayer({
    container: document.getElementById('aplayer'),
    audio: [{
        name: '<?php e(pathinfo($item["name"], PATHINFO_FILENAME)); ?>',
	artist: '跳动的音符',
        url: '<?php e($item['downloadUrl']);?>',
        cover: '<?php e( !empty($item['thumb'] ) ? $item['thumb'].'&width=176&height=176' : 'https://file.ourfor.top/source/ourfor/favicon.png');?>'
    }]
});
</script>

<?php view::end('content');?>
