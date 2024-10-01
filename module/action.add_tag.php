<?php
if (isset($_POST['submit_new_tag'])) {
    $tagName = trim($_POST['tag_name']);

    if ($tagName == '') {
        $params['error'] = $this->Lang('Tag name cannot be empty');
        $this->Redirect($id, 'defaultadmin', $returnid, $params);
    } else {
        $query = 'SELECT COUNT(*) FROM ' . cms_db_prefix() . 'module_streamingmanager_tags WHERE name = ?';
        $exists = $db->GetOne($query, [$tagName]);

        if ($exists) {
            $params['error'] = $this->Lang('Tag already exists');
            $this->Redirect($id, 'defaultadmin', $returnid, $params);
        } else {
            $query = 'INSERT INTO ' . cms_db_prefix() . 'module_streamingmanager_tags (name) VALUES (?)';
            $db->Execute($query, [$tagName]);

            $params['message'] = $this->Lang('Tag successfully added');
            $this->Redirect($id, 'defaultadmin', $returnid, $params);
        }
    }
}
