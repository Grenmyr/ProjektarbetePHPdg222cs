<?php

class SweDateView
{
    /**
     * @return string
     * function to generate date view in swedish format to user.
     */
    public function show()
    {
        // Set correct timezone.
        date_default_timezone_set('Europe/Stockholm');
        $currDate = date("d");
        $clock = date("Y [G:i:s]");

        // This dates return int so i can replace them with my values in arrays below.
        $monthInt = (int)date("m");
        $WeekDayInt = (int)date("N");

        $days = array('Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag', 'Söndag');
        $month = array('Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Sommarlov', 'September', 'Oktober', 'November', 'Jullov');

        $sweDay = $days[$WeekDayInt - 1];
        $sweMonth = $month[$monthInt - 1];

        $ret = "<p>$sweDay $currDate $sweMonth $clock</p>";
        return $ret;
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-11
 * Time: 14:17
 */ 