<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function stars_link($number) {
    $stars = "";
    for ($i = 0; $i < $number; $i++) {
        $stars .= anchor("movies/score/$number", '<img src="' . base_url() . 'images/movies/star.png" alt="*" />', 'class="movies_stars_link"');
    }
    return $stars;
}

function movie_name($title) {
    return str_replace("<br/>", "&nbsp;", $title);
}

function person_link($id, $title) {
    return anchor("movies/person/" . $id, $title);
}

function code_link($id, $title) {
    return anchor("movies/code/" . $id, $title);
}

function code_name($code) {
    return code_title($code) . '&nbsp;' . $code;
}

function code_title($code) {
    $word = "Code";
    if (preg_match("/(A|B|C)/", $code)) {
        $word = "Region";
    }
    return $word;
}

function genre_link($id, $title) {
    return anchor("movies/genre/" . $id, $title);
}

function rating_link($id, $title) {
    return anchor("movies/rating/" . $id, $title);
}

function rating_name($rating) {
    if (preg_match("/(X|21)/", $rating)) {
        return 'Rating&nbsp;X';
    }
    return $rating . '+ years';
}

function language_link($id, $title) {
    return anchor("movies/language/" . $id, $title);
}

function movie_link($id, $title, $score = NULL) {
    if (isset($score) && $score != NULL) {
        return stars_link($score) . '&nbsp;' . anchor("movies/movie/" . $id, $title);
    } else {
        return anchor("movies/movie/" . $id, $title);
    }
}

function title_link($char, $title = NULL) {
    if (isset($title) && $title != NULL) {
        return anchor("movies/title/" . $char, $title);
    } else {
        return anchor("movies/title/" . strtoupper($char), $char);
    }
}

/* End of file movie_helper.php */
/* Location: ./application/helpers/movie_helper.php */