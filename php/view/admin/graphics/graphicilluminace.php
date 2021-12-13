<?php
include '../../../security/login.php';
include './getFixtures.php';
include './drawNormGraphic.php';

$norm = 361;

$points = [0, 0]; // 0 - <=$norm; 1 - >$norm

foreach ($fixtures->getObjects() as $fixture) {
    $points[$fixture->illuminace > $norm ? 1 : 0]++;
}

drawNormGraphic($norm, $points, "Illuminace", "Illuminance norm", 0, max($points) + 1);
