CREATE DATABASE IF NOT EXISTS nextit_db;
USE nextit_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    admin TINYINT(1) DEFAULT 0 COMMENT 'Admin jogosultság: 0=nem admin, 1=admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255) NOT NULL,
    avatar_path VARCHAR(255),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    thumbnail_path VARCHAR(255),
    author_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES authors(id)
);

CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (email, password, admin) VALUES 
('admin@nextit.com', '$2y$10$92ZkKBrEk6/DxWU.J4qI8OVtTlRQUPdALBxixnZRrLMcpD0n0LTXK', 1);

INSERT INTO authors (user_id, name, avatar_path, bio) VALUES
(1, 'Nagy Éva', 'images/avatar.png', 'Senior szoftvermérnök több éves tapasztalattal az IT oktatás területén.'),
(NULL, 'Horváth Anna', 'images/avatar2-min.png', 'Frontend fejlesztő és UX specialista, aki szívesen osztja meg tudását másokkal.'),
(NULL, 'Kiss Tamás', 'images/Ellipse-min.png', 'Full-stack fejlesztő, aki szeretné megkönnyíteni az IT pályaválasztást.'),
(NULL, 'Szabó Péter', 'images/Ellipse2-min.png', 'IT oktató és mentor, aki segít eligazodni a technológiák világában.');

INSERT INTO blog_posts (title, content, thumbnail_path, author_id) VALUES
('Hogyan kezdj el programozni?', 
'<div class="rich-text-content">
<h2>Az első lépések a programozás világában</h2>

<p>A programozás tanulása első ránézésre ijesztőnek tűnhet, de megfelelő útmutatással és szisztematikus megközelítéssel bárki elsajátíthatja az alapokat. Ebben a cikkben végigvezetünk azokon a lépéseken, amelyekkel sikeresen elindulhatsz a programozás útján.</p>

<h3>1. Válassz egy programozási nyelvet</h3>
<p>Kezdőként érdemes olyan nyelvet választani, amely könnyen tanulható és széles körben használt. A Python kiváló választás lehet, mert:</p>
<ul>
    <li>Egyszerű, olvasható szintaxissal rendelkezik</li>
    <li>Hatalmas fejlesztői közösséggel bír</li>
    <li>Rengeteg ingyenes oktatóanyag érhető el hozzá</li>
    <li>Sokoldalúan használható (webfejlesztés, adatelemzés, AI)</li>
</ul>

<h3>2. Szerezd be a szükséges eszközöket</h3>
<p>A programozáshoz nem kell drága eszközökbe befektetned. Kezdéshez szükséged lesz:</p>
<ul>
    <li>Egy megbízható számítógépre</li>
    <li>Kódszerkesztőre (pl. Visual Studio Code)</li>
    <li>A választott programozási nyelv fejlesztői környezetére</li>
</ul>

<h3>3. Kezdd az alapokkal</h3>
<p>Ne próbálj meg mindent egyszerre megtanulni. Koncentrálj az alapvető koncepciókra:</p>
<ul>
    <li>Változók és adattípusok</li>
    <li>Vezérlési szerkezetek (if-else, ciklusok)</li>
    <li>Függvények és modulok</li>
    <li>Alapvető algoritmusok</li>
</ul>

<h3>4. Gyakorolj rendszeresen</h3>
<p>A programozás olyan, mint egy új nyelv tanulása - rendszeres gyakorlást igényel. Néhány tipp a hatékony tanuláshoz:</p>
<ul>
    <li>Tűzz ki napi tanulási célokat</li>
    <li>Dolgozz kis projekteken</li>
    <li>Használj online gyakorló platformokat</li>
    <li>Csatlakozz programozó közösségekhez</li>
</ul>

<h3>5. Ne félj a hibáktól</h3>
<p>A hibák a tanulási folyamat természetes részei. Minden hiba lehetőség a fejlődésre és a mélyebb megértésre. Ne csüggedj, ha valami elsőre nem sikerül!</p>

<h2>Következő lépések</h2>
<p>Ha már elsajátítottad az alapokat, fokozatosan haladhatsz bonyolultabb témák felé. Érdemes lehet:</p>
<ul>
    <li>Objektumorientált programozással foglalkozni</li>
    <li>Verziókezelést tanulni (Git)</li>
    <li>Webfejlesztési alapokkal megismerkedni</li>
    <li>Kis projekteken dolgozni, amelyek motiválnak</li>
</ul>

<p>Ne feledd: mindenki kezdőként indult! A kulcs a kitartás és a folyamatos tanulás iránti elkötelezettség.</p>
</div>', 
'images/Group-19.jpg', 1),

