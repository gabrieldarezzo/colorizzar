<?php

namespace Colorizzar\Color;

class BlueViolet implements HtmlColor
{
    public function getColorName()
    {
        return 'BlueViolet';
    }

    public function getHex()
    {
        return '#7366BD';
    }

    public function getRgb()
    {
        return (array) [115, 102, 189];
    }
}
