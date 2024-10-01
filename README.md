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

Öffne im Browser http://localhost:8080 und folge dem CMSMS-Installationsprozess.
Stelle sicher, dass die Datenbankverbindungsparameter mit der Konfiguration in docker-compose.yml übereinstimmen:

Host: cmsms-db
Datenbankname: cmsms_db
Benutzername: cmsms_user
Passwort: cmsms_password
