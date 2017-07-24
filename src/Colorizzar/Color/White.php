<?php

namespace Colorizzar\Color;

class White implements HtmlColor
{
    public function getColorName()
    {
        return 'White';
    }

    public function getHex()
    {
        return '#FFFFFF';
    }

    public function getRgb()
    {
        return (array) [255, 255, 255];
    }
}
