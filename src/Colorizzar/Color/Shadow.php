<?php

namespace Colorizzar\Color;

class Shadow implements HtmlColor
{
    public function getColorName()
    {
        return 'Shadow';
    }

    public function getHex()
    {
        return '#8A795D';
    }

    public function getRgb()
    {
        return (array) [138, 121, 93];
    }
}
