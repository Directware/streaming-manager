<?php
if (isset($_POST['submit_new_tag'])) {
    $tagName = trim($_POST['tag_name']);

    if ($tagName == '') {
        $params['error'] = $this->Lang('ErrorTagCannotBeEmpty');
        $this->Redirect($id, 'defaultadmin', $returnid, $params);
    } else {
        $query = 'SELECT COUNT(*) FROM ' . cms_db_prefix() . 'module_streamingmanager_tags WHERE name = ?';
        $exists = $db->GetOne($query, [$tagName]);

        if ($exists) {
            $params['error'] = $this->Lang('ErrorTagAlreadyExists');
            $this->Redirect($id, 'defaultadmin', $returnid, $params);
        } else {
            $query = 'INSERT INTO ' . cms_db_prefix() . 'module_streamingmanager_tags (name) VALUES (?)';
            $success = $db->Execute($query, [$tagName]);

            if (!$success) {
                $params['error'] = $db->ErrorMsg();
                $this->Redirect($id, 'defaultadmin', $returnid, $params);
            }

            $params['message'] = $this->Lang('SuccessTagAdded');
            $this->Redirect($id, 'defaultadmin', $returnid, $params);
        }
    }
}
