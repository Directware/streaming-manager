<?php

if (!isset($_POST['video_id'])) {
    $params['error'] = $this->Lang('ErrorVideoIdNotProvided');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
    return;
}

$videoId = $_POST['video_id'];
$videoQuery = 'SELECT * FROM ' . cms_db_prefix() . 'module_streamingmanager_videos WHERE id = ?';
$video = $db->GetRow($videoQuery, [$videoId]);

if (!$video) {
    $params['error'] = $this->Lang('ErrorVideoNotFound');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
    return;
}

// get all assigned tags
$assignedTagsQuery = 'SELECT t.id, t.name FROM ' . cms_db_prefix() . 'module_streamingmanager_tags t JOIN ' . cms_db_prefix() . 'module_streamingmanager_tag_video_mapping vtm ON t.id = vtm.tagId WHERE vtm.videoId = ?';
$assignedTags = $db->GetArray($assignedTagsQuery, [$videoId]);

// get all tags
$tagsQuery = 'SELECT * FROM ' . cms_db_prefix() . 'module_streamingmanager_tags';
$allTags = $db->GetArray($tagsQuery);

// assign vars to smarty
$smarty->assign('video', $video);
$smarty->assign('assignedTags', $assignedTags);
$smarty->assign('allTags', $allTags);
$smarty->assign('lang', $this->GetCurrentLanguageTranslations());

// render template
echo $this->ProcessTemplate('admin_edit_video.tpl');
