<?php
$lang['friendlyName'] = 'Streaming Manager';
$lang['postinstall'] = 'Streaming Manager module has been installed successfully.';
$lang['postuninstall'] = 'Streaming Manager module has been uninstalled successfully.';
$lang['moduleDescription'] = 'The "StreamingManager" module allows you to manage and display videos on your website that is hosted on streaming Platforms like YouTube. You can assign tags to videos and display them based on these tags using custom Smarty tags.';

$lang['helpText'] = <<<EOT
<h3>What does this module do?</h3>
<p>The "StreamingManager" module allows you to manage and display videos on your website that is hosted on streaming Platforms like YouTube. You can assign tags to videos and display them based on these tags using custom Smarty tags.</p>

<h3>How do I use it?</h3>
<p>To display videos based on tags, use the following custom Smarty tag:</p>
<code>
    {cms_module module=StreamingManager tags="YourTag, SomeOtherTag, FancyTag" excluded_tags="TagToExclude, AnotherTagToExclude"}
</code>

<br/>
<br/>
<p>Available parameters:</p>
<ul>
    <li><strong>tags:</strong> A comma-separated list of tag names. Only videos with these tags will be displayed (optional).</li>
    <li><strong>excluded_tags:</strong> A comma-separated list of tag names. Videos with these tags will be excluded (optional).</li>
    <li><strong>width:</strong> The width of the video player (optional). Example: width="400"</li>
    <li><strong>height:</strong> The height of the video player (optional). Example: height="300"</li>
</ul>
EOT;

// Template translations
$lang['confirm'] = 'Are you sure you want to do this action?';
$lang['delete'] = 'Delete';
$lang['edit'] = 'Edit';
$lang['save'] = 'Save';
$lang['cancel'] = 'Cancel';
$lang['addNewTag'] = 'Add New Tag';
$lang['inputTagName'] = 'Type your new tag name...';
$lang['addTag'] = 'Add Tag';
$lang['yourTags'] = 'Your tags';
$lang['addNewVideo'] = 'Add new video';
$lang['editVideo'] = 'Edit video';
$lang['videoName'] = 'Video name';
$lang['videoId'] = 'Video ID';
$lang['videoDescription'] = 'Video description';
$lang['videoStreamUrl'] = 'Video stream URL';
$lang['videoTags'] = 'Tags';
$lang['yourVideos'] = 'Your videos';
$lang['noVideosYet'] = 'No videos yet.';

// Error messages
$lang['ErrorTagCannotBeEmpty'] = 'Tag cannot be empty.';
$lang['ErrorTagAlreadyExists'] = 'Tag already exists.';
$lang['ErrorVideoNotAdded'] = 'Video not added. Please fill all fields.';
$lang['ErrorVideoIdNotProvided'] = 'Video ID not provided.';
$lang['ErrorTagIdNotProvided'] = 'Tag ID not provided.';
$lang['ErrorTagCannotBeDeleted'] = 'Tag cannot be deleted. There are videos associated with this tag.';
$lang['ErrorVideoNotFound'] = 'Video not found.';
$lang['videoNameMissing'] = 'Video name is missing.';
$lang['videoStreamUrlMissing'] = 'Video stream URL is missing.';
$lang['videoTagsMissing'] = 'Video tags are missing.';

// Success messages
$lang['SuccessTagAdded'] = 'Tag added successfully.';
$lang['VideoSuccessfullyAdded'] = 'Video added successfully.';
$lang['SuccessVideoDeleted'] = 'Video deleted successfully.';
$lang['SuccessTagDeleted'] = 'Tag deleted successfully.';
$lang['SuccessVideoUpdated'] = 'Video updated successfully.';
