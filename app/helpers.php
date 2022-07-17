<?php

function aspect($width, $height=null)
{
    $height = $height ?? $width;
    return new \Lib\TailwindAspectRatio($width, $height);
}


/**
 * @param $url - an existing image url
 * @param $settings - array of settings to turn into query string
 * @return string
 */
function imgixUrl($url, $settings = [])
{
    $parsed = parse_url($url);
    $path = urlencode($parsed['scheme'].'://'.$parsed['host'].($parsed['path'] ?? ''));
    $query = [];
    $parsed['query'] = $parsed['query'] ?? '';
    parse_str($parsed['query'], $query);
    $query = array_merge($query, $settings);
    $queryString = ! empty($query) ? '?'.http_build_query($query) : '';
    $signature_base = config('imgix.token').'/'.$path.$queryString;
    $query['s'] = md5($signature_base);
    $queryString = ! empty($query) ? '?'.http_build_query($query) : '';

    return config('imgix.domain').'/'.$path.$queryString;
}

function getDefaultImageSettings()
{
    return [
        'h' => 200,
        'w' => 200 * 3.2361 / 2,
        'fit' => 'crop',
        'crop' => 'focalpoint',
        'auto' => 'format,compress,enhance',
    ];
}

function imgix($image, $settings = [])
{
    $settings = array_merge(getDefaultImageSettings(), $settings);

    return imgixUrl($image, $settings);
}

function scaleImage($image, $dpr, $settings = [])
{
    $settings = array_merge(getDefaultImageSettings(), $settings);

    return imgixUrl($image, array_merge(
        $settings,
        ['dpr' => $dpr]
    ));
}

function scaleImages($image, $amount = 3, $settings = [])
{
    $srcset = [];
    for ($i = 1; $i <= $amount; $i++) {
        $srcset[] = scaleImage($image, $i, $settings);
    }

    return $srcset;
}

function imageSrcSet($image, $amount = 3, $settings = [])
{
    $images = scaleImages($image, $amount, $settings);

    return implode(',', array_map(function ($image, $index) {
        return $image." $index".'x';
    }, $images, array_keys($images)));
}

