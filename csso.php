<?php

require_once './vendor/autoload.php';
require_once './CSSOMembershipConversation.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\DoctrineCache;
use Doctrine\Common\Cache\PhpFileCache;

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$cacheDriver = new PhpFileCache(__DIR__.'/cache');

$botman = BotManFactory::create([],new DoctrineCache($cacheDriver));

$botman->startConversation(new CSSOMembershipConversation());
//$botman->hears("Hello", function($botman){
//});



$botman->listen();

