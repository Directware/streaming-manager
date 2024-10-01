<style>
    .tag-badge {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        background-color: #1e1f1f;
        color: white;

        padding: 5px 10px;
        margin: 0 4px 4px 0;
        border-radius: 15px;
        font-size: 14px;
    }

    .tag-container {
        display: flex;
        flex-direction: row;
        justify-content: start;
        align-items: center;
        padding: 10px 0;
    }

    .title {
        margin: 0;
    }
</style>

<h3 class="title">Your tags:</h3>

<div class="tag-container">
    {foreach from=$tags item=tag}
        <span class="tag-badge">{$tag.name}</span>
    {/foreach}
</div>
