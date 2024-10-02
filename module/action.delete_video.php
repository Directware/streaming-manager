<?php
if (isset($_POST['submit_delete_video'])) {
    $videoId = $_POST['video_id'];

    if (!$videoId) {
        $params['error'] = $this->Lang('ErrorVideoIdNotProvided');
        $this->Redirect($id, 'defaultadmin', $returnid, $params);
        return;
    }

    $query = 'DELETE FROM ' . cms_db_prefix() . 'module_streamingmanager_videos WHERE id = ?';
    $db->Execute($query, [$videoId]);

    $query = 'DELETE FROM ' . cms_db_prefix() . 'module_streamingmanager_tag_video_mapping WHERE videoId = ?';
    $db->Execute($query, [$videoId]);

    $params['message'] = $this->Lang('SuccessVideoDeleted');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}
