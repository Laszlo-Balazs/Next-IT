# NextIT ChatBot Beállítási Útmutató

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
- Nincs szükség további módosításokra a frontend oldalon
