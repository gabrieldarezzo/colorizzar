<?php

namespace Colorizzar\Color;

class Canary implements HtmlColor
{
    public function getColorName()
    {
        return 'Canary';
    }

    public function getHex()
    {
        return '#FFFF99';
    }

    public function getRgb()
    {
        return [255, 255, 153];
    }
}
