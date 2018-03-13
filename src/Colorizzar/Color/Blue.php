<?php

namespace Colorizzar\Color;

class Blue implements HtmlColor
{
    public function getColorName()
    {
        return 'Blue';
    }

    public function getHex()
    {
        return '#1F75FE';
    }

    public function getRgb()
    {
        return [31, 117, 254];
    }
}
