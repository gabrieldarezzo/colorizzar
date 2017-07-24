<?php

namespace Colorizzar\Color;

class Orange implements HtmlColor
{
    public function getColorName()
    {
        return 'Orange';
    }

    public function getHex()
    {
        return '#FF7538';
    }

    public function getRgb()
    {
        return (array) [255, 117, 56];
    }
}
