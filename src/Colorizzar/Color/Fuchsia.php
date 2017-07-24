<?php

namespace Colorizzar\Color;

class Fuchsia implements HtmlColor
{
    public function getColorName()
    {
        return 'Fuchsia';
    }

    public function getHex()
    {
        return '#C364C5';
    }

    public function getRgb()
    {
        return (array) [195, 100, 197];
    }
}
