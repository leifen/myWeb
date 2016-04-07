<?php
return array(
    'TMPL_PARSE_STRING'  => array(
        '__CSS__' => __ROOT__.'/Public/' .MODULE_NAME.'/css',
        '__JS__' => __ROOT__.'/Public/'.MODULE_NAME.'/js',
        '__IMG__' => __ROOT__.'/Public/'.MODULE_NAME.'/images' ,
    ),
    'TMPL_ACTION_ERROR' => 'Public/jump',
    'TMPL_ACTION_SUCCESS' => 'Public/jump',
);