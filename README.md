Developed for [Examine.com](https://examine.com)

# ConvertKit API Wrapper
SDK for the [ConvertKit V3 API](http://kb.convertkit.com/article/api-documentation-v3/)

Based on original documentation located here: http://kb.convertkit.com/article/api-documentation-v3/

[**composer**](https://getcomposer.org/) is the recommended way to install the SDK.

It is available at [https://packagist.org](https://packagist.org/packages/awesomemotive/convertkit). To use it in your project, you need to include it as a dependency in your project composer.json file.

## Installation
1. Download [Composer](https://getcomposer.org/download/) if not already installed
2. Go to your project directory. If you do not have one, just create a directory and `cd` in.

    ```sh
mkdir project
cd project
    ```
3. Execute `composer require "awesomemotive/convertkit:*" ` on command line. Replace composer with composer.phar if required. It should show something like this:

    ```sh
> composer require "awesomemotive/convertkit:*"

Loading composer repositories with package information
Updating dependencies (including require-dev)
- Installing awesomemotive/convertkit (0.1)
Loading from cache

Writing lock file
Generating autoload files
    ```

## How to use
1. Make sure you are auto-loading Composer in your bootstrap file or main php file:

	```php
require_once __DIR__ . '/vendor/autoload.php';
	```
2. In your class or PHP file, include the namespace of the class:

	```php
use \AwesomeMotive\ConvertKit\ConvertKit;
	```
3. In your constructor or wherever you want to instantiate / use the API, create a new instance of the class and use your **APP_ID** and **API_KEY** as the parameters:

	```php
$this->client = new ConvertKit("{API_KEY}", "{API_SECRET}");
	```
4. Call one of the methods to access the API:

    ```php
$response = $this->client->tags()->all();
var_dump($response);
    ```

## Sample code

```php
<?php

namespace App;

use \AwesomeMotive\ConvertKit\ConvertKit;

require_once __DIR__ . '/vendor/autoload.php';

class ConvertKitApp
{
    /* Properties
    -------------------------------*/
    private $client = null;
    
    public function __construct($apiKey, $apiSecret)
    {
        $this->client = new ConvertKit($apiKey, $apiSecret);
    }
    
    public function getTags()
    {
        $response = $this->client->tags()->all();

        return $response;
    }
}

$convertKit = new ConvertKitApp("APP_ID", "API_KEY");
$tags = $convertKit->getTags();
var_dump($tags);

```
