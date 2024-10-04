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
    }

    .stream-manager-video-card .title {
        margin: 0;
        font-size: 14px;
        font-weight: 500;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="stream-manager-video-list">
{foreach from=$videos item=video}
    <div class="stream-manager-video-card">
        <iframe 
            width="300" 
            height="185" 
            src="{$video.streamUrl}" 
            title="{$video.name}" 
            frameborder="0" 
            referrerpolicy="strict-origin-when-cross-origin" 
            allowfullscreen>
        </iframe>
        <p class="title">{$video.name}</p>
    </div>
{/foreach}
</div>