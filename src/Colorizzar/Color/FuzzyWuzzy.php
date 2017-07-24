<?php

namespace Colorizzar\Color;

class FuzzyWuzzy implements HtmlColor
{
    public function getColorName()
    {
        return 'FuzzyWuzzy';
    }

    public function getHex()
    {
        return '#CC6666';
    }

    public function getRgb()
    {
        return (array) [204, 102, 102];
    }
}
