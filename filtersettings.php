<?php

// WIDTH parameter
$settings->add(new admin_setting_configtext('filter_vimeo_width',
    get_string('width', 'filter_vimeo'),
    get_string('configwidth', 'filter_vimeo'), '576', PARAM_INT));

// HEIGHT parameter
$settings->add(new admin_setting_configtext('filter_vimeo_height',
    get_string('height', 'filter_vimeo'),
    get_string('configheight', 'filter_vimeo'), '324', PARAM_INT));