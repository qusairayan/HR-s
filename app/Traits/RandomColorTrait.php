<?php
namespace App\Traits;

trait RandomColorTrait
{
    public function randomColor()
    {
        $red = rand(0, 160);
        $green = rand(0, 150);
        $blue = rand(0, 200);

        return sprintf("#%02x%02x%02x", $red, $green, $blue);
    }
}
