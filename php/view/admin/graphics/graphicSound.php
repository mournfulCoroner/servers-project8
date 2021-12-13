<?php
include '/var/www/html/php/security/login.php';
include './getFixtures.php';
include './drawNormGraphic.php';

$norm = 61;

$points = [0, 0]; // 0 - <=$norm; 1 - >$norm

foreach ($fixtures->getObjects() as $fixture) {
    $points[$fixture->sound > $norm ? 1 : 0]++;
}

drawNormGraphic($norm, $points, "Sound", "Sound norm", 0, max($points) + 1);
