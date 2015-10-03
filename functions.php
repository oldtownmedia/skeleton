<?php
/*
 * File to load in all of our function files for easier organization.
 *
 * @package: skeleton
 */

foreach ( glob( TEMPLATEPATH . "/includes/*.php", GLOB_NOSORT ) as $filename ){
    require_once $filename;
}