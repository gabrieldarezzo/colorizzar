<?php

namespace Colorizzar\Color;

class Gold implements HtmlColor
{
    public function getColorName()
    {
        return 'Gold';
    }

    public function getHex()
    {
        return '#E7C697';
    }

    public function getRgb()
    {
        return (array) [231, 198, 151];
    }
}
