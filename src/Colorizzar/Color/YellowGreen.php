<?php

namespace Colorizzar\Color;

class YellowGreen implements HtmlColor
{
    public function getColorName()
    {
        return 'YellowGreen';
    }

    public function getHex()
    {
        return '#C5E384';
    }

    public function getRgb()
    {
        return (array) [197, 227, 132];
    }
}
