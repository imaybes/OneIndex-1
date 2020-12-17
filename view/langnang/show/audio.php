<?php view::layout('layout') ?>

<?php view::begin('content'); ?>
<div class="mdui-container-fluid">
	<div class="nexmoe-item">

		<audio class="mdui-center" src="<?php e($item['downloadUrl']); ?>" controls autoplay style="width: 100%;" poster="<?php @e($item['thumb'] . '&width=176&height=176'); ?>">
		</audio>

		<ul class="mdui-list" style="max-height: 500px;overflow:auto;">
			<?php foreach ((array)$this->playlist as $item) : ?>
				<?php if (empty($item['folder'])) : ?>
					<li class="mdui-list-item file mdui-ripple">
						<a href="<?php echo $item['name'] . "#" . $key; ?>" target="_self">
							<div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
								<span><?php e($item['name']); ?></span>
							</div>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>

		<br>
		<!-- 固定标签 -->
		<div class="mdui-textfield">
			<label class="mdui-textfield-label">下载地址</label>
			<input class="mdui-textfield-input" type="text" value="<?php e($url); ?>" />
		</div>
		<div class="mdui-textfield">
			<label class="mdui-textfield-label">引用地址</label>
			<textarea class="mdui-textfield-input"><audio src="<?php e($url); ?>"></audio></textarea>
		</div>
	</div>
</div>
<script src="/view/langnang/js/list.js"></script>

<a href="<?php e($url); ?>" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">file_download</i></a>
<?php view::end('content'); ?>