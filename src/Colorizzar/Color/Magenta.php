<?php

namespace Colorizzar\Color;

class Magenta implements HtmlColor
{
    public function getColorName()
    {
        return 'Magenta';
    }

    public function getHex()
    {
        return '#F664AF';
    }

    public function getRgb()
    {
        return (array) [246, 100, 175];
    }
}
