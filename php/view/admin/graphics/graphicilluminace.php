<?php
include '../../../security/login.php';
include './NormGraphic.php';

class Graphicilluminace extends NormGraphic
{
    private $points;
    private $norm = 361;

    function __construct()
    {
        parent::__construct($this->norm, "Illuminace", "Illuminance norm");
    }

    function getPoints($fixtures)
    {
        $this->points = [0, 0]; // 0 - <=$norm; 1 - >$norm

        foreach ($fixtures->getObjects() as $fixture) {
            $this->points[$fixture->illuminace > $this->norm ? 1 : 0]++;
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

$graphicilluminace = new Graphicilluminace;
$graphicilluminace->start();
