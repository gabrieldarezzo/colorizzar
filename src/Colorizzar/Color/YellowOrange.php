<?php

namespace Colorizzar\Color;

class YellowOrange implements HtmlColor
{
    public function getColorName()
    {
        return 'YellowOrange';
    }

    public function getHex()
    {
        return '#FFAE42';
    }

    public function getRgb()
    {
        return (array) [255, 174, 66];
    }
}
