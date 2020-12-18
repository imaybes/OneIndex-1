<?php view::layout('layout')?>

<?php view::begin('content');?>
	
<div class="mdui-container-fluid">
	<br>
	<a data-fancybox="images" href="<?php e($item['downloadUrl']);?>"><img width="100%" src="<?php e($item['downloadUrl']);?>"></a>
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">下载地址</label>
	  <pre><?php e($url);?></pre>
	</div>
	<div class="mdui-textfield">
	  <label class="mdui-textfield-label">HTML 引用地址</label>
	  <pre>&lt;img src='<?php e($url);?>' /&gt;</pre>
	</div>
        <div class="mdui-textfield">
	  <label class="mdui-textfield-label">Markdown 引用地址</label>
	  <pre>![](<?php e($url);?>)</pre>
	</div>
        <br>
</div>
<a href="<?php e($url);?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<?php view::end('content');?>
