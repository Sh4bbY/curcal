# CurCal - Currency Calculator

CurCal ist die Umsetzung einer Aufgabe einen Währungsumrechner in PHP zu implementiern.

### Requirements

- A User should be able to input

### Task

- Build an working and well tested MVP

### comments:

- use nightwatch for e2e testing
- use codeship for ci

## Development:

#### start php server
```bash
php5 -S localhost:1337 -t public/
```

#### run unit tests
```bash
php vendor/phpunit/phpunit/phpunit --color app/tests/unit
```





## MySQL setup
### table: curreny
```mysql
mysql> select * from currency;
+-------------+------+---------+
| currency_id | code | sign    |
+-------------+------+---------+
|           1 | USD  | &#36;   |
|           2 | EUR  | &#8364  |
|           3 | CHF  | CHF     |
|           4 | GBP  | &#8356; |
|           5 | JPY  | &#165   |
|           6 | CAD  | &#36;   |
+-------------+------+---------+
6 rows in set (0.00 sec)
```
### table: exchange_rate
```mysql
mysql> select * from exchange_rate;
+------------------+------------------+----------------+--------+---------------------+
| exchange_rate_id | id_currency_from | id_currency_to | rate   | created_at          |
+------------------+------------------+----------------+--------+---------------------+
|                1 |                2 |              1 | 1.5897 | 2015-02-01 20:40:38 |
|                2 |                2 |              3 | 1.6135 | 2015-02-01 20:40:38 |
|                3 |                2 |              4 | 0.8031 | 2015-02-01 20:40:38 |
|                4 |                1 |              5 | 103.51 | 2015-02-01 20:40:38 |
|                5 |                3 |              1 |  0.986 | 2015-02-01 20:40:38 |
|                6 |                4 |              6 | 2.0174 | 2015-02-01 20:40:38 |
+------------------+------------------+----------------+--------+---------------------+
6 rows in set (0.00 sec)
```
### view: ex_rates
```mysql
select  ex.exchange_rate_id AS id, ex.rate,  cf.currency_id AS from_id, cf.code AS from_code, cf.sign AS from_sign,  ct.currency_id AS to_id, ct.code AS to_code, ct.sign AS to_sign,  ex.created_at  from exchange_rate ex   LEFT JOIN currency cf ON (ex.id_currency_from = cf.currency_id)  LEFT JOIN currency ct ON (ex.id_currency_to = ct.currency_id);
+----+--------+---------+-----------+-----------+-------+---------+---------+---------------------+
| id | rate   | from_id | from_code | from_sign | to_id | to_code | to_sign | created_at          |
+----+--------+---------+-----------+-----------+-------+---------+---------+---------------------+
|  1 | 1.5897 |       2 | EUR       | &#8364    |     1 | USD     | &#36;   | 2015-02-01 20:40:38 |
|  2 | 1.6135 |       2 | EUR       | &#8364    |     3 | CHF     | CHF     | 2015-02-01 20:40:38 |
|  3 | 0.8031 |       2 | EUR       | &#8364    |     4 | GBP     | &#8356; | 2015-02-01 20:40:38 |
|  4 | 103.51 |       1 | USD       | &#36;     |     5 | JPY     | &#165   | 2015-02-01 20:40:38 |
|  5 |  0.986 |       3 | CHF       | CHF       |     1 | USD     | &#36;   | 2015-02-01 20:40:38 |
|  6 | 2.0174 |       4 | GBP       | &#8356;   |     6 | CAD     | &#36;   | 2015-02-01 20:40:38 |
+----+--------+---------+-----------+-----------+-------+---------+---------+---------------------+
6 rows in set (0.00 sec)
```

## Aufgabenstellung

- Implementierung eines Währungsumrechners
- Vorstellung der Implementierung

---

Folgende Währungen sollen berechnet werden:

- Euro -> US Dollar (1,5897)
- Euro -> Schweizer Franken (1,6135)
- Euro -> Britisch Pfund (0,8031)
- US Dollar -> JPY (103,5100)
- Schweizer Franken -> US Dollar (0,9860)
- Britisch Pfund -> CAD (2,0174)

In Klammern stehen die zu verwendenden Kurse.

---
- Als Eingabe soll das Programm die Ausgangs-, die Zielwährung und den Wert, welcher
umgerechnet werden soll, entgegennehmen.
- Als Ausgabe soll der Wert in der Zielwährung
ausgegeben werden.
- Bitte achten Sie bei Ihrer Implementierung darauf, dass sich die Kurse ändern können.
