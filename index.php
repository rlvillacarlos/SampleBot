<?php

require_once './vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Middleware\ApiAi;



DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$botman = BotManFactory::create([]);

$dialogFlow = ApiAi::create("b86d3ff967984af1ac3f7627435502ce")->listenForAction();

$botman->middleware->received($dialogFlow);


$botman->hears('ask-enrollment', function($botman) {
    $extras = $botman->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $apiAction = $extras['apiAction'];
    $apiIntent = $extras['apiIntent'];
    $apiParameters = $extras['apiParameters'];
    
    $botman->reply("So your course is ". $apiParameters['courses']);
})->middleware($dialogFlow);

$botman->hears('Hello I am {name}', function($botman, $name) {
    $botman->reply('Hi '. $name . '!');
});

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});

$botman->listen();

