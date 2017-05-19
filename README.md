
NFQ Akademijos projektas - [virtualus treneris](http://virtualustreneris.projektai.nfqakademija.lt/)
============
[![Build Status](https://travis-ci.org/nfqakademija/virtualustreneris.svg?branch=master)](https://travis-ci.org/nfqakademija/virtualustreneris)

### Nariai:
 - Aidas Eglinskas
 - Vilius Norbutas
 - Armandas Dambrauskas

### Mentorius:
 - Andrius Buivydas

# Intro

Šis projektas suteiks galimybę susidaryti Jums tinkamą sporto ir mitybos programą, kuria vadovaudamiesi nesunkiai padidinsite raumenų apimtis, sumažinsite/padidinsite bendrą kūno svorį, turėsite puikią sveikatą ir būsite laimingi.

# Paleidimo instrukcija

#### Versijų reikalavimai
* PHP: `>=7.0.x`
* mariaDB: `>=10.0.29`
* composer: `>=1.4.1`
* docker: `>=17.x-ce`
* docker-compose: `>=1.8.1`

### Projekto paleidimas
Parsisiunčiate šią repositoriją.

Einate į šią direktoriją su terminalu. `cd <path>`.

**SVARBU:**

Susikuriate projekto viduje `.env` failą. Failą užpildote turiniu pateiktu iš `env.dist`

Atkreipkite dėmęsį į `LOCAL_USER_ID` ir `LOCAL_GROUP_ID`, įvykdžius nurodytas komandas, ar sutampa `id` su jūsų nurodytais.

Toliau leidžiame komandas esančias žemiau:

```bash
docker-compose up -d
docker-compose exec fpm composer install --prefer-dist -n
composer install
docker-compose run npm npm install
docker-compose run npm gulp

```

### Kaip teisingai išjungti docker konteinerius?

Išjungiama su komanda:
```
docker-compose kill
```

Galima išjungti ir po vieną:
```
docker-compose kill <container name>
```


### Kaip pamatyti kas atsitiko?

Atsidarote naršyklę ir einate į `http://127.0.0.1:8000`


#
© VA komanda