<?php

$modversion['name'] = _MI_INCBLOCKS_NAME;
$modversion['version'] = 0.2;
$modversion['description'] = _MI_INCBLOCKS_DESC;
$modversion['credits'] = '';
$modversion['author'] = '<a href="http://www.inconnueteam.net">kyex for InconnueTeam</a>';
$modversion['help'] = '';
$modversion['license'] = 'GPL';
$modversion['official'] = 0;
$modversion['image'] = 'incblocks.jpg';
$modversion['dirname'] = 'incblocks';

// Menu
$modversion['hasMain'] = 0;

// Admin
$modversion['hasAdmin'] = 0;

// Blocks
$modversion['blocks'][1]['file'] = 'TopDown.php';
$modversion['blocks'][1]['name'] = _MI_INCBLOCKS_TOPDOWN_BNAME;
$modversion['blocks'][1]['description'] = 'Affiche les meilleurs downloads+les hits et combien de fois telechargés!';
$modversion['blocks'][1]['show_func'] = 'b_incblocks_TopDown_show';
$modversion['blocks'][1]['edit_func'] = 'b_incblocks_TopDown_edit';
$modversion['blocks'][1]['options'] = '5|on|up';
$modversion['blocks'][2]['file'] = 'Toplinks.php';
$modversion['blocks'][2]['name'] = _MI_INCBLOCKS_TOPLINKS_BNAME;
$modversion['blocks'][2]['description'] = 'Affiche les meilleurs liens+les hits et combien de fois visités!';
$modversion['blocks'][2]['show_func'] = 'b_incblocks_Toplinks_show';
$modversion['blocks'][2]['edit_func'] = 'b_incblocks_Toplinks_edit';
$modversion['blocks'][2]['options'] = '5|on|up';
$modversion['blocks'][3]['file'] = 'Topnews.php';
$modversion['blocks'][3]['name'] = _MI_INCBLOCKS_TOPNEWS_BNAME;
$modversion['blocks'][3]['description'] = 'Affiche les meilleurs News+les hits et combien de fois lues!';
$modversion['blocks'][3]['show_func'] = 'b_incblocks_Topnews_show';
$modversion['blocks'][3]['edit_func'] = 'b_incblocks_Topnews_edit';
$modversion['blocks'][3]['options'] = '5|on|up';

$modversion['blocks'][4]['file'] = 'news.php';
$modversion['blocks'][4]['name'] = _MI_INCBLOCKS_NEWS_BNAME;
$modversion['blocks'][4]['description'] = 'derniers articles';
$modversion['blocks'][4]['show_func'] = 'b_incblocks_news_show';
$modversion['blocks'][4]['edit_func'] = 'b_incblocks_news_edit';
$modversion['blocks'][4]['options'] = 'published|3';
$modversion['blocks'][4]['template'] = 'incblocks_news.html';

//diverses stats
$modversion['blocks'][5]['file'] = 'diverses_stats.php';
$modversion['blocks'][5]['name'] = _MI_INCBLOCKS_DIVERSESSATS_BNAME;
$modversion['blocks'][5]['description'] = 'Des diverses sats sur ton sites';
$modversion['blocks'][5]['show_func'] = 'b_diverssats_show';
//last_referer
$modversion['blocks'][6]['file'] = 'Referers.php';
$modversion['blocks'][6]['name'] = _MI_INCBLOCKS_LASTREFERER_BNAME;
$modversion['blocks'][6]['description'] = 'referant de ton site';
$modversion['blocks'][6]['show_func'] = 'b_LastReferers_show';
$modversion['blocks'][6]['edit_func'] = 'b_LastReferers_edit';
$modversion['blocks'][6]['options'] = '10|up|on';

//triblocks
$modversion['blocks'][7]['file'] = 'triblocks.php';
$modversion['blocks'][7]['name'] = _MI_INCBLOCKS_TRIBLOCKS_BNAME;
$modversion['blocks'][7]['description'] = 'trois blocs';
$modversion['blocks'][7]['show_func'] = 'b_incblocks_triblocks_show';
$modversion['blocks'][7]['edit_func'] = 'b_incblocks_triblocks_edit';
$modversion['blocks'][7]['options'] = '0|0|0';
$modversion['blocks'][7]['template'] = 'incblocks_triblocks.html';
