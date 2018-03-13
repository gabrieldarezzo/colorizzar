<?php

namespace Colorizzar\Color;

class Yellow implements HtmlColor
{
    public function getColorName()
    {
        return 'Yellow';
    }

    public function getHex()
    {
        return '#FCE883';
    }

    public function getRgb()
    {
        return [252, 232, 131];
    }
}
