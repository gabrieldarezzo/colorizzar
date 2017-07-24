<?php

namespace Colorizzar\Color;

class NeonCarrot implements HtmlColor
{
    public function getColorName()
    {
        return 'NeonCarrot';
    }

    public function getHex()
    {
        return '#FFA343';
    }

    public function getRgb()
    {
        return (array) [255, 163, 67];
    }
}
