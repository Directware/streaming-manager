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
    $successVideosTable = $db->Execute($query);

    if (!$successVideosTable) {
        die($db->ErrorMsg());
    }

    $query = "CREATE TABLE IF NOT EXISTS " . cms_db_prefix() . "module_streamingmanager_tags (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL UNIQUE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $successTagsTable = $db->Execute($query);

    if (!$successTagsTable) {
        die($db->ErrorMsg());
    }

    $query = "CREATE TABLE IF NOT EXISTS " . cms_db_prefix() . "module_streamingmanager_tag_video_mapping (
        videoId INT(11) NOT NULL,
        tagId INT(11) NOT NULL,
        PRIMARY KEY (videoId, tagId),
        FOREIGN KEY (videoId) REFERENCES " . cms_db_prefix() . "module_streamingmanager_videos(id) ON DELETE CASCADE,
        FOREIGN KEY (tagId) REFERENCES " . cms_db_prefix() . "module_streamingmanager_tags(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $successMappingTable = $db->Execute($query);

    if (!$successMappingTable) {
        die($db->ErrorMsg());
    }

    $query = "CREATE INDEX idx_videoid ON " . cms_db_prefix() . "module_streamingmanager_tag_video_mapping (videoId)";
    $successVideoIdMappingIdx = $db->Execute($query);

    if (!$successVideoIdMappingIdx) {
        die($db->ErrorMsg());
    }

    $query = "CREATE INDEX idx_tagid ON " . cms_db_prefix() . "module_streamingmanager_tag_video_mapping (tagId)";
    $successTagIdMappingIdx = $db->Execute($query);

    if (!$successTagIdMappingIdx) {
        die($db->ErrorMsg());
    }

    $this->SetPreference('installed_version', $this->GetVersion());
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
