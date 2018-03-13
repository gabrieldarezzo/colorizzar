<?php

namespace Colorizzar\Color;

class Red implements HtmlColor
{
    public function getColorName()
    {
        return 'Red';
    }

    public function getHex()
    {
        return '#EE204D';
    }

    public function getRgb()
    {
        return [238, 32, 77];
    }
}
