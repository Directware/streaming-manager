<style>
    #tag_name {
        min-width: 250px;
    }

    .title {
        margin: 0;
    }
</style>

<h3 class="title">Add new tag:</h3>

{form_start action='add_tag' method='post'}
    <input type="text" name="tag_name" id="tag_name" placeholder="Type your new tag name..." />
    <input type="submit" name="submit_new_tag" value="Add Tag" />
{form_end}