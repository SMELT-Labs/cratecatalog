<?php

namespace Lib\Markdown;

use Parsedown;

class YoutubeVideo extends BaseExtension
{
    public function __construct($scope)
    {
        $scope->InlineTypes['{'][] = 'YoutubeEmbed';
        $scope->inlineMarkerList .= '{';
    }

    public function inlineYoutubeEmbed($excerpt)
    {
        return $this->matchSingleTwig('youtube', $excerpt, function ($value) {
            return [
                'name' => 'div',
                'attributes' => [
                    'class' => 'video-wrapper',
                ],
                'handler' => 'element',
                'text' => [
                    'text' => '',
                    'name' => 'iframe',
                    'attributes' => [
                        'src' => "https://www.youtube.com/embed/$value",
                        'title' => 'YouTube video player',
                        'frameborder'=>'0',
                        'allow'=> implode(';', [
                            'accelerometer',
                            'autoplay',
                            'clipboard-write',
                            'encrypted-media',
                            'gyroscope',
                            'picture-in-picture',
                        ]),
                        'allowfullscreen' => true,
                    ],
                ],
            ];
        });
    }
}
