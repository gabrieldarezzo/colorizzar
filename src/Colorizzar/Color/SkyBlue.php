<?php

namespace Colorizzar\Color;

class SkyBlue implements HtmlColor
{
    public function getColorName()
    {
        return 'SkyBlue';
    }

    public function getHex()
    {
        return '#80DAEB';
    }

    public function getRgb()
    {
        return (array) [128, 218, 235];
    }
}
