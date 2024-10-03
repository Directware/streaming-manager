#!/bin/bash

output_file="seed-insert_statements.sql"

if [ -f "$output_file" ]; then
    rm "$output_file"
fi

tagCount=10
videoCount=400

# Generate TAGS
for (( i=1; i<=tagCount; i++ ))
do
    echo "INSERT INTO cms_module_streamingmanager_tags (id, name) VALUES ('$i', 'Tag $i');" >> "$output_file"
done

# Generate Videos
for (( i=1; i<=$videoCount; i++ ))
do
    echo "INSERT INTO cms_module_streamingmanager_videos (id, name, streamUrl, description) VALUES ('$i', 'Video $i', 'https://www.youtube.com/embed/JhA9-JYLFyo', 'Description $i');" >> "$output_file"
done

# Generate Video Tags
for (( i=1; i<=$videoCount; i++ ))
do
    for (( j=1; j<=tagCount; j++ ))
    do
        echo "INSERT INTO cms_module_streamingmanager_tag_video_mapping (videoId, tagId) VALUES ('$i', '$j');" >> "$output_file"
    done
done

echo "SQL Statements saved to $output_file"
