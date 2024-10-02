<style>
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

    .tag-container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: start;
        align-items: center;
        padding: 10px 0;
    }

    .title {
        margin: 0;
    }

    .tag-badge .tag-delete-trigger {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white; 
        background: red; 
        width: 14px; 
        height: 14px; 
        font-size: 12px;
        border-radius: 50%;
        margin:  0 0 0 12px;
        cursor: pointer;
    }
</style>

<script>
    function submitDeleteTagForm(form) {
        const result = confirm('{$lang.confirm}');

        if(result) {
            form.submit();
        }
    }
</script>

<h3 class="title">{$lang.yourTags} ({count($tags)})</h3>

<div class="tag-container">
    {foreach from=$tags item=tag}
        <span class="tag-badge">
        {$tag.name}

        {form_start action='delete_tag' method='post'}
            <input type="hidden" name="tag_id" value="{$tag.id}" />
            <input type="hidden" name="submit_delete_tag" value="true" />
            <span onclick="submitDeleteTagForm(this.parentElement)" class="tag-delete-trigger">&#9932;</span>
        {form_end}
        </span>
    {/foreach}
</div>
