<?php
defined('TYPO3') or die();

# This file is part of the extension CHF Base for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


// Register content for this extension
(function($extKey='chf_base') {

    // Backend customisation
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] = [
        'chf_base_simple' => 'EXT:' . $extKey . '/Configuration/RTE/CHFBaseSimple.yaml'
    ];

})();
