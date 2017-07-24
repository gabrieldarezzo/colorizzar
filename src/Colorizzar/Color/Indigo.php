<?php

namespace Colorizzar\Color;

class Indigo implements HtmlColor
{
    public function getColorName()
    {
        return 'Indigo';
    }

    public function getHex()
    {
        return '#5D76CB';
    }

    public function getRgb()
    {
        return (array) [93, 118, 203];
    }
}
