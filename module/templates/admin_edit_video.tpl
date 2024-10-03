<style>
    #edit-video-form-wrapper > form {
        max-width: 500px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .title {
        margin: 0;
    }

    #video_name, #video_url, #video_description {
        width: 100%;
        margin: 0;
    }

    .tag-container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: start;
        align-items: center;
        padding: 0;
    }

    .tag-badge {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;

        background-color: #1e1f1f;
        color: white;

        padding: 4px 12px;
        margin: 0 4px 4px 0;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }
</style>

<h3 class="title">{$lang.editVideo}</h3>
<br/>

<div id="edit-video-form-wrapper">
<iframe 
    width="500px"
    height="300px" 
    src="{$video.streamUrl}" 
    title="{$video.name}" 
    frameborder="0" 
    referrerpolicy="strict-origin-when-cross-origin" 
    allowfullscreen>
</iframe>
<br/>
<br/>

{form_start action='update_video' method='post'}
    <input type="hidden" name="video_id" value="{$video.id}" />

    <label>{$lang.videoName}</label>
    <input type="text" name="video_name" id="video_name" value="{$video.name}" />
    <br/>

    <label>{$lang.videoStreamUrl}</label>
    <input type="text" name="video_url" id="video_url" value="{$video.streamUrl}"  />
    <br/>

    <label>{$lang.videoDescription}</label>
    <textarea name="video_description" id="video_description">{$video.description}</textarea>
    <br/>

    <label>{$lang.videoTags}</label>
    <div class="tag-container">
    {foreach from=$allTags item=tag}
        <span class="tag-badge">
            {$tag.name}
            <input type="checkbox" style="margin-left: 12px;"
                {foreach from=$assignedTags item=assigned}
                   {if $assigned.id == $tag.id}checked{/if}
               {/foreach}/>
        </span>
    {/foreach}
    </div>
    <br/>

    <input type="submit" name="submit_update_video" value="{$lang.save}" />
    <br/>
{form_end}
</div>