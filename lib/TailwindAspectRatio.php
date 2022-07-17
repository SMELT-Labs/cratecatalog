<?php

namespace Lib;

class TailwindAspectRatio
{
    public int $width;
    public int $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function format() {
        return "aspect-w-{$this->width} aspect-h-{$this->height}";
    }

    public function generate() {
        $format = $this->format();
        return "<?php echo '$format'; ?>";
    }
}
