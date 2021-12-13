<?php

require '../../../../vendor/autoload.php';

use CpChart\Data;
use CpChart\Image;

include './drawImage.php';

function drawNormGraphic($norm, $points, $axisName, $title, $min, $max)
{

    $data = new Data();

    $serie_norm = "serie_norm";
    $serie_illuminace = "serie_illuminace";

    $data->addPoints($points, $serie_illuminace);

    $data->setAxisName(0, $axisName);
    $data->addPoints(["<=" . $norm, ">" . $norm], $serie_norm);
    $data->setAbscissa($serie_norm);

    /* Create the Image object */
    $image = new Image(500, 500, $data);

    $image->setFontProperties(["FontName" => "pf_arma_five.ttf", "FontSize" => 6]);

    /* Draw the chart scale */
    $image->setGraphArea(30, 80, 480, 480);

    $image->drawText(250, 55, $title, array("FontSize" => 20, "Align" => TEXT_ALIGN_BOTTOMMIDDLE));

    /* Turn on shadow computing */
    $image->setShadow(true, ["X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10]);

    /* Draw the chart */
    $image->drawScale([
        "Mode" => SCALE_MODE_MANUAL,
        "ManualScale" => [
            0 => [
                "Min" => $min,
                "Max" => $max,
            ],
        ],
    ]);
    $image->drawBarChart([
        "DisplayValues" => true,
        "Rounded" => true,
        "Surrounding" => 30,
    ]);

    drawImage($image);
}
