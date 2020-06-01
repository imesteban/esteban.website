<?php

require_once INCLUDES_DIR . '/blocks/big-text-block.php';
require_once INCLUDES_DIR . '/blocks/three-col-content-block.php';
require_once INCLUDES_DIR . '/blocks/three-col-titles-block.php';
require_once INCLUDES_DIR . '/blocks/flag-block.php';

EDA\Blocks\BigTextBlock::bootstrap();
EDA\Blocks\ThreeColContentBlock::bootstrap();
EDA\Blocks\ThreeColTitlesBlock::bootstrap();
EDA\Blocks\FlagBlock::bootstrap();