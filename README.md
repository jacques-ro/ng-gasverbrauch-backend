# Entwicklungsumgebung aufsetzen

Die bevorzugte Entwicklungsumgebung für das Projekt ist VS Code. Sinnvolle Erweiterungen sind in der .vscode/extensions.json Datei hinterlegt und sollten beim ersten Laden des Projekts installiert werden.

Die gesamte Entwicklungsumgebung sollte gemeinsam mit Docker verwendet werden.

Das Projekt nutzt composer als package manager. Der einfachste Weg, composer zu nutzen, ohne eine lokale PHP Umgebung aufzusetzen, ist die Nutzung des Docker images.

# Laufzeitumgebung aufsetzen

Die aus dem repository heraus unterstützte Laufzeitumgebung basiert auf docker und nutzt docker-compose um die gesamte Infrastruktur hochzufahren, dazu gehören

- apache
- php
- mysql
- phpmyadmin

Damit die Umgebung funktioniert, muss eine `.env` Datei im Stammverzeichnis des Repositories angelegt werden, die benutzerspezifische Werte für folgende Variablen beinhalten muss (WWW_ROOT bitte nicht verändern):

```text
APACHE_PORT=
APACHE_SSL_PORT=
PHPMYADMIN_PORT=
PHPMYADMIN_SSL_PORT=
MYSQL_USER=
MYSQL_PASSWORD=
WWW_ROOT=./
```

`.env` Dateien sind in der .gitignore Datei ausgeschlossen, damit sensible Daten - wenn auch nur lokale - nicht im Repository landen können.

# Debuggen mit VS Code

In .vscode/launch.json sollte folgende Konfiguration hinterlegt sein:

```json
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9000,
            "pathMappings": {
                "/app": "${workspaceFolder}"
            }
        }
    ]
}
```

Mit dieser Konfiguration kann man den Debugger an eine laufende Instanz der Website hängen, wenn sie per docker-compose hochgefahren wurde.

>ACHTUNG: Bitte darauf achten, dass der Port 9000 frei ist. Ansonsten kann dieser in der launch Konfiguration und in `docker/data/php/php.ini` unter xdebug.client_port=xxxx entsprechend angepasst werden.



# Slim Framework 4 Skeleton Application

[![Coverage Status](https://coveralls.io/repos/github/slimphp/Slim-Skeleton/badge.svg?branch=master)](https://coveralls.io/github/slimphp/Slim-Skeleton?branch=master)

Use this skeleton application to quickly setup and start working on a new Slim Framework 4 application. This application uses the latest Slim 4 with Slim PSR-7 implementation and PHP-DI container implementation. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application. You will require PHP 7.4 or newer.

```bash
composer create-project slim/slim-skeleton [my-app-name]
```

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writable.

To run the application in development, you can run these commands

```bash
cd [my-app-name]
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
cd [my-app-name]
docker-compose up -d
```
After that, open `http://localhost:9000` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

That's it! Now go build something cool.
