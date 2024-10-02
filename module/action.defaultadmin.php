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
$smarty->assign('lang', $this->GetCurrentLanguageTranslations());

if (sizeof($tags) == 0) {
    echo '<div style="font-size: 18px; background: #ffc107; padding: 8px 12px; border-radius: 4px; border: 1px solid #ffc720;">';
    echo "Please note that at least one tag must be added before you can proceed. Tags help categorize your videos and make them easier to find.";
    echo '</div>';
}

echo $this->StartTabHeaders();
echo $this->SetTabHeader('tags', 'Tags');

if (sizeof($tags) > 0) {
    echo $this->SetTabHeader('videos', 'Videos');
    echo $this->EndTabHeaders();
}

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

if (sizeof($tags) > 0) {
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
}

echo $this->EndTabContent();
