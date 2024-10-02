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
        return '2.2.2';
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

    public function GetVideosByTags($tagsAsString)
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

        $db = cmsms()->GetDb();
        $videosQuery = 'SELECT 
            v.id AS videoId, 
            v.name AS videoName, 
            v.streamUrl, 
            v.description,
            t.id AS tagId, 
            t.name AS tagName,
            vtm.*
        FROM ' . cms_db_prefix() . 'module_streamingmanager_videos v
        JOIN ' . cms_db_prefix() . 'module_streamingmanager_tag_video_mapping vtm ON v.id = vtm.videoId
        JOIN ' . cms_db_prefix() . 'module_streamingmanager_tags t ON vtm.tagId = t.id
        ' . $whereClause;

        $redundantVideos = $db->GetArray($videosQuery);

        $videosWithTags = [];
        foreach ($redundantVideos as $vid) {
            $videoId = $vid['videoId'];

            if (!isset($videosWithTags[$videoId])) {
                $videosWithTags[$videoId] = [
                    'id' => $videoId,
                    'name' => $vid['videoName'],
                    'description' => $vid['description'],
                    'streamUrl' => $vid['streamUrl'],
                    'tags' => []
                ];
            }

            $videosWithTags[$videoId]['tags'][] = $vid['tagName'];
        }

        return $videosWithTags;
    }
}
