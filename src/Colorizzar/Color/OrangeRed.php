<?php

namespace Colorizzar\Color;

class OrangeRed implements HtmlColor
{
    public function getColorName()
    {
        return 'OrangeRed';
    }

    public function getHex()
    {
        return '#FF2B2B';
    }

    public function getRgb()
    {
        return (array) [255, 43, 43];
    }
}
