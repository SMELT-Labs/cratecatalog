<?php

namespace Lib\Markdown;

use Parsedown;

class ExtendedMarkdown extends Parsedown
{
    use HasRegistry;

    public function __construct()
    {
        $this->setScope($this);
        $this->register(YoutubeVideo::class);
    }

    public function inlineYouTubeEmbed($excerpt)
    {
        return $this->youtubeVideo->inlineYoutubeEmbed($excerpt);
    }
}
