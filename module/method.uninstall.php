<?php
if (!defined('CMS_VERSION')) exit;

$db = cmsms()->GetDb();

if (!$db) {
    die('Error: Could not establish database connection.');
}

try {
    $query = "DROP TABLE IF EXISTS " . cms_db_prefix() . "module_streamingmanager_tag_video_mapping";
    $db->Execute($query);

    $query = "DROP TABLE IF EXISTS " . cms_db_prefix() . "module_streamingmanager_videos";
    $db->Execute($query);

    $query = "DROP TABLE IF EXISTS " . cms_db_prefix() . "module_streamingmanager_tags";
    $db->Execute($query);

    $this->RemovePreference();
} catch (Exception $e) {
    error_log("Error while uninstalling module: " . $e->getMessage());
}
