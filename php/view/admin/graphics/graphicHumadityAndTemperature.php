<?php
require '../../../security/login.php';
include './getFixtures.php';

require '../../../../vendor/autoload.php';

use CpChart\Data;
use CpChart\Image;

include './drawImage.php';

$data = new Data();

$serie_temp = "temperature";
$serie_humidity = "humidity";
$serie_minutes = "minutes";

$minute = 0;

foreach ($fixtures->getObjects() as $fixture) {
    $data->addPoints($fixture->temperature, $serie_temp); 
    $data->addPoints($fixture->humidity, $serie_humidity);
    $data->addPoints($minute, $serie_minutes);

    $minute++;
}

$data->setAbscissa($serie_minutes);
$data->setAbscissaName("Time in minutes");

//SERIE_SHAPE_FILLEDTRIANGLE - triangle
//SERIE_SHAPE_FILLEDSQUARE - square
$data->setSerieShape($serie_temp, SERIE_SHAPE_FILLEDTRIANGLE);
$data->setSerieShape($serie_humidity, SERIE_SHAPE_FILLEDSQUARE);

$data->setSerieOnAxis($serie_temp, 0);
$data->setSerieOnAxis($serie_humidity, 1);

$data->setAxisName(0, "Temperatures");
$data->setAxisName(1, "Humadity");

$data->setAxisPosition(1, AXIS_POSITION_RIGHT);

/* Create the Image object */
$image = new Image(900, 300, $data);

/* Turn off Antialiasing */
$image->Antialias = false;

/* Add a border to the picture */
$image->drawRectangle(0, 0, 899, 299, ["R" => 0, "G" => 0, "B" => 0]);

/* Write the chart title */
$image->setFontProperties(["FontName" => "Forgotte.ttf", "FontSize" => 11]);
$image->drawText(200, 35, "Change humadity and temperature", ["FontSize" => 20, "Align" => TEXT_ALIGN_BOTTOMMIDDLE]);

/* Set the default font */
$image->setFontProperties(["FontName" => "pf_arma_five.ttf", "FontSize" => 6]);

/* Define the chart area */
$image->setGraphArea(60, 40, 850, 250);

/* Draw the scale */
$scaleSettings = [
    "XMargin" => 10,
    "YMargin" => 10,
    "Floating" => true,
    "GridR" => 200,
    "GridG" => 200,
    "GridB" => 200,
    "DrawSubTicks" => true,
    "CycleBackground" => true
];
$image->drawScale($scaleSettings);

/* Turn on Antialiasing */
$image->Antialias = true;
$image->setShadow(true, ["X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10]);

/* Draw the line chart */
$image->drawPlotChart();
$image->drawLineChart();

/* Write the chart legend */
$image->drawLegend(680, 20, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL]);

drawImage($image);
