<style>
    .stream-manager-video-list {
        display: flex; 
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: center;
        gap: 12px 4px;
    }

    .stream-manager-video-card {
        margin: 0px;
        border: 1px solid #ddd;
        padding: 4px;
        border-radius: 4px;
    }

    .stream-manager-video-card .title {
        font-family: 'Oswald', sans-serif;
        margin: 0;
        font-size: 14px;
        font-weight: 500;

        margin: 10px 0;
        padding: 0 9px;
    }
</style>

<div class="stream-manager-video-list">
{foreach from=$videos item=video}
    <div class="stream-manager-video-card" style="width:{$width|default:300}px;">
        {if $video.streamUrl|startswith:"https://"}
            <iframe 
                width="{$width|default:300}" 
                height="{$height|default:185}" 
                src="{$video.streamUrl}" 
                title="{$video.name}" 
                frameborder="0" 
                referrerpolicy="strict-origin-when-cross-origin" 
                allowfullscreen>
            </iframe>
        {else}
            <video 
                width="{$width|default:300}" 
                height="{$height|default:185}" 
                controls 
                controlsList="nodownload">
                <source src="{$video.streamUrl}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        {/if}
        <h5 class="title" title="{$video.name}" style="max-width: {$width|default:300}px;">
            <a href="#">{$video.name}</a>
        </h5>
    </div>
{/foreach}
</div>