<?php
require '../../../security/login.php';

require '../../../../vendor/autoload.php';

use CpChart\Chart\Pie;
use CpChart\Data;
use CpChart\Image;

include './Graphic.php';

class GraphicHeight extends Graphic
{
    function getData($fixtures)
    {
        $points = [];
        $labels = [];
        $uniqueHeight = [];

        foreach ($fixtures->getObjects() as $fixture) {
            $height = floor($fixture->height);
            $index = array_search($height, $uniqueHeight);

            if ($index !== false) {
                $points[$index]++;
            } else {
                array_push($points, 1);
                array_push($labels, $height);
                array_push($uniqueHeight, $height);
            }
        }

        $serie_abcissa = "serie_abcissa";
        $serie_height = "serie_height";

        // Create and populate data
        $data = new Data();
        $data->addPoints($points, $serie_height);

        // Define the absissa serie
        $data->addPoints($labels, $serie_abcissa);
        $data->setAbscissa($serie_abcissa);

        return $data;
    }

    function getImage($data)
    {
        // Create the image
        $image = new Image(400, 300, $data);

        // Add a border to the picture
        $image->drawRectangle(0, 0, 399, 299, ["R" => 0, "G" => 0, "B" => 0]);

        // Write the picture title
        $image->setFontProperties(["FontName" => "Silkscreen.ttf", "FontSize" => 14]);
        $image->drawText(200, 13, "height", ["R" => 0, "G" => 0, "B" => 0, "Align" => TEXT_ALIGN_TOPMIDDLE]);

        // Set the default font properties
        $image->setFontProperties(["FontName" => "Forgotte.ttf", "FontSize" => 10, "R" => 80, "G" => 80, "B" => 80]);

        // Create and draw the chart
        $pieChart = new Pie($image, $data);
        $pieChart->draw2DRing(200, 125, ["DrawLabels" => true, "LabelStacked" => true, "Border" => true]);

        $image->setShadow(false);
        $pieChart->drawPieLegend(15, 40, ["Alpha" => 20]);

        return $image;
    }
}

$graphicHeight = new GraphicHeight();
$graphicHeight->start();
