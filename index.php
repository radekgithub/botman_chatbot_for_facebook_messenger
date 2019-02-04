<?php

require __DIR__ . '/vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Conversations\AgeConversation;
use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$config = [
    // Your driver-specific configuration
    'facebook' => [
  	'token' => 'FACEBOOK_PAGE_TOKEN',// generated by facebook
	'verification'=>'FACEBOOK_WEBHOOK_VERIFICATION',// chosen by user
    ]
];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

// Create cache adapter
$adapter = new FilesystemAdapter();

// Create an instance
$botman = BotManFactory::create($config, new SymfonyCache($adapter));

$botman->hears('(.*)', function(BotMan $bot) {
    $bot->startConversation(new AgeConversation);
});

// Start listening
$botman->listen();