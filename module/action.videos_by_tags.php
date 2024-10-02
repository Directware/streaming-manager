<?php
$db = cmsms()->GetDb();

$query = 'SELECT * 
FROM ' . cms_db_prefix() . 'module_streamingmanager_videos
JOIN ' . cms_db_prefix() . 'module_streamingmanager_tag_video_mapping vtm ON v.id = vtm.videoId';

$videos = $db->GetArray($query);

$smarty->assign('videos', $videos);

echo $this->ProcessTemplate('videos_by_tags.tpl');
