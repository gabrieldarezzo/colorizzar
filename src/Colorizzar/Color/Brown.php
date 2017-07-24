<?php

namespace Colorizzar\Color;

class Brown implements HtmlColor
{
    public function getColorName()
    {
        return 'Brown';
    }

    public function getHex()
    {
        return '#B4674D';
    }

    public function getRgb()
    {
        return (array) [180, 103, 77];
    }
}
