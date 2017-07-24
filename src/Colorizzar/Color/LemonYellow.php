<?php

namespace Colorizzar\Color;

class LemonYellow implements HtmlColor
{
    public function getColorName()
    {
        return 'LemonYellow';
    }

    public function getHex()
    {
        return '#FFF44F';
    }

    public function getRgb()
    {
        return (array) [255, 244, 79];
    }
}
