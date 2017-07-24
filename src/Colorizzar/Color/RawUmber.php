<?php

namespace Colorizzar\Color;

class RawUmber implements HtmlColor
{
    public function getColorName()
    {
        return 'RawUmber';
    }

    public function getHex()
    {
        return '#714B23';
    }

    public function getRgb()
    {
        return (array) [113, 75, 35];
    }
}
