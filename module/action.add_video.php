<?php
if (isset($_POST['submit_new_video'])) {
    $videoName = trim($_POST['video_name']);
    $videoUrl = trim($_POST['video_url']);
    $videoDescription = trim($_POST['video_description']);
    $videoTagIds = $_POST['video_tag_ids'];

    if (!$videoName || !$videoUrl || !$videoTagIds || !is_array($videoTagIds) || count($videoTagIds) == 0) {
        $params['error'] = $this->Lang('ErrorVideoNotAdded');
        $this->Redirect($id, 'defaultadmin', $returnid, $params);
        return;
    }

    // Insert video
    $query = 'INSERT INTO ' . cms_db_prefix() . 'module_streamingmanager_videos (name, streamUrl, description) VALUES (?, ?, ?)';
    $db->Execute($query, [$videoName, $videoUrl, $videoDescription]);
    $videoId = $db->Insert_ID();

    // for every tag id insert coresponding video id
    foreach ($videoTagIds as $tagId) {
        $query = 'INSERT INTO ' . cms_db_prefix() . 'module_streamingmanager_tag_video_mapping (videoId, tagId) VALUES (?, ?)';
        $db->Execute($query, [$videoId, $tagId]);
    }

    $params['message'] = $this->Lang('VideoSuccessfullyAdded');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}
