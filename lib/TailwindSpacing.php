<?php

namespace Lib;

use stringEncode\Encode;

class TailwindSpacing
{
    public int $width;
    public int $height;

    public function __construct()
    {

    }

    private static function getClass($prefix, $value) {
        $value = (int) $value;
        return $value < 0 ? "-$prefix-" . abs($value) : "$prefix-$value";
    }

    private static function space($prefix, $t, $r=null, $b=null, $l=null) {
        if (!isset($r) && !isset($b) && !isset($l)) {
            return implode(" ", [
                self::getClass($prefix, $t)
            ]);
        }
        if (!isset($b) && !isset($l)) {

            return implode(" ", [
                self::getClass($prefix . "y", $t),
                self::getClass($prefix . "x", $r)
            ]);
        }
        if (!isset($l)) {
            return implode(" ", [
                self::getClass($prefix . "t", $t),
                self::getClass($prefix . "x", $r),
                self::getClass($prefix . "b", $b)
            ]);
        }
        return implode(" ", [
            self::getClass($prefix . "t", $t),
            self::getClass($prefix . "r", $r),
            self::getClass($prefix . "b", $b),
            self::getClass($prefix . "l", $l)
        ]);
    }

    public static function margin($t, $r=null, $b=null, $l=null) {
        return static::space("m", $t, $r, $b, $l);
    }

    public static function padding($t, $r=null, $b=null, $l=null) {
        return static::space("p", $t, $r, $b, $l);
    }

    public static function width($size) {
        return "w-$size";
    }

    public static function generate(\Closure $closure) {
        $format = $closure();
        return "<?php echo '$format'; ?>";
    }
}
