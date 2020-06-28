<?php

class MiscUtils
{

    /**
     * Formats integer with M or k suffixes (for million or thousand).
     * 
     * @param int $num Number to format
     * @return string Formatted string, e.g. 7.1 k
     */
    public static function FormatBigNumber($num)
    {
        if ($num > 1_000_000)
        {
            $num /= 1_000_000;
            $num = number_format($num, 1, '.', ' ')." M";
        }
        else if ($num > 1000)
        {
            $num /= 1000;
            $num = number_format($num, 1, '.', ' ')." k";
        }
        
        return $num;
    }

    /**
     * Formats date to yyyy-mm-dd string.
     */
    public static function Date(DateTime $dateTime)
    {
        return $dateTime->format('yy-m-d');
    }

    /**
     * Creates array with Page objects, listing pages close to current one + first/last pages.
     * 
     * @param int $total Total items count in DB
     * @param int $current Current page number
     * @return mixed Array of Page objects, sorted by page number.
     */
    public static function ListPages(int $total, int $current)
    {
        $p = [];
        $p[] = new Page($current, $current, true); // Current page
        if ($current > 1)  // First page
            $p[] = new Page(1, 'First', false);

        $maxPages = ceil($total / Config::PAGE_SIZE);
        if ($current < $maxPages)  // Last page
            $p[] = new Page($maxPages, 'Last', false);

        for ($i = $current - 1; $i > max(1, $current - 5); $i--) // Previous pages
            $p[] = new Page($i, $i, false);

        for ($i = $current + 1; $i < min($maxPages, $current + 5); $i++) // Next pages
            $p[] = new Page($i, $i, false);

        usort($p, function($a, $b)
        {
            return $a->number > $b->number;
        });

        return $p;
    }
}

?>