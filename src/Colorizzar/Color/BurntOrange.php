<?php

namespace Colorizzar\Color;

class BurntOrange implements HtmlColor
{
    public function getColorName()
    {
        return 'BurntOrange';
    }

    public function getHex()
    {
        return '#FF7F49';
    }

    public function getRgb()
    {
        return (array) [255, 127, 73];
    }
}