('Frontend vagy Backend?', 
'<div class="rich-text-content">
<h2>Frontend vs Backend Fejlesztés: Melyiket Válaszd?</h2>

<p>Az IT világában gyakran felmerülő kérdés: frontend vagy backend fejlesztéssel érdemes foglalkozni? Ebben a cikkben részletesen áttekintjük mindkét terület sajátosságait, hogy segítsünk a döntésben.</p>

<h3>Frontend Fejlesztés</h3>

<h4>Mit csinál egy frontend fejlesztő?</h4>
<p>A frontend fejlesztők felelősek azért, amit a felhasználók látnak és amivel közvetlenül interakcióba lépnek a weboldalon vagy alkalmazásban.</p>

<h4>Főbb technológiák:</h4>
<ul>
    <li>HTML5 - A weboldalak strukturális alapja</li>
    <li>CSS3 - Stílusok és dizájn megvalósítása</li>
    <li>JavaScript - Interaktivitás és dinamikus funkciók</li>
    <li>Frontend keretrendszerek (React, Vue.js, Angular)</li>
</ul>

<h4>Előnyök:</h4>
<ul>
    <li>Vizuális eredmények - Azonnal látod a munkád gyümölcsét</li>
    <li>Kreatív munka - Design és funkcionalitás ötvözése</li>
    <li>Gyors fejlődés - Új technológiák és trendek</li>
    <li>Magas kereslet a piacon</li>
</ul>

<h3>Backend Fejlesztés</h3>

<h4>Mit csinál egy backend fejlesztő?</h4>
<p>A backend fejlesztők a "motorháztetőt" építik: szerveroldali logika, adatbázisok, API-k és a teljes háttérrendszer.</p>

<h4>Főbb technológiák:</h4>
<ul>
    <li>Szerveroldali nyelvek (PHP, Python, Java, Node.js)</li>
    <li>Adatbázisok (MySQL, PostgreSQL, MongoDB)</li>
    <li>API fejlesztés és szerverarchitektúra</li>
    <li>Biztonság és teljesítményoptimalizálás</li>
</ul>

<h4>Előnyök:</h4>
<ul>
    <li>Komplex problémamegoldás</li>
    <li>Skálázható rendszerek építése</li>
    <li>Stabil, hosszú távú technológiák</li>
    <li>Magas fizetési potenciál</li>
</ul>

<h3>Melyiket válaszd?</h3>

<h4>Válaszd a Frontendet, ha:</h4>
<ul>
    <li>Szereted a vizuális alkotást</li>
    <li>Fontos számodra a közvetlen visszajelzés</li>
    <li>Érdekel a felhasználói élmény</li>
    <li>Gyorsan szeretnél látható eredményeket elérni</li>
</ul>

<h4>Válaszd a Backendet, ha:</h4>
<ul>
    <li>Szereted a logikai kihívásokat</li>
    <li>Érdekel a rendszerek működése</li>
    <li>Fontos számodra a biztonság és teljesítmény</li>
    <li>Szívesen dolgozol komplex adatstruktúrákkal</li>
</ul>

<h3>Full-stack fejlesztés: A legjobb mindkét világból?</h3>
<p>Sokan választják a full-stack utat, ami mindkét területet magába foglalja. Ez nagyobb rálátást biztosít a teljes fejlesztési folyamatra, de több tanulást és szélesebb körű tudást igényel.</p>

<h2>Összegzés</h2>
<p>Nincs rossz választás - mindkét terület izgalmas kihívásokat és remek karrierlehetőségeket kínál. A döntésnél vedd figyelembe:</p>
<ul>
    <li>Személyes érdeklődésedet</li>
    <li>Erősségeidet és készségeidet</li>
    <li>A helyi munkaerőpiaci igényeket</li>
    <li>Hosszú távú karriercéljaidat</li>
</ul>
</div>', 
'images/photo-1-min.jpg', 2),

