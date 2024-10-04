<?php
if (!defined('CMS_VERSION')) exit;

$videosWithTags = $this->GetVideosByTags($params["tags"], $params["excluded_tags"]);

$width = $params['width'];
$height = $params['height'];

$smarty->assign('width', $width);
$smarty->assign('height', $height);
$smarty->assign('videos', $videosWithTags);

echo $this->ProcessTemplate('default.tpl');
