<?php
declare(strict_types=1);

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

// Use permissions of parent page on newly created pages
$GLOBALS['TYPO3_CONF_VARS']['BE']['defaultPageTSconfig'] .= '
    TCEMAIN.permissions.userid = copyFromParent
    TCEMAIN.permissions.groupid = copyFromParent
    TCEMAIN.permissions.user = copyFromParent
    TCEMAIN.permissions.group = copyFromParent
    TCEMAIN.permissions.everybody = copyFromParent
';
