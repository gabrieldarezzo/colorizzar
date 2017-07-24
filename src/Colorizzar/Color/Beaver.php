<?php

namespace Colorizzar\Color;

class Beaver implements HtmlColor
{
    public function getColorName()
    {
        return 'Beaver';
    }

    public function getHex()
    {
        return '#9F8170';
    }

    public function getRgb()
    {
        return (array) [159, 129, 112];
    }
}
