<?php
if (!isset($gCms)) exit;

$db = cmsms()->GetDb();

if (isset($params['message'])) {
    echo $this->ShowMessage($params['message']);
}
if (isset($params['error'])) {
    echo $this->ShowErrors($params['error']);
}

$query = 'SELECT id, name FROM ' . cms_db_prefix() . 'module_streamingmanager_tags ORDER BY name ASC';
$tags = $db->GetArray($query);

$smarty->assign('tags', $tags);

echo $this->ProcessTemplate('admin_tags.tpl');

echo $this->ProcessTemplate('admin_add_tag.tpl');
