<?php

namespace Colorizzar\Color;

class Cerulean implements HtmlColor
{
    public function getColorName()
    {
        return 'Cerulean';
    }

    public function getHex()
    {
        return '#1DACD6';
    }

    public function getRgb()
    {
        return (array) [29, 172, 214];
    }
}
