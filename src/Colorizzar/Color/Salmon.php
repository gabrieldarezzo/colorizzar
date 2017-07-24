<?php

namespace Colorizzar\Color;

class Salmon implements HtmlColor
{
    public function getColorName()
    {
        return 'Salmon';
    }

    public function getHex()
    {
        return '#FF9BAA';
    }

    public function getRgb()
    {
        return (array) [255, 155, 170];
    }
}
