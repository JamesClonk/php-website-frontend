<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MovieDB extends CI_Model {

    private $CI = null;

    function __construct($params = array()) {
        parent::__construct();

        $this->CI = & get_instance();

        // load backend url
        if (!array_key_exists("movie_backend_url", $params)) {
            if (!defined('ENVIRONMENT') || !file_exists($file_path = APPPATH . 'config/' . ENVIRONMENT . '/database' . EXT)) {
                if (!file_exists($file_path = APPPATH . 'config/database' . EXT)) {
                    show_error('The configuration file database' . EXT . ' does not exist');
                }
            }

            include($file_path);

            if (!isset($db) || count($db) == 0) {
                show_error('No database connection settings were found in the database config file');
            }

            if (isset($params['active_group']) && $params['active_group'] != '') {
                $active_group = $params['active_group'];
            }

            if (!isset($active_group) || !isset($db[$active_group])) {
                show_error('Invalid database connection group defined');
            }

            $params = array_merge($db[$active_group], $params);
        }

        if (!isset($params['movie_backend_url']) || $params['movie_backend_url'] == '') {
            show_error('No movie backend-URL defined');
        }

        $this->backend_url = $params['movie_backend_url'];
    }

    function get_data($url) {
        $url = $this->backend_url . "/" . $url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        //return json_decode(file_get_contents($url), true);
        return json_decode($result, true);
    }

    function get_dates() {
        return $this->get_data("dates");
    }

    function get_number_of_movies() {
        $result = $this->get_data("count");
        return $result['count'];
    }

    function get_statistics_data() {
        return $this->get_data("statistics");
    }

    function get_movie_code_count() {
        return $this->get_data("codes");
    }

    function get_movie_list_by_code($code) {
        return $this->get_data("code/$code");
    }

    function get_movie_list_by_language($language) {
        return $this->get_data("language/$language");
    }

    function get_movie_list_by_rating($rating) {
        if ($rating == "X") {
            $rating = '21';
        }
        $result = $this->get_data("rating/$rating");
        return $result['items'];
    }

    function get_movie_by_id($movie) {
        $result = $this->get_data("movie/$movie");
        return $result['item'];
    }

    function get_genre_by_id($genre_id) {
        $result = Array();
        $genre_list = $this->MovieDB->get_genre_list_ordered_by_title();
        foreach($genre_list as $genre) {
            if($genre['genre_id'] == $genre_id) { $result = $genre; }
        }
        return $result;
    }

    function get_genre_name_by_id($genre_id) {
        $result = $this->get_genre_by_id($genre_id);
        return $result['genre_name'];
    }

    function get_person_by_id($person) {
        return $this->get_data("person/$person");
    }

    function get_person_name_by_id($person) {
        $result = $this->get_person_by_id($person);
        return $result['person']['people_name'];
    }

    function get_movie_list_ordered_by_title() {
        return $this->get_data("");
    }

    function get_movie_list_ordered_by_score() {
        return $this->get_data("ordered_by_score");
    }
    
    function get_movie_list_ordered_by_id() {
        return $this->get_data("ordered_by_id");
    }

    function get_movie_list_by_search($search) {
        $result = $this->get_data("search/$search");
        return $result['items'];
    }

    function get_movie_list_by_actor($actor) {
        $result = $this->get_person_by_id($actor);
        return $result['acting'];
    }

    function get_movie_list_by_director($director) {
        $result = $this->get_person_by_id($director);
        return $result['directing'];
    }

    function get_movie_list_by_score($score) {
        $result = $this->get_data("score/$score");
        return $result['items'];
    }

    function get_movie_list_by_genre($genre) {
        $result = $this->get_data("genre/$genre");
        return $result['items'];
    }

    function get_movie_list_by_char($char) {
        $result = $this->get_data("title/$char");
        return $result['items'];
    }

    function get_actor_list_ordered_by_name() {
        return $this->get_data("actors");
    }

    function get_director_list_ordered_by_name() {
        return $this->get_data("directors");
    }

    function get_language_list_by_movie($movie) {
        $result = $this->get_data("movie/$movie");
        return $result['languages'];
    }

    function get_genre_list_by_movie($movie) {
        $result = $this->get_data("movie/$movie");
        return $result['genres'];
    }

    function get_actor_list_by_movie($movie) {
        $result = $this->get_data("movie/$movie");
        return $result['actors'];
    }

    function get_director_list_by_movie($movie) {
        $result = $this->get_data("movie/$movie");
        return $result['directors'];
    }

    function get_language_by_id($language_id) {
        $result = Array();
        $language_list = $this->MovieDB->get_language_list_ordered_by_name();
        foreach($language_list as $language) {
            if($language['language_id'] == $language_id) { $result = $language; }
        }
        return $result;
    }

    function get_language_list_ordered_by_name() {
        return $this->get_data("languages");
    }

    function get_genre_list_ordered_by_title() {
        return $this->get_data("genres");
    }

}

/* End of file MovieDB.php */
/* Location: ./application/models/MovieDB.php */