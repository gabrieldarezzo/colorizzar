<?php

namespace Colorizzar\Color;

class Sepia implements HtmlColor
{
    public function getColorName()
    {
        return 'Sepia';
    }

    public function getHex()
    {
        return '#A5694F';
    }

    public function getRgb()
    {
        return (array) [165, 105, 79];
    }
}
