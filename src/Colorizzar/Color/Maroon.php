<?php

namespace Colorizzar\Color;

class Maroon implements HtmlColor
{
    public function getColorName()
    {
        return 'Maroon';
    }

    public function getHex()
    {
        return '#C8385A';
    }

    public function getRgb()
    {
        return [200, 56, 90];
    }
}
