<?php

require '../../../../vendor/autoload.php';
use Nelmio\Alice\Loader\NativeLoader;

// данные для ящичка интернет-вещей
class Dump {
    public $illuminace;
    public $voltage;
    public $temperature;
    public $sound;
    public $humidity;
}


$loader = new Nelmio\Alice\Loader\NativeLoader();
$fixtures = $loader->loadFile('./fixtures.yml');

?>