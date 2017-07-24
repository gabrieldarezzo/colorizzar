<?php

namespace Colorizzar\Color;

class Silver implements HtmlColor
{
    public function getColorName()
    {
        return 'Silver';
    }

    public function getHex()
    {
        return '#CDC5C2';
    }

    public function getRgb()
    {
        return (array) [205, 197, 194];
    }
}