('Az IT képzések típusai', 
'<div class="rich-text-content">
<h2>IT Képzések: Útmutató a Választáshoz</h2>

<p>Napjainkban számtalan lehetőség közül választhatunk, ha IT képzést keresünk. Ebben a cikkben áttekintjük a különböző képzési formákat, azok előnyeit és hátrányait, hogy megalapozott döntést hozhass.</p>

<h3>1. Bootcamp képzések</h3>

<h4>Jellemzők:</h4>
<ul>
    <li>Intenzív, 3-6 hónapos programok</li>
    <li>Gyakorlatorientált megközelítés</li>
    <li>Modern technológiák és eszközök</li>
    <li>Karriertámogatás és álláskeresési segítség</li>
</ul>

<h4>Előnyök:</h4>
<ul>
    <li>Gyors belépés az IT szektorba</li>
    <li>Naprakész tudásanyag</li>
    <li>Networking lehetőségek</li>
    <li>Projekt alapú tanulás</li>
</ul>

<h4>Hátrányok:</h4>
<ul>
    <li>Jelentős anyagi befektetés</li>
    <li>Intenzív időbeosztás</li>
    <li>Kevésbé mélyreható elméleti alapok</li>
</ul>

<h3>2. Egyetemi képzések</h3>

<h4>Jellemzők:</h4>
<ul>
    <li>3-5 éves programok</li>
    <li>Széles körű elméleti alapok</li>
    <li>Kutatási lehetőségek</li>
    <li>Diplomát ad</li>
</ul>

<h4>Előnyök:</h4>
<ul>
    <li>Mélyreható elméleti tudás</li>
    <li>Elismert diploma</li>
    <li>Széles kapcsolati háló</li>
    <li>Kutatási lehetőségek</li>
</ul>

<h4>Hátrányok:</h4>
<ul>
    <li>Hosszabb képzési idő</li>
    <li>Kevesebb gyakorlati projekt</li>
    <li>Lassabb alkalmazkodás az új technológiákhoz</li>
</ul>

<h3>3. Online kurzusok</h3>

<h4>Jellemzők:</h4>
<ul>
    <li>Rugalmas időbeosztás</li>
    <li>Változatos témakörök</li>
    <li>Különböző nehézségi szintek</li>
    <li>Sokszor ingyenes vagy megfizethető</li>
</ul>

<h4>Előnyök:</h4>
<ul>
    <li>Saját tempóban haladás</li>
    <li>Költséghatékony</li>
    <li>Bárhonnan elérhető</li>
    <li>Specializált tudás megszerzése</li>
</ul>

<h4>Hátrányok:</h4>
<ul>
    <li>Önfegyelem szükséges</li>
    <li>Kevesebb személyes interakció</li>
    <li>Változó minőségű tartalom</li>
</ul>

<h3>4. Vállalati képzések</h3>

<h4>Jellemzők:</h4>
<ul>
    <li>Céges környezetben zajlik</li>
    <li>Specifikus technológiákra fókuszál</li>
    <li>Gyakran fizetett betanulás</li>
</ul>

<h4>Előnyök:</h4>
<ul>
    <li>Azonnali gyakorlati alkalmazás</li>
    <li>Biztos munkalehetőség</li>
    <li>Mentoring támogatás</li>
</ul>

<h4>Hátrányok:</h4>
<ul>
    <li>Cég-specifikus tudás</li>
    <li>Korlátozott technológiai fókusz</li>
    <li>Elköteleződés szükséges</li>
</ul>

<h2>Melyiket válaszd?</h2>

<p>A döntésnél vedd figyelembe:</p>
<ul>
    <li>Időbeli és anyagi lehetőségeidet</li>
    <li>Karriercéljaidat</li>
    <li>Tanulási stílusodat</li>
    <li>Jelenlegi élethelyzetedet</li>
</ul>

<p>A legjobb megoldás gyakran a különböző képzési formák kombinációja. Például kezdhetsz online kurzusokkal, majd jelentkezhetsz bootcampre vagy egyetemre, közben pedig folyamatosan fejlesztheted magad önállóan is.</p>

<h3>Tippek a választáshoz</h3>
<ul>
    <li>Nézz utána alaposan a képzőhelyeknek</li>
    <li>Olvasd el a végzett hallgatók véleményét</li>
    <li>Vedd figyelembe a munkaerőpiaci igényeket</li>
    <li>Gondold át a hosszú távú céljaidat</li>
</ul>
</div>', 
'images/photo-2-min.jpg', 3),

