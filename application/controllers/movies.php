<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Movies extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');

        $this->load->helper('movie');
        $this->load->model('MovieDB');

        // if session does not yet contain 'theme' then set it to 'black_and_white' by default
        if (!$this->session->userdata('theme')) {
            $this->session->set_userdata('theme', "default");
        }

        // store new value of 'theme' in the session if defined as a GET value
        if ($this->input->get('theme')) {
            $this->session->set_userdata('theme', $this->input->get('theme'));
        }
    }

    public function _remap($method, $parameters = array()) {
        $data['theme'] = $this->session->userdata('theme');
        $data['current_page'] = 'movies';
        $view = $method;

        // used by the header & statistics
        $data['genre_list'] = $this->MovieDB->get_genre_list_ordered_by_title();
        $data['number_of_movies'] = $this->MovieDB->get_number_of_movies();
        $dates = $this->MovieDB->get_dates();
        $data['last_update_date'] = $dates['last_update_date'];
        $data['ground_zero_date'] = strtotime($dates['ground_zero_date']);

        switch ($method) {
            case "movie":
                $data['movie_id'] = $this->uri->segment(3, 1);
                $data['movie'] = $this->MovieDB->get_movie_by_id($data['movie_id']);
                $data['title'] = 'Movie Database &raquo; show movie &raquo; ' . movie_name($data['movie']['item_title']);
                $view = 'movies/movie';
                break;
            case "search":
                $search = $this->input->post('searchinput');
                $data['title'] = 'Movie Database &raquo; search';
                $view = 'movies/movie_list';
                $data['movie_list'] = $this->MovieDB->get_movie_list_by_search($search);
                $data['show_scores'] = false;
                break;
            case "statistics":
                $data['title'] = 'Movie Database &raquo; statistics';
                $view = 'movies/statistics';
                break;
            case "person":
                $data['person_id'] = $this->uri->segment(3, 1);
                $data['person_name'] = $this->MovieDB->get_person_name_by_id($data['person_id']);
                $data['title'] = 'Movie Database &raquo; show person &raquo; ' . $data['person_name'];
                $view = 'movies/person';
                break;
            case "actors":
                $data['title'] = 'Movie Database &raquo; show all actors';
                $view = 'movies/actor_list';
                break;
            case "directors":
                $data['title'] = 'Movie Database &raquo; show all directors';
                $view = 'movies/director_list';
                break;
            case "codes":
                $data['title'] = 'Movie Database &raquo; show by code';
                $view = 'movies/code_list';
                break;
            case "code":
                $data['code_id'] = $this->uri->segment(3, 0);
                $data['title'] = 'Movie Database &raquo; show by code &raquo; ' . strtolower(code_name($data['code_id']));
                $view = 'movies/code';
                break;
            case "languages":
                $data['title'] = 'Movie Database &raquo; show by language';
                $view = 'movies/language_list';
                break;
            case "language":
                $data['language_id'] = $this->uri->segment(3, 1);
                $data['language'] = $this->MovieDB->get_language_by_id($data['language_id']);
                $data['title'] = 'Movie Database &raquo; show by language &raquo; ' . $data['language']['language_name'];
                $view = 'movies/language';
                break;
            case "ratings":
                $data['title'] = 'Movie Database &raquo; show by rating';
                $view = 'movies/rating_list';
                break;
            case "rating":
                $rating = $this->uri->segment(3, 6);
                if (!preg_match('/(X|21|18|16|12|6)/', $rating)) {
                    redirect(site_url("movies/ratings"));
                }
                $data['title'] = 'Movie Database &raquo; show by rating &raquo; ' . $rating;
                $data['rating'] = $rating;
                $view = 'movies/rating';
                break;
            case "id":
                $data['title'] = 'Movie Database &raquo; show by id';
                $view = 'movies/movie_list';
                $data['movie_list'] = $this->MovieDB->get_movie_list_ordered_by_id();
                $data['show_scores'] = false;
                break;
            case "scores":
                $data['title'] = 'Movie Database &raquo; show by score';
                $view = 'movies/movie_list';
                $data['movie_list'] = $this->MovieDB->get_movie_list_ordered_by_score();
                $data['show_scores'] = true;
                break;
            case "score":
                $score = $this->uri->segment(3, 1);
                $data['title'] = 'Movie Database &raquo; show by score &raquo; ' . $score;
                $view = 'movies/movie_list';
                $data['movie_list'] = $this->MovieDB->get_movie_list_by_score($score);
                $data['show_scores'] = true;
                break;
            case "genre":
                $data['genre_id'] = $this->uri->segment(3, 1);
                $data['genre_name'] = $this->MovieDB->get_genre_name_by_id($data['genre_id']);
                $data['title'] = 'Movie Database &raquo; show by genre &raquo; ' . $data['genre_name'];
                $view = 'movies/genre';
                break;
            case "title":
                $data['char'] = $this->uri->segment(3, "A");
                $data['title'] = 'Movie Database &raquo; show by title &raquo; ' . $data['char'];
                $view = 'movies/char';
                break;
            case "index":
            case "welcome":
            case "names":
            default:
                $data['title'] = 'Movie Database &raquo; show all';
                $view = 'movies/movie_list';
                $data['movie_list'] = $this->MovieDB->get_movie_list_ordered_by_title();
                $data['show_scores'] = false;
                break;
        }

        $this->load->view('header', $data);
        $this->load->view('movies/header', $data);
        $this->load->view($view, $data);
        $this->load->view('footer', $data);
    }

}

/* End of file movies.php */
/* Location: ./application/controllers/movies.php */