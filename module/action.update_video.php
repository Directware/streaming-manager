<?php
if (isset($_POST['submit_cancel_edit_video'])) {
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
    return;
}

if (isset($_POST['submit_update_video'])) {
    $tag_ids = $_POST['tag_ids'];
    $videoId = $_POST['video_id'];
    $videoUrl = $_POST['video_url'];
    $videoName = $_POST['video_name'];
    $videoDescription = $_POST['video_description'];

    if (!$videoId) {
        $params['error'] = $this->Lang('ErrorVideoIdNotProvided');
        $this->Redirect($id, 'edit_video', $returnid, $params);
        return;
    }

    // Update video
    $updateVideoQuery = 'UPDATE ' . cms_db_prefix() . 'module_streamingmanager_videos SET streamUrl = ?, name = ?, description = ? WHERE id = ?';
    $db->Execute($updateVideoQuery, [$videoUrl, $videoName, $videoDescription, $videoId]);

    // Delete alls tag mappings for this video
    $deleteTagsMappingQuery = 'DELETE FROM ' . cms_db_prefix() . 'module_streamingmanager_tag_video_mapping WHERE videoId = ?';
    $db->Execute($deleteTagsMappingQuery, [$videoId]);

    // Insert new tag mappings
    foreach ($tag_ids as $tag_id) {
        $insertTagMappingQuery = 'INSERT INTO ' . cms_db_prefix() . 'module_streamingmanager_tag_video_mapping (tagId, videoId) VALUES (?, ?)';
        $db->Execute($insertTagMappingQuery, [$tag_id, $videoId]);
    }

    $params['message'] = $this->Lang('SuccessVideoUpdated');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}
