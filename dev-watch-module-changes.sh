#!/bin/bash
SOURCE_DIR="module"
TARGET_DIR="cmsms-data/modules/StreamingManager"

# check if source directory exists
if [ ! -d "$SOURCE_DIR" ]; then
  echo "Fehler: Der Quellordner '$SOURCE_DIR' existiert nicht."
  exit 1
fi

# create target directory
mkdir -p "$TARGET_DIR"

# Initialer Hash-Wert des Verzeichnisses
last_checksum=$(find "$SOURCE_DIR" -type f -exec md5sum {} \; | md5sum)

echo "Starte Überwachung des Verzeichnisses '$SOURCE_DIR'..."

while true; do
    # Berechnet den aktuellen Hash-Wert
    current_checksum=$(find "$SOURCE_DIR" -type f -exec md5sum {} \; | md5sum)

    # Prüft, ob sich die Prüfsumme geändert hat
    if [[ $current_checksum != $last_checksum ]]; then
        timestamp=$(date +%s)
        echo "$timestamp Änderung im Verzeichnis festgestellt!"
        last_checksum=$current_checksum

        # delete not needed files
        rm -rf "$TARGET_DIR"/*

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
    fi

    # Pause zwischen den Überprüfungen
    sleep 0.5
done
