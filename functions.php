<?php

// Load in all of our various function files
foreach ( glob( TEMPLATEPATH . "/includes/*.php", GLOB_NOSORT ) as $filename ){
    require_once $filename;
}