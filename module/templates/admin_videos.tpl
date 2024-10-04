<style>
    #video-table td {
        vertical-align: top;
        border-top: 1px solid rgba(0,0,0,0.2);
        padding: 4px 8px;
    }

    .submit-remove-video {
        background: #dc3545; 
        border-color: #dc3545;
        color: #000;
        font-weight: 500;
    }

    .submit-remove-video .ui-icon {
        display: none;
    }

    .submit-remove-video .ui-button-text {
        padding: 4px 12px;
    }

    .submit-remove-video:hover {
        color: #fff;
    }
</style>
<h3 class="title">{$lang.yourVideos} ({count($videos)}):</h3>

<table id="video-table" class="pagetable">
    <thead>
        <tr>
            <th style="width: 50px;">{$lang.videoId}</th>
            <th style="width: 200px;">{$lang.videoName}</th>
            <th style="width: 300px">{$lang.videoDescription}</th>
            <th style="width: auto;">{$lang.videoStreamUrl}</th>
            <th style="width: 300px;">{$lang.videoTags}</th>
            <th style="width: 150px;"></th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$videos item=video}
        <tr>
            <td>{$video.id}</td>
            <td>{$video.name}</td>
            <td>{$video.description}</td>
            <td>{$video.streamUrl}</td>
            <td>
                <div class="tag-container" style="padding: 0;">
                {foreach from=$video.tags item=tag}
                    <span class="tag-badge">{$tag}</span>
                {/foreach}
                </div>
            </td>
            <td>
            {form_start action='edit_video' method='post'}
                <input type="hidden" name="video_id" value="{$video.id}" />
                <input type="submit" name="submit_edit_video" value="{$lang.edit}"/>
            {form_end}
            {form_start action='delete_video' method='post'}
                <input type="hidden" name="video_id" value="{$video.id}" />
                <input type="submit" name="submit_remove_video" value="{$lang.delete}" onclick="return confirm('{$lang.confirm}');" class="submit-remove-video" />
            {form_end}
            </td>
        </tr>
    {/foreach}

    {if $videos|@count == 0}
        <tr><td colspan="5" style="text-align: center;padding: 16px 0;">{$lang.noVideosYet}</td></tr>
    {/if}
    </tbody>
</table>
