<?php
/**
 * User: nir
 * Date: 8/13/12
 * Time: 1:47 PM
 */
// WIDTH parameter
$settings->add(new admin_setting_configtext('filter_macamvimeo_width',
    get_string('width', 'filter_macamvimeo'),
    get_string('configwidth', 'filter_macamvimeo'), '576', PARAM_INT));

// HEIGHT parameter
$settings->add(new admin_setting_configtext('filter_macamvimeo_height',
    get_string('height', 'filter_macamvimeo'),
    get_string('configheight', 'filter_macamvimeo'), '324', PARAM_INT));