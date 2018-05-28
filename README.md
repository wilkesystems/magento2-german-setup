# Magento 2 German Setup

Deutsches Setup für die Magento 2 Community Edition
Das Paket installiert den Shop für den deutschen Markt.

Folgende Sprachen werden unterstützt:

* Austria (at)
* Switzerland (ch)
* Germany (de)
* Spain (es)
* France (fr)
* United Kingdom (gb)
* Italy (it)
* Netherlands (nl)
* Poland (pl)
* Romania (ro)
* Russia (ru).

Installation
------------

### Manually

Erstelle einen Ordner app/code/WilkeSystems/MageGermanSetup
und kopiere alle Dateien in den Ordner.

Danach starte alle folgenden Befehle in der Shell:

```
bin/magento module:enable WilkeSystems_MageGermanSetup
bin/magento setup:upgrade
bin/magento magesetup:setup:run <countrycode>
```

### Via composer (recommended)

Gehe in das Magento2 root Verzeichnis und führe folgende Befehle aus:

```
composer require wilkesystems/magento2-german-setup:dev-master
bin/magento module:enable WilkeSystems_MageGermanSetup
bin/magento setup:upgrade
bin/magento magesetup:setup:run <countrycode>
```
