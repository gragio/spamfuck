# spamfuck
Unsubscriber script for remove your email address from uglyposture.strem only mail list

##Getting Started

Install

```
$ composer install
```

and run
```
$ php uglyposture.php
```

If the response is `Some Thing Wrong` probably you need a session ID.

##Session ID
For get a session id:
* Open a new browser tab and visit http://www.uglyposture.stream/
* Open you broswer ispector and go in Network tab
* Select `www.uglyposture.stream` request
* Get `Cookie` value in `Request Headers` section