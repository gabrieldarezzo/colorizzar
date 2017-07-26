<?php

namespace Colorizzar\Color;

class TorchRed implements HtmlColor
{
    public function getColorName()
    {
        return 'TorchRed';
    }

    public function getHex()
    {
        return '#FF1F28';
    }

    public function getRgb()
    {
        return (array) [255, 31, 40];
    }
}
