<?php
require "src/OpenAiApi/Api.php";

use OpenAiApi\Api;

/**
 * @author Stevie-Ray
 * @template Example to translate an input into another language
 */

$app = new Api("...");
$app->setPrompt("Translate this into 1.English, 2.French: Hallo");
$app->get();

$response = trim(
    $app->getResponseText()
);

// Items
$items = [
    0 => [
        "language" => "english"
    ],
    1 => [
        "language" => "french"
    ]
];

foreach (explode("\n", $response) as $key => $value){
    $items[$key]["text"] = trim(explode(". ", $value)[1]);
}

// Perfect output
print_r(
    $items
);