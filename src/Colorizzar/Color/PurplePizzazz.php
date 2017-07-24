<?php

namespace Colorizzar\Color;

class PurplePizzazz implements HtmlColor
{
    public function getColorName()
    {
        return 'PurplePizzazz';
    }

    public function getHex()
    {
        return '#FE4EDA';
    }

    public function getRgb()
    {
        return (array) [254, 78, 218];
    }
}
