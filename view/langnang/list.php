<?php view::layout('layout') ?>
<?php
$imgItems = array();
$videoItems = array();
$audioItems = array();
$pdfItems = array();
function file_ico($item)
{
    $ext = strtolower(pathinfo($item['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['bmp', 'jpg', 'jpeg', 'png', 'gif'])) {
//        array_push($imgItems, $item);
        return "&#xe3f4;";
    }
    if (in_array($ext, ['mp4', 'mkv', 'webm', 'avi', 'mpg', 'mpeg', 'rm', 'rmvb', 'mov', 'wmv', 'mkv', 'asf'])) {
//        array_push($videoItems, $item);
        return "&#xe63a;";
    }
    if (in_array($ext, ['ogg', 'mp3', 'wav'])) {
//        array_push($audioItems, $item);
        return "&#xe3a1;";
    }
    if (in_array($ext, ['pdf'])) {
//        array_push($pdfItems, $item);
        return "&#xe415;";
    }
    return "&#xe24d;";
}

foreach ((array)$items as $item) {
    if (empty($item['folder'])) {
        if (file_ico($item) == "&#xe3f4;") {
            array_push($imgItems, $item);
        }
        if (file_ico($item) == "&#xe63a;") {
            array_push($videoItems, $item);
        }
        if (file_ico($item) == "&#xe3a1;") {
            array_push($audioItems, $item);
        }
        if (file_ico($item) == "&#xe415;") {
            array_push($pdfItems, $item);
        }
    }
}
?>

<?php view::begin('content'); ?>
    <div class="mdui-container-fluid">
        <?php if ($head) : ?>
            <div class="mdui-typo" style="padding: 20px;">
                <?php e($head); ?>
            </div>
        <?php endif; ?>
        <style>
            .thumb .th {
                display: none;
            }

            .thumb .mdui-text-right {
                display: none;
            }

            .thumb .mdui-list-item a,
            .thumb .mdui-list-item {
                width: 217px;
                height: 230px;
                float: left;
                margin: 10px 10px !important;
            }

            .thumb .mdui-col-xs-12,
            .thumb .mdui-col-sm-7 {
                width: 100% !important;
                height: 230px;
            }

            .thumb .mdui-list-item .mdui-icon {
                font-size: 100px;
                display: block;
                margin-top: 40px;
                color: #7ab5ef;
            }

            .thumb .mdui-list-item span {
                float: left;
                display: block;
                text-align: center;
                width: 100%;
                position: absolute;
                top: 180px;
            }
        </style>
        <div class="nexmoe-item">
            <div class="mdui-row">
                <ul class="mdui-list">
                    <li class="mdui-list-item th">
                        <div class="mdui-col-xs-12 mdui-col-sm-7">
                            文件
                            <i class="mdui-icon material-icons icon-sort" data-sort="name" data-order="downward">&#xe5cf;</i>
                        </div>
                        <div class="mdui-col-sm-3 mdui-text-right">
                            修改时间
                            <i class="mdui-icon material-icons icon-sort" data-sort="date" data-order="downward">&#xe5cf;</i>
                        </div>
                        <div class="mdui-col-sm-2 mdui-text-right">
                            大小
                            <i class="mdui-icon material-icons icon-sort" data-sort="size" data-order="downward">&#xe5cf;</i>
                        </div>
                    </li>
                    <?php if ($path != '/') : ?>
                        <li class="mdui-list-item mdui-ripple">
                            <a href="<?php echo get_absolute_path($root . $path . '../'); ?>">
                                <div class="mdui-col-xs-12 mdui-col-sm-7">
                                    <i class="mdui-icon material-icons">&#xe5d8;</i>
                                    ..
                                </div>
                                <div class="mdui-col-sm-3 mdui-text-right"></div>
                                <div class="mdui-col-sm-2 mdui-text-right"></div>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php foreach ((array)$items as $index => $item) : ?>
                        <?php if (!empty($item['folder'])) : ?>

                            <li class="mdui-list-item mdui-ripple">
                                <a href="<?php echo get_absolute_path($root . $path . rawurlencode($item['name'])); ?>">
                                    <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
                                        <i class="mdui-icon material-icons">&#xe2c8;</i>
                                        <span><?php e($item['name']); ?></span>
                                    </div>
                                    <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']); ?></div>
                                    <div class="mdui-col-sm-2 mdui-text-right"><?php echo onedrive::human_filesize($item['size']); ?></div>
                                </a>
                            </li>
                        <?php elseif (file_ico($item) == '&#xe63a;'): ?>
                            <li class="mdui-list-item file mdui-ripple">
                                <a href="javascript:void 0" data-type="<?php echo file_ico($item); ?>"
                                   data-url="<?php e($item['downloadUrl']); ?>" data-key="<?php echo $index; ?>"
                                   onclick="play_video.call(this)">
                                    <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
                                        <i class="mdui-icon material-icons"><?php echo file_ico($item); ?></i>
                                        <span><?php e($item['name']); ?></span>
                                    </div>
                                    <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']); ?></div>
                                    <div class="mdui-col-sm-2 mdui-text-right"><?php echo onedrive::human_filesize($item['size']); ?></div>
                                </a>
                            </li>
                        <?php elseif (file_ico($item) == '&#xe3f4;'): ?>
                            <li class="mdui-list-item file mdui-ripple">
                                <a href="<?php echo get_absolute_path($root . $path) . rawurlencode($item['name']); ?>"
                                   target="_self">
                                    <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
                                        <i class="mdui-icon material-icons"><?php echo file_ico($item); ?></i>
                                        <span><?php e($item['name']); ?></span>
                                    </div>
                                    <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']); ?></div>
                                    <div class="mdui-col-sm-2 mdui-text-right"><?php echo onedrive::human_filesize($item['size']); ?></div>
                                    <img class="mdui-img-fluid mdui-center" src="<?php e($item['downloadUrl']); ?>"/>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="mdui-list-item file mdui-ripple">
                                <a href="<?php echo get_absolute_path($root . $path) . rawurlencode($item['name']); ?>"
                                   target="_self">
                                    <div class="mdui-col-xs-12 mdui-col-sm-7 mdui-text-truncate">
                                        <i class="mdui-icon material-icons"><?php echo file_ico($item); ?></i>
                                        <span><?php e($item['name']); ?></span>
                                    </div>
                                    <div class="mdui-col-sm-3 mdui-text-right"><?php echo date("Y-m-d H:i:s", $item['lastModifiedDateTime']); ?></div>
                                    <div class="mdui-col-sm-2 mdui-text-right"><?php echo onedrive::human_filesize($item['size']); ?></div>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php if ($readme) : ?>
            <div class="mdui-typo mdui-shadow-3" style="padding: 20px;margin: 20px 0;">
                <div class="mdui-chip">
                    <span class="mdui-chip-icon"><i class="mdui-icon material-icons">face</i></span>
                    <span class="mdui-chip-title">README.md</span>
                </div>
                <?php e($readme); ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="/view/langnang/js/list.js"></script>
    <a href="javascript:thumb();" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent"><i
                class="mdui-icon material-icons">&#xe241;</i></a>

<?php view::end('content'); ?>