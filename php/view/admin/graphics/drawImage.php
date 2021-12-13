<?php
    function drawImage($image) {
        $filename1 = "example.createFunctionSerie.scatter.png";
        $filename_whater_mark = "whater_mark.png";

        $image->render($filename1);

        $stamp = imagecreatefrompng($filename_whater_mark);
        $im = imagecreatefrompng($filename1);

        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);

        unlink($filename1);
    }
