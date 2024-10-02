<?php
if (isset($_POST['submit_delete_tag'])) {
    $tagId = $_POST['tag_id'];

    if (!$tagId) {
        $params['error'] = $this->Lang('ErrorTagIdNotProvided');
        $this->Redirect($id, 'defaultadmin', $returnid, $params);
        return;
    }

    $db = cmsms()->GetDb();

    // get tag name
    $tagQuery = 'SELECT name FROM ' . cms_db_prefix() . 'module_streamingmanager_tags WHERE id = ?';
    $tagName = $db->GetOne($tagQuery, [$tagId]);

    $videosWithTags = $this->GetVideosByTags($tagName);

    if (sizeof($videosWithTags) > 0) {
        $params['error'] = $this->Lang('ErrorTagCannotBeDeleted');
        $this->Redirect($id, 'defaultadmin', $returnid, $params);
        return;
    }

    $query = 'DELETE FROM ' . cms_db_prefix() . 'module_streamingmanager_tags WHERE id = ?';
    $db->Execute($query, [$tagId]);

    $params['message'] = $this->Lang('SuccessTagDeleted');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}
