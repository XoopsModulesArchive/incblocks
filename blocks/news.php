<?php

// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
// Based on:								     //
// myPHPNUKE Web Portal System - http://myphpnuke.com/	  		     //
// PHP-NUKE Web Portal System - http://phpnuke.org/	  		     //
// Thatware - http://thatware.org/					     //
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
require_once XOOPS_ROOT_PATH . '/modules/news/class/class.newsstory.php';
function b_incblocks_news_show($options)
{
    global $xoopsDB, $xoopsTpl;

    $block = [];

    //$block['title'] = _MB_INCBLOCKS_NEWS_TITLE;

    $now = time();

    $sarray = NewsStory::getAllPublished($options[1]);

    foreach ($sarray as $story) {
        $mystory = [];

        //$block['content'] .= "<tr class=\"bg1\"><td style=\"border-bottom:1px dotted\">";

        $introcount = mb_strlen($story->hometext());

        $fullcount = mb_strlen($story->bodytext());

        //$block['content'] .= "<b><a href='".XOOPS_URL."/modules/news/article.php?storyid=".$story->storyid()."'>".$story->title()."</a></b><br>";

        $mystory['title'] = $story->title();

        $mystory['story_id'] = $story->storyid();

        $imglink = '';

        if ($story->topicdisplay()) {
            $mystory['imglink'] = $story->imglink();
        } else {
            $mystory['imglink'] = '';
        }

        $mystory['hometext'] = $story->hometext();

        $mystory['fullcount'] = $fullcount;

        $mystory['more'] = _MB_INCBLOCKS_NEWS_READMORE;

        // recup auteur

        $user = new XoopsUser($story->uid);

        $mystory['poster'] = $user->uname();

        $mystory['posttime'] = formatTimestamp($story->created());

        if (false !== $mystory['poster']) {
            $mystory['poster'] = "<a href='" . XOOPS_URL . '/userinfo.php?uid=' . $user->uid() . "'>" . $mystory['poster'] . '</a>';
        } else {
            $mystory['poster'] = $xoopsConfig['anonymous'];
        }

        $ccount = $story->comments();

        $commentlink = '<a href="' . XOOPS_URL . '/modules/news/article.php?storyid=' . $story->storyid() . '';

        if (0 == $ccount) {
            $commentlink .= '">' . _MB_INCBLOCKS_NEWS_COMMENTS . '</a>';
        } else {
            if (1 == $ccount) {
                $commentlink .= '">' . _MB_INCBLOCKS_NEWS_ONECOMMENT . '</a>';
            } else {
                $commentlink .= '">';

                $commentlink .= sprintf(_MB_INCBLOCKS_NEWS_NUMCOMMENTS, $ccount);

                $commentlink .= '</a>';
            }
        }

        $mystory['commentlink'] = $commentlink;

        $xoopsTpl->assign('lang_postedby', _POSTEDBY);

        $xoopsTpl->assign('lang_on', _ON);

        $block['stories'][] = $mystory;
    }

    return $block;
}

function b_incblocks_news_edit($options)
{
    $form = '' . _MB_INCBLOCKS_NEWS_ORDER . "&nbsp;<select name='options[]'>";

    $form .= "<option value='published'";

    if ('published' == $options[0]) {
        $form .= " selected='selected'";
    }

    $form .= '>' . _MB_INCBLOCKS_NEWS_DATE . "</option>\n";

    $form .= "<option value='counter'";

    if ('counter' == $options[0]) {
        $form .= " selected='selected'";
    }

    $form .= '>' . _MB_INCBLOCKS_NEWS_HITS . "</option>\n";

    $form .= "</select>\n";

    $form .= '&nbsp;' . _MB_INCBLOCKS_NEWS_DISP . "&nbsp;<input type='text' name='options[]' value='" . $options[1] . "'>&nbsp;" . _MB_INCBLOCKS_NEWS_ARTCLS . '';

    return $form;
}
