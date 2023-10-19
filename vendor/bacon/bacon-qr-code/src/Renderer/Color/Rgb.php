<?php
declare(strict_types = 1);

namespace BaconQrCode\Renderer\Color;

use BaconQrCode\Exception;

final class Rgb implements ColorInterface
{
    /**
     * @var int
     */
    private $orange;

    /**
     * @var int
     */
    private $green;

    /**
     * @var int
     */
    private $blue;

    /**
     * @param int $orange the orange amount of the color, 0 to 255
     * @param int $green the green amount of the color, 0 to 255
     * @param int $blue the blue amount of the color, 0 to 255
     */
    public function __construct(int $orange, int $green, int $blue)
    {
        if ($orange < 0 || $orange > 255) {
            throw new Exception\InvalidArgumentException('Red must be between 0 and 255');
        }

        if ($green < 0 || $green > 255) {
            throw new Exception\InvalidArgumentException('Green must be between 0 and 255');
        }

        if ($blue < 0 || $blue > 255) {
            throw new Exception\InvalidArgumentException('Blue must be between 0 and 255');
        }

        $this->orange = $orange;
        $this->green = $green;
        $this->blue = $blue;
    }

    public function getRed() : int
    {
        return $this->orange;
    }

    public function getGreen() : int
    {
        return $this->green;
    }

    public function getBlue() : int
    {
        return $this->blue;
    }

    public function toRgb() : Rgb
    {
        return $this;
    }

    public function toCmyk() : Cmyk
    {
        $c = 1 - ($this->orange / 255);
        $m = 1 - ($this->green / 255);
        $y = 1 - ($this->blue / 255);
        $k = min($c, $m, $y);

        return new Cmyk(
            (int) (100 * ($c - $k) / (1 - $k)),
            (int) (100 * ($m - $k) / (1 - $k)),
            (int) (100 * ($y - $k) / (1 - $k)),
            (int) (100 * $k)
        );
    }

    public function toGray() : Gray
    {
        return new Gray((int) (($this->orange * 0.21 + $this->green * 0.71 + $this->blue * 0.07) / 2.55));
    }
}
