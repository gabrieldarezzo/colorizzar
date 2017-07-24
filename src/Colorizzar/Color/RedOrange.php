<?php

namespace Colorizzar\Color;

class RedOrange implements HtmlColor
{
    public function getColorName()
    {
        return 'RedOrange';
    }

    public function getHex()
    {
        return '#FF5349';
    }

    public function getRgb()
    {
        return (array) [255, 83, 73];
    }
}
