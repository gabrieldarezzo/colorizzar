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
        return [255, 255, 255];
    }
}