('Karrierváltás az IT felé', 
'<div class="rich-text-content">
<h2>Sikeres karrierváltás az IT szektorba: Útmutató kezdőknek</h2>

<p>Egyre többen döntenek úgy, hogy IT területre váltanak. Ez nem meglepő, hiszen az IT szektor folyamatosan növekszik, és vonzó karrierlehetőségeket kínál. Ebben a cikkben gyakorlati tanácsokat adunk, hogyan kezdj neki a karrierváltásnak.</p>

<h3>1. Felkészülés a váltásra</h3>

<h4>Önértékelés:</h4>
<ul>
    <li>Mérd fel jelenlegi készségeidet</li>
    <li>Azonosítsd az átvihető képességeket</li>
    <li>Határozd meg az érdeklődési területeidet</li>
    <li>Készíts reális időtervet</li>
</ul>

<h4>Piackutatás:</h4>
<ul>
    <li>Vizsgáld meg a helyi IT munkaerőpiacot</li>
    <li>Azonosítsd a keresett pozíciókat</li>
    <li>Nézd meg a bérezési lehetőségeket</li>
    <li>Tájékozódj a szükséges képesítésekről</li>
</ul>

<h3>2. Az első lépések</h3>

<h4>Válassz specializációt:</h4>
<p>Az IT számos területet kínál, például:</p>
<ul>
    <li>Webfejlesztés (Frontend/Backend)</li>
    <li>Mobilalkalmazás fejlesztés</li>
    <li>Adatelemzés</li>
    <li>DevOps</li>
    <li>UX/UI tervezés</li>
    <li>Szoftvertesztelés</li>
</ul>

<h4>Képzési terv készítése:</h4>
<ul>
    <li>Válassz megfelelő oktatási formát</li>
    <li>Tervezd meg a tanulási ütemtervet</li>
    <li>Készülj fel az anyagi befektetésre</li>
    <li>Alakíts ki megfelelő tanulási környezetet</li>
</ul>

<h3>3. A tanulási folyamat</h3>

<h4>Alapok elsajátítása:</h4>
<ul>
    <li>Programozási alapkoncepciók</li>
    <li>Választott technológiák</li>
    <li>Fejlesztői eszközök használata</li>
    <li>Verziókezelés (Git)</li>
</ul>

<h4>Gyakorlati tapasztalatszerzés:</h4>
<ul>
    <li>Építs saját projekteket</li>
    <li>Vegyél részt nyílt forráskódú projektekben</li>
    <li>Készíts portfóliót</li>
    <li>Networking és közösségi részvétel</li>
</ul>

<h3>4. Az álláskeresés előkészítése</h3>

<h4>Dokumentáció:</h4>
<ul>
    <li>Frissítsd az önéletrajzod</li>
    <li>Készítsd el GitHub profilod</li>
    <li>Hozd létre LinkedIn oldaladat</li>
    <li>Gyűjtsd össze referenciamunkáidat</li>
</ul>

<h4>Soft skillek fejlesztése:</h4>
<ul>
    <li>Kommunikációs készségek</li>
    <li>Csapatmunka</li>
    <li>Problémamegoldás</li>
    <li>Időmenedzsment</li>
</ul>

<h3>5. Az első IT állás megszerzése</h3>

<h4>Lehetséges utak:</h4>
<ul>
    <li>Junior fejlesztői pozíciók</li>
    <li>Gyakornoki programok</li>
    <li>Freelance munkák</li>
    <li>Startup projektek</li>
</ul>

<h4>Álláskeresési stratégia:</h4>
<ul>
    <li>Célzott jelentkezések</li>
    <li>Networking események látogatása</li>
    <li>IT közösségekben való aktív részvétel</li>
    <li>Szakmai események követése</li>
</ul>

<h2>Sikertörténetek és tapasztalatok</h2>

<p>Sokan sikeresen váltottak már IT karrierre különböző területekről:</p>
<ul>
    <li>Tanárok, akik most programozók</li>
    <li>Értékesítők, akik UX designerek lettek</li>
    <li>Mérnökök, akik szoftvertesztelőként dolgoznak</li>
    <li>Pénzügyi szakemberek, akik adatelemzők lettek</li>
</ul>

<h3>Gyakori kihívások és megoldások</h3>

<h4>Időmenedzsment:</h4>
<ul>
    <li>Készíts részletes időbeosztást</li>
    <li>Használj produktivitást segítő eszközöket</li>
    <li>Találd meg az egyensúlyt a tanulás és más kötelezettségek között</li>
</ul>

<h4>Motiváció fenntartása:</h4>
<ul>
    <li>Tűzz ki reális részcelokat</li>
    <li>Ünnepeld meg a kisebb sikereket</li>
    <li>Csatlakozz támogató közösségekhez</li>
    <li>Kövesd nyomon a fejlődésed</li>
</ul>

<p>Ne feledd: a karrierváltás időt és erőfeszítést igényel, de megfelelő felkészüléssel és kitartással sikeresen véghezvihető!</p>
</div>', 
'images/Group-19.jpg', 4);

INSERT INTO newsletter_subscribers (email) VALUES
('pelda@email.com'),
('teszt@nextit.com');
