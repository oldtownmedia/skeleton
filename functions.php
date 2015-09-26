<?php

// Load in all of our various function files
foreach ( glob( get_template_directory_uri() . "/includes/*.php", GLOB_NOSORT ) as $filename ){
    require_once $filename;
}