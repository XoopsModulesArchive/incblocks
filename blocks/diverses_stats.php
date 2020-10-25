<?php

// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
// Based on:                                                                 //
// myPHPNUKE Web Portal System - http://myphpnuke.com/                       //
// PHP-NUKE Web Portal System - http://phpnuke.org/                          //
// Thatware - http://thatware.org/                                           //
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
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //
function b_diverssats_show()
{
    global $xoopsDB, $xoopsConfig;

    $block = [];

    $block['title'] = 'Diverses Stats';

    $result = $xoopsDB->query('select uid, uname, level from ' . $xoopsDB->prefix('users') . "  where level='1' order by uid   DESC", 1);

    [$uid, $lastuser] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT uid from ' . $xoopsDB->prefix('users') . "  where level='1' order by uid   DESC", 1);

    [$numbers] = $xoopsDB->fetchRow($result);

    //$result = $xoopsDB->query("SELECT count(*) from ".$xoopsDB->prefix("v2_visitors")."  where year(date)=2002 ");

    //list($totalc) = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT count(*) from ' . $xoopsDB->prefix('mydownloads_downloads') . '');

    [$numrows2] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT count(*) from ' . $xoopsDB->prefix('bb_forums') . '');

    [$bbforum] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT count(*) from ' . $xoopsDB->prefix('mylinks_links') . '');

    [$links] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT count(comments) from ' . $xoopsDB->prefix('stories') . '');

    [$comment] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT count(*) from ' . $xoopsDB->prefix('stories') . '');

    [$news] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('select sum(hits) from ' . $xoopsDB->prefix('mylinks_links') . '');

    [$hitsliens] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT count(*) from ' . $xoopsDB->prefix('bb_posts') . '');

    [$bbpost] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT count(*) from ' . $xoopsDB->prefix('bb_topics') . '');

    [$bbtopîcs] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('select sum(hits) from ' . $xoopsDB->prefix('mydownloads_downloads') . '');

    [$hits] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('select sum(topic_views) from ' . $xoopsDB->prefix('bb_topics') . '');

    [$postviews] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('select sum(counter) from ' . $xoopsDB->prefix('stories') . '');

    [$storiesviews] = $xoopsDB->fetchRow($result);

    //$result = $xoopsDB->query("select count(*) from ".$xoopsDB->prefix("v2_visitors")." WHERE TO_DAYS(NOW()) = TO_DAYS(date) ");

    //list($visites) = $xoopsDB->fetchRow($result);

    //<b>$bbforum</b> Forums<br>

    //(<b>$bbpost</b> Posts & <b>$bbtopîcs</b> Topics)<br><br>

    $block['content'] = '<center><b>Unser neustes Mitglied</b><br> <a href="' . $xoopsConfig['xoops_url'] . "/userinfo.php?uid=$uid\"><b><FONT color=#ff0000>$lastuser</FONT></b></a><br><br>
<b> $numbers Registrierte Mitglieder</b> ( <a href=\"" . $xoopsConfig['xoops_url'] . '/modules/xoopsmembers/index.php"><b>Liste</b></a> )<br><br>
<a href="' . $xoopsConfig['xoops_url'] . "/modules/news/index.php\"><b>$news</b></a> Artikel<br>
(<b>$storiesviews</b> x gelesen)<br>
<b>$comment</b> Kommentare<br><br>
<a href=\"" . $xoopsConfig['xoops_url'] . "/modules/mydownloads/index.php\"><b>$numrows2</a> Dateien in unserer Downloadsektion</b><br>
(<b>$hits</b> x Downloads gezogen)<br><br>
<a href=\"" . $xoopsConfig['xoops_url'] . "/modules/mylinks/index.php\"><b>$links</a> Weblinks</b><br>
(<b>$hitsliens</b> Seitenbesuche aus unserer Weblink- Sektion)<br><br>
<b>$bbforum</b> Foren
(<b>$bbpost</b> Beiträge,<b>$bbtopîcs</b> Themen,<b>$postviews</b> x gelesen)

</center>";

    return $block;
}
