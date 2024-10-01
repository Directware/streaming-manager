#!/bin/bash

SOURCE_DIR="module"
CACHE_DIR="cmsms-data/tmp/cache"
TARGET_DIR="cmsms-data/modules/StreamingManager"

# check if source directory exists
if [ ! -d "$SOURCE_DIR" ]; then
  echo "Fehler: Der Quellordner '$SOURCE_DIR' existiert nicht."
  exit 1
fi

# create target directory
mkdir -p "$TARGET_DIR"

# delete not needed files
rm -rf "$TARGET_DIR"/*
rm -rf "$CACHE_DIR"/*

# start copy
echo "Kopiere $SOURCE_DIR nach $TARGET_DIR..."
cp -r "$SOURCE_DIR"/* "$TARGET_DIR"

# check if copy was successful
if [ $? -eq 0 ]; then
  echo "Der Ordner wurde erfolgreich nach '$TARGET_DIR' kopiert."
else
  echo "Fehler beim Kopieren des Ordners nach '$TARGET_DIR'."
  exit 1
fi
