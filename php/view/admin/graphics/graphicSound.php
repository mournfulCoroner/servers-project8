<?php
include '/var/www/html/php/security/login.php';
include './NormGraphic.php';

class GraphicSound extends NormGraphic
{
    private $points;
    private $norm = 61;

    function __construct()
    {
        parent::__construct($this->norm, "Sound", "Sound norm");
    }

    function getPoints($fixtures)
    {
        $this->points = [0, 0]; // 0 - <=$norm; 1 - >$norm

        foreach ($fixtures->getObjects() as $fixture) {
            $this->points[$fixture->sound > $this->norm ? 1 : 0]++;
        }

        return $this->points;
    }

    function getMax()
    {
        return max($this->points) + 1;
    }

    function getMin()
    {
        return 0;
    }
}

$graphicSound = new GraphicSound();
$graphicSound->start();
