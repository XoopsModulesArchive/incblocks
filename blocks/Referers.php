<?php

// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
// Based on:             //
// myPHPNUKE Web Portal System - http://myphpnuke.com/          //
// PHP-NUKE Web Portal System - http://phpnuke.org/          //
// Thatware - http://thatware.org/          //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //
function b_LastReferers_show($options)
{
    global $xoopsDB;

    $block = [];

    $block['title'] = 'Les référants';

    $ref = $options[0]; // how many referers in block

    $a = 1;

    $result = $xoopsDB->query("SELECT data FROM php_stats_referer WHERE data<>'' ORDER BY date DESC", $ref, 0);

    $direction = $options[1];

    if ('on' == $options[2]) {
        $block['content'] = "<marquee behavior=\"scroll\" direction=\"$direction\" height=\"80\" scrollamount=\"1\" scrolldelay=\"60\" onmouseover=\"this.stop()\" onmouseout=\"this.start()\">";
    }

    while (false !== ($row = $xoopsDB->fetchArray($result))) {
        $url2 = preg_replace('_', ' ', $row['data']);

        $url2 = mb_substr($url2, 7);

        if (mb_strlen($url2) > 18) {
            $url2 = mb_substr($url2, 0, 18);

            $url2 .= '..';
        }

        $block['content'] .= "$a:&nbsp;<a href=\"" . $row['data'] . "\">$url2</a><br>";

        $a++;
    }

    if ('on' == $options[2]) {
        $block['content'] .= '</marquee>';
    }

    return $block;
}

function b_LastReferers_edit($options)
{
    //error_reporting(E_ALL);

    $form = '' . _MB_INCBLOCKS_LASTREFERERS_DISP . '&nbsp;';

    $form .= '<input type="text" name="options[]" value="' . $options[0] . '">&nbsp;' . _MB_INCBLOCKS_LASTREFERERS_NBR . '';

    $selup = '';

    $seldown = '';

    $selleft = '';

    $selright = '';

    switch ($options[1]) {
        case 'up':
            $selup = 'selected';
            break;
        case 'down':
            $seldown = 'selected';
            break;
        case 'left':
            $selleft = 'selected';
            break;
        case 'right':
            $selright = 'selected';
            break;
    }

    $form .= '<br>' . _MB_INCBLOCKS_LASTREFERERS_DIRSCROLL . "&nbsp;<select name=\"options[]\"><option $selup value=\"up\">UP</option><option $seldown value=\"down\">DOWN</option><option $selleft value=\"left\">LEFT</option><option $selright value=\"right\">RIGHT</option></select>";

    if ('on' == $options[2]) {
        $selon = 'selected';

        $seloff = '';
    } else {
        $selon = 'selected';

        $seloff = '';
    }

    $form .= '<br>' . _MB_INCBLOCKS_LASTREFERERS_SCROLLONOFF . "&nbsp;<select name=\"options[]\"><option $selon value=\"on\">ON</option><option $seloff value=\"off\">OFF</option></select>";

    return $form;
}
