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
        return [138, 121, 93];
    }
}
