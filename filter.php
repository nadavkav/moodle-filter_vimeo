<?php
/**
 * Created by PhpStorm.
 * User: mofet
 * Date: 04/07/2017
 * Time: 13:16
 */

class filter_macamvimeo extends moodle_text_filter
{
    private $regex;
    private $height;
    private $width;

    public function __construct($context, array $localconfig)
    {
        parent::__construct($context, $localconfig);
        global $CFG;

        // set the regex
        $this->regex = '/(.*)<a ';
        $this->regex .= preg_quote('href="' . "vimeo://", '/');
        $this->regex .= '([\w|\/]*)';
        $this->regex .= preg_quote('">', '/');
        $this->regex .= '.*<\/a>';
        $this->regex .= '(.*)/iu';

        // get width and height from configuration
        $this->width = $CFG->filter_macamedia_width;
        $this->height = $CFG->filter_macamedia_height;
    }

    public function filter($text, array $options = array())
    {

        if (!is_string($text) or empty($text)) {
            // non string data can not be filtered anyway
            return $text;
        }

        if (stripos($text, '</a>') === false && stripos($text, '</iframe>') === false) {
            // Performance shortcut - if not </a> or </iframe> tag, nothing can match.
            return $text;
        }

        $newText = $text;


        do {
            $text = $newText;
            $newText = preg_replace_callback($this->regex, array($this, 'replace'), $text);
        } while (strcmp($text, $newText) !== 0);


        return $newText;
    }

    function replace($matches)
    {
        // irrelevant texts - return same text
        if (count($matches) < 4)
            return $matches[0];

        // relevant texts - extract data and return new text
        $media_id = $matches[2];

        if (empty($this->width))
            $this->width = CORE_MEDIA_VIDEO_WIDTH;

        if (empty($this->height))
            $this->height = CORE_MEDIA_VIDEO_HEIGHT;

        return '<iframe style="border:none;" src="https://player.vimeo.com/video/' . $media_id . '" width="' . $this->width . '" height="' . $this->height .
        '" frameborder="0"webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' ;
    }
}