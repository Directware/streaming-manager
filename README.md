## Schritte zur Einrichtung:

### CMSMS-Dateien in ./cmsms-data ablegen:

Lade die CMSMS-Installationsdateien herunter und extrahiere sie in das Verzeichnis ./cmsms-data.
Das Verzeichnis sollte mindestens die CMSMS-Dateien install.php enthalten.

```bash
sudo chmod -R 777 ./cmsms-data
```

### Docker-Container starten:

```bash
docker-compose build
docker-compose up -d
```
### Installation starten:

Öffne im Browser http://localhost und folge dem CMSMS-Installationsprozess. Stelle sicher, dass die Datenbankverbindungsparameter mit der Konfiguration in docker-compose.yml übereinstimmen:

```properties
Host: streaming-manager-db
Datenbankname: cmsms_db
Benutzername: cmsms_user
Passwort: cmsms_password
```

### Entwicklung:

Starte das script `dev-watch-module-changes.sh` damit deine Änderungen sofort sichtbar werden. 

## Manuelle bereinigung der Datenbank

```SQL
DELETE FROM cms_modules WHERE module_name = 'StreamingManager';
DELETE FROM cms_module_templates WHERE module_name = 'StreamingManager';
drop table if exists cms_module_streamingmanager_tag_video_mapping cascade;
drop table if exists cms_module_streamingmanager_tags cascade;
drop table if exists cms_module_streamingmanager_videos cascade;
```