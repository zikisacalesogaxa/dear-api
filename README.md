# dear-api
[![Build Status](https://travis-ci.com/UmiMood/dear-api.svg?token=4CfuxCuzvs5i12ZugsAZ&branch=master)](https://travis-ci.com/UmiMood/dear-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/UmiMood/dear-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/UmiMood/dear-api/?branch=master)
PHP Library for [dear systems](https://dearinventory.docs.apiary.io) API v2.

## Requirements

* PHP 7.1+
* guzzlehttp/guzzle 6.3+
* ext-json extension

## Installation

```bash
composer require zikisacalesogaxa/dearapi
```

Otherwise just download the package and add it to the autoloader.

## API Documentation
[docs](https://dearinventory.docs.apiary.io)

## Usage


Create a Dear instance.
```php
$dear = Scout\Dear\Dear::create("DEAR-ACCOUNT_ID", "DEAR-APPLICATION-KEY");
```

Get data from API
```php

$products = $dear->product()->get([]);
$accounts = $dear->account()->get([]);
$me = $dear->me()->get([]);

```

Push a new record to the API
```php

$response = $dear->product()->create($params); // see docs for available parameters

```

Update an existing record
```php

$response = $dear->product()->update($guid, $params); // see docs for available parameters

```

Delete a record
```php

$response = $dear->product()->delete($guid, []);

```

## Links ##
 * [License](./LICENSE)
