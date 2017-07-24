<?php

namespace Colorizzar\Color;

class Tan implements HtmlColor
{
    public function getColorName()
    {
        return 'Tan';
    }

    public function getHex()
    {
        return '#FAA76C';
    }

    public function getRgb()
    {
        return (array) [250, 167, 108];
    }
}
