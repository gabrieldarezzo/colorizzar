<?php

namespace Colorizzar\Color;

class Gray implements HtmlColor
{
    public function getColorName()
    {
        return 'Gray';
    }

    public function getHex()
    {
        return '#95918C';
    }

    public function getRgb()
    {
        return [149, 145, 140];
    }
}
