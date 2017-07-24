<?php

namespace Colorizzar\Color;

class BrickRed implements HtmlColor
{
    public function getColorName()
    {
        return 'BrickRed';
    }

    public function getHex()
    {
        return '#CB4154';
    }

    public function getRgb()
    {
        return (array) [203, 65, 84];
    }
}
