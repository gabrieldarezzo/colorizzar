<?php

namespace Colorizzar\Color;

class Melon implements HtmlColor
{
    public function getColorName()
    {
        return 'Melon';
    }

    public function getHex()
    {
        return '#FDBCB4';
    }

    public function getRgb()
    {
        return (array) [253, 188, 180];
    }
}
