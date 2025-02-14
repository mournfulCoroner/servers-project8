<?php
include '/var/www/html/php/security/login.php';

require '../../../../vendor/autoload.php';

use CpChart\Chart\Bubble;
use CpChart\Data;
use CpChart\Image;

include './Graphic.php';

class GraphicIllnesses extends Graphic
{
    private $serie_oldill = "oldIlnesses";
    private $serie_newill = "currentIllnesses";
    private $serie_oldillweight = "oldIlnessesWeight";
    private $serie_newillweight = "curretnIllnessesWeight";
    private $serie_name = "name";

    function getData($fixtures)
    {
        $data = new Data();

        foreach ($fixtures->getObjects() as $fixture) {
            $data->addPoints($fixture->oldIlnesses, $this->serie_oldill);
            $data->addPoints($fixture->currentIlnesses, $this->serie_newill);
            $data->addPoints(1, $this->serie_oldillweight);
            $data->addPoints(1, $this->serie_newillweight);
            $data->addPoints($fixture->name, $this->serie_name);
        }

        $data->setSerieDescription($this->serie_oldill, "Last year");
        $data->setSerieDescription($this->serie_newill, "This year");
        $data->setAxisName(0, "Amount of illnesses");
        $data->setAbscissa($this->serie_name);
        return $data;
    }

    function getImage($data)
    {
        $image = new Image(1700, 300, $data);
        $settings = ["R" => 170, "G" => 183, "B" => 87, "Dash" => 1, "DashR" => 190, "DashG" => 203, "DashB" => 107];
        $image->drawFilledRectangle(0, 0, 1700, 300, $settings);

        $settings = [
            "StartR" => 219,
            "StartG" => 231,
            "StartB" => 139,
            "EndR" => 1,
            "EndG" => 138,
            "EndB" => 68,
            "Alpha" => 50
        ];

        $image->drawRectangle(0, 0, 1699, 299, ["R" => 0, "G" => 0, "B" => 0]);


        /* Write the title */
        $image->setFontProperties(["FontName" => "Forgotte.ttf", "FontSize" => 11]);
        $image->drawText(40, 55, "Ilnesses of subjects", ["FontSize" => 14, "Align" => TEXT_ALIGN_BOTTOMLEFT]);

        /* Change the default font */
        $image->setFontProperties(["FontName" => "pf_arma_five.ttf", "FontSize" => 6]);

        /* Create the Bubble chart object and scale up */
        $bubbleChart = new Bubble($image, $data);

        /* Scale up for the bubble chart */
        $bubbleDataSeries = [$this->serie_oldill, $this->serie_newill];
        $bubbleWeightSeries = [$this->serie_oldillweight, $this->serie_newillweight];
        $bubbleChart->bubbleScale($bubbleDataSeries, $bubbleWeightSeries);

        $image->setGraphArea(40, 60, 1670, 270);
        $image->drawFilledRectangle(40, 60, 1670, 270, ["R" => 255, "G" => 255, "B" => 255,
            "Surrounding" => -100, "Alpha" => 10]);
        $image->drawScale(["DrawSubTicks" => true, "CycleBackground" => true]);
        $image->setShadow(true, ["X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 30]);
        $bubbleChart->drawBubbleChart($bubbleDataSeries, $bubbleWeightSeries, ["Shape"=>BUBBLE_SHAPE_SQUARE,"ForceAlpha"=>50,"BorderWidth"=>4, "BorderAlpha"=>20,"Surrounding"=>20]);

        $image->drawLegend(680, 20, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL]);
        return $image;
    }
}

$graphicIllnesses = new GraphicIllnesses();
$graphicIllnesses->start();
