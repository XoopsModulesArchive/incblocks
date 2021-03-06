<?php

function b_incblocks_Toplinks_show($options)
{
    global $xoopsDB, $xoopsConfig;

    $block = [];

    $block['title'] = 'Info Liens';

    $block['content'] = '';

    /************************/ /*      Variables       */

    /************************/

    $linkstoshow = $options[0];

    $usemarquee = $options[1];

    $scrolldirection = $options[2];

    $most = _MB_INCBLOCKS_TOP_MOSTLINKS;

    $latest = _MB_INCBLOCKS_TOP_LATESTLINKS;

    $totalfiles = _MB_INCBLOCKS_TOP_FILESLINKS;

    $totalcategories = _MB_INCBLOCKS_TOP_CATLINKS;

    $totaldownloads = _MB_INCBLOCKS_TOP_TOTALLINKS;

    $hitstext = _MB_INCBLOCKS_TOP_HITSLINKS;

    /************************/ /*     End Variables    */ /************************/

    global $prefix, $dbi;

    // Total Files

    $result = $xoopsDB->query('select * from ' . $xoopsDB->prefix('mylinks_links'));

    $files = $xoopsDB->getRowsNum($result);

    // Total Categories

    $result = $xoopsDB->query('select * from ' . $xoopsDB->prefix('mylinks_cat'));

    $cats = $xoopsDB->getRowsNum($result);

    // Total Downloads

    $result = $xoopsDB->query('select hits from ' . $xoopsDB->prefix('mylinks_links'));

    $a = 1;

    $total_hits = 0;

    while (list($hits) = $xoopsDB->fetchRow($result)) {
        $total_hits += $hits;

        $a++;
    }

    $block['content'] .= "<i>$totalfiles:</i> <b>$files</b><br><i>$totalcategories:</i> <b>$cats</b><br> <i>$totaldownloads:</i> <b>$total_hits</b><br>";

    if ('on' == $usemarquee) {
        $block['content'] .= "<Marquee Behavior=\"Scroll\" Direction=\"$scrolldirection\" Height=\"140\" ScrollAmount=\"2\" ScrollDelay=\"100\" onMouseOver=\"this.stop()\" onMouseOut=\"this.start()\"><br>";
    }

    // Latest added

    $block['content'] .= $latest . '<br>';

    $a = 1;

    $result = $xoopsDB->query('select lid, title, hits from ' . $xoopsDB->prefix('mylinks_links') . ' order by date DESC ', $linkstoshow, 0);

    while (list($lid, $title, $hits) = $xoopsDB->fetchRow($result)) {
        $title2 = preg_replace('_', ' ', $title);

        $block['content'] .= "<strong><big>&middot;</big></strong>&nbsp;$a: <a href=\"" . $xoopsConfig['xoops_url'] . "/modules/mylinks/singlelink.php?lid=$lid\">$title2</a><br>[$hitstext:&nbsp;$hits]<br>";

        $a++;
    }

    // Most downloaded

    $block['content'] .= '<br>' . $most . '<br>';

    $a = 1;

    $result = $xoopsDB->query('select lid, title, hits from ' . $xoopsDB->prefix('mylinks_links') . ' order by hits DESC ', $linkstoshow, 0);

    while (list($lid, $title, $hits) = $xoopsDB->fetchRow($result)) {
        $title2 = preg_replace('_', ' ', $title);

        $block['content'] .= "<strong><big>&middot;</big></strong>&nbsp;$a: <a href=\"" . $xoopsConfig['xoops_url'] . "/modules/mylinks/singlelink.php?lid=$lid\">$title2</a><br>[$hitstext:&nbsp;$hits]<br>";

        $a++;
    }

    if ('on' == $usemarquee) {
        $block['content'] .= '</marquee>';
    }

    return $block;
}

function b_incblocks_Toplinks_edit($options)
{
    $form = _MB_INCBLOCKS_TOP_TOSHOW . "&nbsp;<input type='text' name='options[]' value='" . $options[0] . "'><br>";

    if ('on' == $options[1]) {
        $chk = "checked='on'";
    } else {
        $chk = '';
    }

    $form .= _MB_INCBLOCKS_TOP_USEMARQUEE . "&nbsp;<input type='checkbox' name='options[]' $chk><br>";

    // choix up,down,left,right => liste déroulante!

    $form .= _MB_INCBLOCKS_TOP_SCROLLDIRECTION . "&nbsp;<select name='options[]'>";

    $selup = $seldown = $selleft = $selright = '';

    switch ($option[2]) {
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

    $form .= ''
             . "<option name=scrolldir value='up' $selup>"
             . _MB_INCBLOCKS_TOP_UP
             . '</option>'
             . "<option name=scrolldir value='down' $seldown>"
             . _MB_INCBLOCKS_TOP_DOWN
             . '</option>'
             . "<option name=scrolldir value='left' $selleft>"
             . _MB_INCBLOCKS_TOP_LEFT
             . '</option>'
             . "<option name=scrolldir value='right' $selright>"
             . _MB_INCBLOCKS_TOP_RIGHT
             . '</option>'
             . '</select>';

    return $form;
}
