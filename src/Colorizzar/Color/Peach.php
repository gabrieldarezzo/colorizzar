<?php

namespace Colorizzar\Color;

class Peach implements HtmlColor
{
    public function getColorName()
    {
        return 'Peach';
    }

    public function getHex()
    {
        return '#FFCFAB';
    }

    public function getRgb()
    {
        return (array) [255, 207, 171];
    }
}
