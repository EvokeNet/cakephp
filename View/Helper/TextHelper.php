<?php
/**
 * Text Helper class file
 *
 * Methods used to handle text
 */

App::uses('AppHelper', 'View/Helper');

class TextHelper extends AppHelper {
    public $helpers = array('Html');

    /**
     * Returns just the first words of a text without HTML tags
     * 
     * @param string $text Original text
     * @param int $number_of_words Number of words that will be extracted from the text
     * @param string $after_excerpt Text to be added after the excerpt. For example: "...", "<a>Read more</a>" etc.
     * @return string First N words from the text, without HTML
     */
    public function getExcerpt($text, $number_of_words, $after_excerpt = "") {
        // Replace new lines with space
        $text = str_replace("</p>", " ", $text);
        $text = str_replace("<br />", " ", $text);
        str_replace("\n", " ", $text);

        // Remove HTML
        $text = strip_tags($text);

        // \w[\w'-]* allows for any word character (a-zA-Z0-9_) and also contractions
        // and hyphenated words like 'range-finder' or "it's"
        // the /s flags means that . matches \n, so this can match multiple lines
        $text_filtered = split(" ", preg_replace("/^\W*((\w[\w'-]*\b\W*)*).*/ms", '\\1', $text));
        $text = preg_replace("/^\W*((\w[\w'-]*\b\W*){1,$number_of_words}).*/ms", '\\1', $text);

        // Add text after excerpt if the number of words was exceeded
        if (count($text_filtered) > $number_of_words) {
            return $text.$after_excerpt;
        }
        return $text;
    }
}