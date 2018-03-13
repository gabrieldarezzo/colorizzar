<?php

namespace Colorizzar\Color;

class Black implements HtmlColor
{
    public function getColorName()
    {
        return 'Black';
    }

    public function getHex()
    {
        return '#000000';
    }

    public function getRgb()
    {
        return [0, 0, 0];
    }
}
