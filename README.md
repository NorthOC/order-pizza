# Projektas

## Failų struktūra

- `config.php` - Database config'as (realybėje šitie duomenys būtų [.env faile](https://stackoverflow.com/questions/60360298/is-it-secure-way-to-store-private-values-in-env-file))
- `db.php` - Duomenų [CRUD](https://www.crowdstrike.com/cybersecurity-101/observability/crud/) valdymo klasė
- `index.php` - Homepage
- `style.css` - Puslapių stilius


Sistemos puslapiai:

1) Menu puslapis su užsakymo forma
2) Puslapis kuriame rašo, kad kliento užsakymo forma buvo patvirtinta
3) Išvežiotojo dashboard, kur gali save priskirti prie naujo užsakymo kaip išvežiotoją, ir pažymėti tą užsakymą kaip completed.
4) Lojalumo forma, kurią užpildžius, pateikiamas lojalumo kodas.
