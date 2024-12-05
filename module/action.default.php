<?php
if (!defined('CMS_VERSION')) exit;

$videos = array();

if ($params["tags"]) {
    $videos = $this->GetVideosByTags($params["tags"], $params["excluded_tags"]);
}

if ($params["id"]) {
    $videos = [$this->getVideoById($params["id"])];
}

$width = $params['width'];
$height = $params['height'];

$smarty->assign('width', $width);
$smarty->assign('height', $height);
$smarty->assign('videos', $videos);

echo $this->ProcessTemplate('default.tpl');
