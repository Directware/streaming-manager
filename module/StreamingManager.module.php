<?php
if (!defined('CMS_VERSION')) exit;

class StreamingManager extends CMSModule
{
    public function GetName()
    {
        return 'StreamingManager';
    }

    public function GetFriendlyName()
    {
        return $this->Lang('friendlyName');
    }

    public function GetVersion()
    {
        return '1.0.0';
    }

    public function GetHelp()
    {
        return $this->Lang('helpText');
    }

    public function GetAuthor()
    {
        return 'Mateusz Klimentowicz';
    }

    public function GetAuthorEmail()
    {
        return 'mateusz@directware.de';
    }

    public function GetChangeLog()
    {
        return @file_get_contents(dirname(__FILE__) . '/changelog.inc');
    }

    public function IsPluginModule()
    {
        return true;
    }

    public function HasAdmin()
    {
        return true;
    }

    public function GetAdminSection()
    {
        return 'content';
    }

    public function GetAdminDescription()
    {
        return $this->Lang('moduleDescription');
    }

    public function VisibleToAdminUser()
    {
        return $this->CheckPermission('Manage_Streaming_Manager');
    }

    public function MinimumCMSVersion()
    {
        return '2.2.9';
    }

    public function InstallPostMessage()
    {
        $this->CreatePermission('Manage_Streaming_Manager');
        return $this->Lang('postinstall');
    }

    public function UninstallPostMessage()
    {
        $this->RemovePermission('Manage_Streaming_Manager');
        return $this->Lang('postuninstall');
    }

    public function GetDependencies()
    {
        return array();
    }

    function GetCurrentLanguageTranslations()
    {
        $translations = [];
        $currentLang = $this->GetPreference('default_cms_lang', 'en_US');
        $langFile = dirname(__FILE__) . "/lang/ext/{$currentLang}.php";

        if (file_exists($langFile)) {
            include $langFile;
        } else {
            include dirname(__FILE__) . "/lang/en_US.php";
        }

        $translations = $lang;

        return $translations;
    }

    public function GetVideosByTags($tagsAsString, $excludedTagsAsString)
    {
        $whereClause = "";

        if ($tagsAsString) {
            $tags = explode(',', $tagsAsString);
            $tags = array_map(function ($tag) {
                return trim($tag);
            }, $tags);

            $tags = array_map(function ($tag) {
                return "'" . $tag . "'";
            }, $tags);

            $tags = implode(',', $tags);

            $whereClause = 'WHERE t.name IN (' . $tags . ')';
        }

        if ($excludedTagsAsString) {
            $excludedTags = explode(',', $excludedTagsAsString);
            $excludedTags = array_map(function ($tag) {
                return trim($tag);
            }, $excludedTags);

            $excludedTags = array_map(function ($tag) {
                return "'" . $tag . "'";
            }, $excludedTags);

            $excludedTags = implode(',', $excludedTags);

            if (strlen($whereClause) == 0) {
                $whereClause .= 'WHERE ';
            } else {
                $whereClause .= ' AND ';
            }

            $whereClause .= 't.name NOT IN (' . $excludedTags . ')';
        }

        $db = cmsms()->GetDb();

        $videosQuery = 'SELECT 
            v.id AS id, 
            v.name AS name, 
            v.streamUrl, 
            v.description,
            t.id AS tagId, 
            t.name AS tagName,
            vtm.*,
            GROUP_CONCAT(t.name SEPARATOR ", ") AS tags
        FROM ' . cms_db_prefix() . 'module_streamingmanager_videos v
        JOIN ' . cms_db_prefix() . 'module_streamingmanager_tag_video_mapping vtm ON v.id = vtm.videoId
        JOIN ' . cms_db_prefix() . 'module_streamingmanager_tags t ON vtm.tagId = t.id 
        ' . $whereClause . '
        GROUP BY v.id';

        $videos = $db->GetArray($videosQuery);

        foreach ($videos as &$video) {
            $video['tags'] = explode(', ', $video['tags']);
        }

        return $videos;
    }
}
