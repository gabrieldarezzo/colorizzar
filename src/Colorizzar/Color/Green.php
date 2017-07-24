<?php

namespace Colorizzar\Color;

class Green implements HtmlColor
{
    public function getColorName()
    {
        return 'Green';
    }

    public function getHex()
    {
        return '#1CAC78';
    }

    public function getRgb()
    {
        return (array) [28, 172, 120];
    }
}
