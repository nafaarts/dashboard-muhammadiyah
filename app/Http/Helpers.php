<?php

use Gumlet\ImageResize;

function resizeImage($filename, $size, $output)
{
    $image = new ImageResize($filename);
    $image->resizeToWidth($size, true);
    $image->save($output, IMAGETYPE_JPEG);
}
