## Facebook messenger chatbot built with <a href="https://botman.io">BotMan</a>

Based on BotMan 2.0 without Studio, i.e. as a standalone library (BotMan Studio is integrated into Laravel)

**Features**

BotMan supports single messages as well as conversations. See BotMan project page for more details.

**Installation**
* Place this repository files on localhost or public hosting
* Whether using this repository or composer, you have to create facebook developers account, then create page and app for that page
* In app settings generate facebook page token and paste it in FACEBOOK_PAGE_TOKEN field in index.php
* Choose FACEBOOK_WEBHOOK_VERIFICATION (just make it up, e.g. my-verify-token) and write it in appropriate field in index.php
* Setup facebook webhook by providing chatbot url. Facebook only accepts https url, so use ngrok for localhost development or public hosting with SSL provided. Ngrok example url `https://324596e6.ngrok.io/chatbot`, public hosting example url `https://my-domain.com/chatbot`
* Choose webhook events; to send and receive messages the following events are enough: messages, messaging_postbacks
* From dropdown select the earlier created page and suscribe your webhook to it

**Installation with Composer**
* Install BotMan
```
composer require botman/botman
```
* Add autoload to your bot file
```
require __DIR__ . '/vendor/autoload.php';
```
* install facebook messenger driver and follow BotMan docs on how to include it in your bot
```
composer require botman/driver-facebook
```
* If not using BotMan Studio you need to install cache driver in order to use conversations, for example Symfony cache. See docs on how to include it in your bot
```
composer require symfony/cache
```