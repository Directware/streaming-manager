<style>
    .new-video-form-wrapper > form {
        display: flex;
        flex-direction: row;
    }

    .title {
        margin: 0;
    }

    #video_name, #video_url, #video_description, #video_tags {
        width: 100%;
        min-width: 450px;
        margin: 0 0 8px 0;
    }
</style>

<script>
    function validateVideoCreateForm() {
        const videoName = document.getElementById("video_name").value;
        const videoUrl = document.getElementById("video_url").value;
        const videoTags = document.getElementById("video_tags").value;

        if(!videoName) {
            alert("{$lang.videoNameMissing}");
            return false;
        }

        if(!videoUrl) {
            alert("{$lang.videoStreamUrlMissing}");
            return false;
        }

        if(!videoTags) {
            alert("{$lang.videoTagsMissing}");
            return false;
        }
    }
</script>

<h3 class="title">{$lang.addNewVideo}</h3>

<div class="new-video-form-wrapper">
{form_start action='add_video' method='post'}
    <div style="display: flex; flex-direction: column; justify-content: flex-start; align-items: flex-start;">
        <label>Infos</label>
        <input type="text" name="video_name" id="video_name" placeholder="{$lang.videoName}*" />
        <input type="text" name="video_url" id="video_url" placeholder="{$lang.videoStreamUrl}*" />
        <input type="text" name="video_description" id="video_description" placeholder="{$lang.videoDescription}" />
    </div>

    <div style="display: flex; flex-direction: column; justify-content: flex-start; align-items: flex-start; margin-left: 20px;">
        <label>Tags*</label>
        <select id="video_tags" style="min-width: 300px" name="video_tag_ids[]" multiple="multiple" size="5">
            {foreach from=$tags item=tag}
            <option value="{$tag.id}">{$tag.name}</option>
            {/foreach}
        </select>
    </div>

    <input type="submit" name="submit_new_video" onclick="return validateVideoCreateForm()" style="margin: 20px 0 0 8px;" value="{$lang.addNewVideo}" />
{form_end}
</div>