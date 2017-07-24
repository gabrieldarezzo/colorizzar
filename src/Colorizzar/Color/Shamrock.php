<?php

namespace Colorizzar\Color;

class Shamrock implements HtmlColor
{
    public function getColorName()
    {
        return 'Shamrock';
    }

    public function getHex()
    {
        return '#45CEA2';
    }

    public function getRgb()
    {
        return (array) [69, 206, 162];
    }
}
