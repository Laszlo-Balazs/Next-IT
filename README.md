# NextIT ChatBot Beállítási Útmutató
# Hírlevél Rendszer Beállítása

## Email Küldés Beállítása

A hírlevél rendszer működéséhez az alábbi beállítások szükségesek a szerveren:

1. Ellenőrizze, hogy a PHP `mail()` függvény engedélyezve van-e:
   - Nyissa meg a php.ini fájlt
   - Keresse meg a `[mail function]` szekciót
   - Ellenőrizze/állítsa be az alábbi értékeket:
     ```ini
     SMTP = localhost
     smtp_port = 25
     sendmail_path = "C:\xampp\sendmail\sendmail.exe -t"
     ```

2. Sendmail Beállítása:
   - Nyissa meg a `C:\xampp\sendmail\sendmail.ini` fájlt
   - Módosítsa az alábbi beállításokat:
     ```ini
     smtp_server=smtp.gmail.com
     smtp_port=587
     smtp_ssl=tls
     auth_username=az_on_email@gmail.com
     auth_password=az_on_jelszo
     force_sender=noreply@nextit.hu
     ```

3. Email Beállítások Tesztelése:
   - Próbáljon ki egy feliratkozást
   - Ellenőrizze a PHP error log fájlt hibák esetén
   - A sikeres email küldést a feliratkozó email címén ellenőrizheti

Megjegyzés: Gmail használata esetén:
- Engedélyezze a "Kevésbé biztonságos alkalmazások használatát" a Google Fiókban, vagy
- Használjon App-specifikus jelszót (ajánlott)

## Hibaelhárítás

Ha nem érkeznek meg az emailek:
1. Ellenőrizze a PHP hibanapló fájlt
2. Győződjön meg róla, hogy a sendmail szolgáltatás fut
3. Tesztelje az SMTP kapcsolatot: `telnet smtp.gmail.com 587`
4. Ellenőrizze a tűzfal beállításokat (25-ös és 587-es port)

## API Kulcs Beállítása

A chatbot működéséhez szükséges az OpenAI API kulcs beállítása. A kulcs biztonsági okokból a szerveroldalon van tárolva.

### Lépések:

1. Navigálj a `config` mappába
2. Nyisd meg az `api_config.php` fájlt
3. Keresd meg ezt a sort:
```php
define('OPENAI_API_KEY', 'ide-írd-be-az-api-kulcsot');
```
4. Cseréld ki az 'ide-írd-be-az-api-kulcsot' részt a saját OpenAI API kulcsoddal

### Fontos Tudnivalók:

- Az API kulcs biztonságos tárolása kritikus, soha ne tedd közzé vagy commitold verziókezelőbe
- Az `api_config.php` fájl csak a szerveroldalon érhető el, így a kulcs nem látható a kliensek számára
- A chatbot minden API hívást egy PHP proxy-n keresztül végez, ami biztosítja a kulcs védelmét

### Hibaelhárítás:

Ha a chatbot nem működik megfelelően:

1. Ellenőrizd, hogy az API kulcs helyesen van-e beállítva
2. Győződj meg róla, hogy a PHP szerver fut
3. Ellenőrizd, hogy a `curl` PHP modul engedélyezve van-e a szervereden

### Fájlok helye:

- API kulcs: `config/api_config.php`
- PHP proxy: `process/chat_proxy.php`
- Chatbot JavaScript: `js/chatbot.js`

### Megjegyzések:

- A chat_proxy.php automatikusan betölti az API kulcsot az api_config.php fájlból
- A JavaScript kód már úgy van beállítva, hogy a proxy-n keresztül kommunikáljon
