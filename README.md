# open-ai chat-gpt php api
Use OpenAi.com API

## Installation
This project using composer.
```
$ composer require itquelle/open-ai-chatgpt-php
```

## Fine tuning
```php
$app->setOptionModel(...);
$app->setOptionTemperature(...);
$app->setOptionMaxTokens(...);
$app->setOptionTopT(...);
$app->setOptionFrequencyPenalty(...);
$app->setOptionPresencePenalty(...);
```

## Get object
```php
var_dump(
    $app->getResponseRaw()
);
```

## Usage
Translate language

```php
<?php

use OpenAiApi\Api;

$app = new Api(...);
$app->setPrompt("Translate this into 1.English, 2.French: Hallo");
$app->get();

echo $app->getResponseText();
```