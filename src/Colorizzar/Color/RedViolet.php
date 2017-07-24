<?php

namespace Colorizzar\Color;

class RedViolet implements HtmlColor
{
    public function getColorName()
    {
        return 'RedViolet';
    }

    public function getHex()
    {
        return '#C0448F';
    }

    public function getRgb()
    {
        return (array) [192, 68, 143];
    }
}
