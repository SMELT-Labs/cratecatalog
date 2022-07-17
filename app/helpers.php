<?php

function aspect($width, $height=null)
{
    $height = $height ?? $width;
    return new \Lib\TailwindAspectRatio($width, $height);
}

