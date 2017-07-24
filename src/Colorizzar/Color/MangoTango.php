<?php

namespace Colorizzar\Color;

class MangoTango implements HtmlColor
{
    public function getColorName()
    {
        return 'MangoTango';
    }

    public function getHex()
    {
        return '#FF8243';
    }

    public function getRgb()
    {
        return (array) [255, 130, 67];
    }
}
