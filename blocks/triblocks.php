<?php

require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';

function b_incblocks_triblocks_show($options)
{
    global $xoopsDB, $xoopsTpl;

    $block = [];

    //$block['title'] = _MB_INCBLOCKS_TRIBLOCKS_TITLE;

    $now = time();

    $block_arr = [];

    $block_arr[] = new XoopsBlock($options[0]);

    $block_arr[] = new XoopsBlock($options[1]);

    $block_arr[] = new XoopsBlock($options[2]);

    // echo "TRIBLOCKS..................<br>";

    // echo "<pre>";print_r($block_arr);echo "</pre>";

    //error_reporting(E_ALL);

    //////////////  traitement blocs Xoops2  (tableau des blocs dans $block_arr)

    $block_count = count($block_arr);

    for ($i = 0; $i < $block_count; $i++) {
        $bcachetime = $block_arr[$i]->getVar('bcachetime');

        if (empty($bcachetime)) {
            $xoopsTpl->xoops_setCaching(0);
        } else {
            $xoopsTpl->xoops_setCaching(2);

            $xoopsTpl->xoops_setCacheTime($bcachetime);
        }

        $btpl = $block_arr[$i]->getVar('template');

        if ('' != $btpl) {
            if (empty($bcachetime) || !$xoopsTpl->is_cached('db:' . $btpl)) {
                //$xoopsLogger->addBlock($block_arr[$i]->getVar('name'));

                $bresult = $block_arr[$i]->buildBlock();

                if (!$bresult) {
                    continue;
                }

                $xoopsTpl->assign_by_ref('block', $bresult);

                $bcontent = $xoopsTpl->fetch('db:' . $btpl);

                $xoopsTpl->clear_assign('block');
            } else {
                //$xoopsLogger->addBlock($block_arr[$i]->getVar('name'), true, $bcachetime);

                $bcontent = $xoopsTpl->fetch('db:' . $btpl);
            }
        } else {
            $bid = $block_arr[$i]->getVar('bid');

            if (empty($bcachetime) || !$xoopsTpl->is_cached('db:system_dummy.html', 'blk_' . $bid)) {
                //$xoopsLogger->addBlock($block_arr[$i]->getVar('name'));

                $bresult = $block_arr[$i]->buildBlock();

                if (!$bresult) {
                    continue;
                }

                $xoopsTpl->assign_by_ref('dummy_content', $bresult['content']);

                $bcontent = $xoopsTpl->fetch('db:system_dummy.html', 'blk_' . $bid);

                $xoopsTpl->clear_assign('block');
            } else {
                //$xoopsLogger->addBlock($block_arr[$i]->getVar('name'), true, $bcachetime);

                $bcontent = $xoopsTpl->fetch('db:system_dummy.html', 'blk_' . $bid);
            }
        }

        ///////  fin traitmt bloc xoops2

        $block['contenu'][] = $bcontent;

        $block['titre'][] = $block_arr[$i]->getVar('title');
    } ///for

    return $block;
}

function b_incblocks_triblocks_edit($options)
{
    $form = '';

    error_reporting(E_ALL);

    $xoopsblock = new XoopsBlock();

    $block_arr = [];

    $block_arr = $xoopsblock->getAllBlocks();

    $block_count = count($block_arr);

    $form = '' . _MB_INCBLOCKS_TRIBLOCKS_1 . "&nbsp;<select name='options[]'>";

    for ($i = 0; $i < $block_count; $i++) {
        $form .= "<option value='" . $block_arr[$i]->getVar('bid') . "'";

        if ($options[0] == $block_arr[$i]->getVar('bid')) {
            $form .= " selected='selected'";
        }

        $form .= '>' . $block_arr[$i]->getVar('title') . "</option>\n";
    }

    $form .= "</select>\n";

    $form .= '<br>' . _MB_INCBLOCKS_TRIBLOCKS_2 . "&nbsp;<select name='options[]'>";

    for ($i = 0; $i < $block_count; $i++) {
        $form .= "<option value='" . $block_arr[$i]->getVar('bid') . "'";

        if ($options[1] == $block_arr[$i]->getVar('bid')) {
            $form .= " selected='selected'";
        }

        $form .= '>' . $block_arr[$i]->getVar('title') . "</option>\n";
    }

    $form .= "</select>\n";

    $form .= '<br>' . _MB_INCBLOCKS_TRIBLOCKS_3 . "&nbsp;<select name='options[]'>";

    for ($i = 0; $i < $block_count; $i++) {
        $form .= "<option value='" . $block_arr[$i]->getVar('bid') . "'";

        if ($options[2] == $block_arr[$i]->getVar('bid')) {
            $form .= " selected='selected'";
        }

        $form .= '>' . $block_arr[$i]->getVar('title') . "</option>\n";
    }

    $form .= "</select>\n";

    return $form;
}
