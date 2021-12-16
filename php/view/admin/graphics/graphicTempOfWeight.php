<?php
include '/var/www/html/php/security/login.php';

require '../../../../vendor/autoload.php';

use CpChart\Data;
use CpChart\Image;

include './Graphic.php';

class GraphicTempOfWeight extends Graphic
{
    function getData($fixtures)
    {
        $data = new Data();

        $serie_temp = "temperature";
        $serie_temp2 = "temperature2";

        $serie_weight = "weight";

        foreach ($fixtures->getObjects() as $fixture) {
            $data->addPoints($fixture->temperature, $serie_temp);
            $data->addPoints($fixture->weight, $serie_weight);
        }

        $data->setAxisName(0, "Temperatures");
        $data->setAxisName(1, "Temperatures2");

        $data->setSerieDescription($serie_weight, "Weight");
        $data->setAbscissa($serie_weight);

        $data->setSerieOnAxis($serie_temp, 0);


        $data->setAxisPosition(1, AXIS_POSITION_RIGHT);
        return $data;
    }

    function getImage($data)
    {
        $image = new Image(900, 300, $data);

        $image->Antialias = false;

        $image->drawRectangle(0, 0, 899, 299, ["R" => 0, "G" => 0, "B" => 0]);


        $image->setFontProperties(["FontName" => "Forgotte.ttf", "FontSize" => 11]);
        $image->drawText(200, 35, "Dependency weight and temperature", ["FontSize" => 20, "Align" => TEXT_ALIGN_BOTTOMMIDDLE]);

        $image->setFontProperties(["FontName" => "pf_arma_five.ttf", "FontSize" => 6]);

        $image->setGraphArea(60, 40, 850, 250);

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

        $image->Antialias = true;
        $image->setShadow(true, ["X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10]);

        $image->drawAreaChart(["DisplayValues" => TRUE,"DisplayColor" => DISPLAY_AUTO]);
        $image->setShadow(false);

        $image->drawLegend(680, 20, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL]);
        return $image;
    }
}

$graphicTempOfWeight = new GraphicTempOfWeight();
$graphicTempOfWeight->start();
