<?php
if (!isset($gCms)) exit;

$wholeStartTime = microtime(true);
$db = cmsms()->GetDb();

if (isset($params['message'])) {
    echo $this->ShowMessage($params['message']);
}
if (isset($params['error'])) {
    echo $this->ShowErrors($params['error']);
}

$queriesStartTime = microtime(true);
$tagsQuery = 'SELECT id, name FROM ' . cms_db_prefix() . 'module_streamingmanager_tags ORDER BY name ASC';
$tags = $db->GetArray($tagsQuery);

$videosWithTags = $this->GetVideosByTags("", "");
$queriesEndTime = microtime(true);
$duration = number_format($queriesEndTime - $queriesStartTime, 5);
echo '<p style="font-size: 12px; color: grey;">Query all videos and tags execution time: ' . ($duration) . 's</p>';

if (sizeof($tags) == 0) {
    echo '<div style="margin: 8px 0 0 0;font-size: 18px; background: #ffc107; padding: 8px 12px; border-radius: 4px; border: 1px solid #ffc720;">';
    echo "Please note that at least one tag must be added before you can proceed. Tags help categorize your videos and make them easier to find.";
    echo '</div>';
}

$smarty->assign('videos', $videosWithTags);
$smarty->assign('tags', $tags);
$smarty->assign('lang', $this->GetCurrentLanguageTranslations());

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

    echo $this->ProcessTemplate('admin_add_video.tpl');
    echo "</br>";
    echo $this->ProcessTemplate('admin_videos.tpl');

    echo $this->EndTab();
}

echo $this->EndTabContent();

$wholeEndTime = microtime(true);
$duration = number_format($wholeEndTime - $wholeStartTime, 5);
echo '<p style="margin: 8px 0 0 0;font-size: 12px; color: grey;">Admin view evaluation time: ' . ($duration) . 's</p>';
