# spamfuck
Script to remove your email from uglyposture.strem only mail list

##Getting Started

```
$ composer install
```

open `uglyposture.php` and set your email and session
```
$email = 'example@email.com';
$phpSession = 'PHPSESSID=yoursession';
```
For get a session id:
* Open a new browser tab and visit http://www.uglyposture.stream/
* Open you broswer ispector and go in Network tab
* Select `www.uglyposture.stream` request
* Get `Cookie` value in `Request Headers` section

Run
```
$ php uglyposture.php
```