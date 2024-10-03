<?php
if (!defined('CMS_VERSION')) exit;

$videosWithTags = $this->GetVideosByTags($params["tags"], $params["excluded_tags"]);
$smarty->assign('videos', $videosWithTags);

echo $this->ProcessTemplate('default.tpl');
