<?php
if (!isset($gCms)) exit;

$db = cmsms()->GetDb();

if (isset($params['message'])) {
    echo $this->ShowMessage($params['message']);
}
if (isset($params['error'])) {
    echo $this->ShowErrors($params['error']);
}

$tagsQuery = 'SELECT id, name FROM ' . cms_db_prefix() . 'module_streamingmanager_tags ORDER BY name ASC';
$tags = $db->GetArray($tagsQuery);
$smarty->assign('tags', $tags);

echo $this->StartTabHeaders();
echo $this->SetTabHeader('tags', 'Tags');
echo $this->SetTabHeader('videos', 'Videos');
echo $this->EndTabHeaders();

echo $this->StartTabContent();
/**
 * Tags tab
 */
echo $this->StartTab('tags');

echo $this->ProcessTemplate('admin_add_tag.tpl');
echo "</br>";
echo "</br>";
echo $this->ProcessTemplate('admin_tags.tpl');

echo $this->EndTab();

/**
 * Videos tab
 */
echo $this->StartTab('videos');

$videosWithTags = $this->GetVideosByTags("");
$smarty->assign('videos', $videosWithTags);

echo $this->ProcessTemplate('admin_add_video.tpl');

echo "</br>";
echo $this->ProcessTemplate('admin_videos.tpl');

echo $this->EndTab();

echo $this->EndTabContent();
