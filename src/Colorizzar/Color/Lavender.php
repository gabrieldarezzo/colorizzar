<?php

namespace Colorizzar\Color;

class Lavender implements HtmlColor
{
    public function getColorName()
    {
        return 'Lavender';
    }

    public function getHex()
    {
        return '#FCB4D5';
    }

    public function getRgb()
    {
        return (array) [252, 180, 213];
    }
}
