<?php
if (!defined('CMS_VERSION')) exit;

$db = $this->GetDb();

if (!$db) {
    die('Error: Could not establish database connection.');
}

try {
    $query = "CREATE TABLE IF NOT EXISTS " . cms_db_prefix() . "module_streamingmanager_videos (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name TEXT NOT NULL,
        streamUrl TEXT NOT NULL,
        description TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $db->Execute($query);

    $query = "CREATE TABLE IF NOT EXISTS " . cms_db_prefix() . "module_streamingmanager_tags (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name TEXT NOT NULL UNIQUE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $db->Execute($query);

    $query = "CREATE TABLE IF NOT EXISTS " . cms_db_prefix() . "module_streamingmanager_tag_video_mapping (
        videoId INT(11) NOT NULL,
        tagId INT(11) NOT NULL,
        PRIMARY KEY (videoId, tagId),
        FOREIGN KEY (videoId) REFERENCES " . cms_db_prefix() . "module_streamingmanager_videos(id) ON DELETE CASCADE,
        FOREIGN KEY (tagId) REFERENCES " . cms_db_prefix() . "module_streamingmanager_tags(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $db->Execute($query);

    $query = "CREATE INDEX idx_videoid ON " . cms_db_prefix() . "module_streamingmanager_tag_video_mapping (videoId)";
    $db->Execute($query);

    $query = "CREATE INDEX idx_tagid ON " . cms_db_prefix() . "module_streamingmanager_tag_video_mapping (tagId)";
    $db->Execute($query);

    $this->SetPreference('installed_version', $this->GetVersion());
} catch (Exception $e) {
    error_log("Error while installing module: " . $e->getMessage());
}
