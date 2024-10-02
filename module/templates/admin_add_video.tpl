<style>
    .new-video-form-wrapper > form {
        display: flex;
        flex-direction: row;
    }

    .title {
        margin: 0;
    }

    #video_name, #video_url, #video_description {
        width: 100%;
        min-width: 250px;
    }

    #video_tags {
        margin: 0 12px;
        min-width: 220px;
    }
</style>

<h3 class="title">{$lang.addNewVideo}</h3>

<div class="new-video-form-wrapper">
{form_start action='add_video' method='post'}
    <div style="display: flex; flex-direction: column; justify-content: flex-start; align-items: center;">
        <input type="text" name="video_name" id="video_name" placeholder="{$lang.videoName}" />
        <input type="text" name="video_url" id="video_url" placeholder="{$lang.videoStreamUrl}" />
        <input type="text" name="video_description" id="video_description" placeholder="{$lang.videoDescription}" />
    </div>

    <select id="video_tags" name="video_tag_ids[]" multiple="multiple" size="5">
        {foreach from=$tags item=tag}
        <option value="{$tag.id}">{$tag.name}</option>
        {/foreach}
    </select>

    <input type="submit" name="submit_new_video" value="{$lang.addNewVideo}" />
{form_end}
</div>