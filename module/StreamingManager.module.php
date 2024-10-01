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
        return $this->Lang('StreamingManager');
    }

    public function GetVersion()
    {
        return '1.0.0';
    }

    public function GetHelp()
    {
        return $this->Lang('help_text');
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
        return $this->Lang('changelog_text');
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
        return $this->Lang('module_description');
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
        return $this->Lang('uninstall_postmessage');
    }

    public function GetDependencies()
    {
        return array();
    }
}
