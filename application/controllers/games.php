<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class games extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');

        $this->load->helper('game');
        $this->load->library('pdo_db');
        $this->load->model('GameDB');

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
        $data['current_page'] = 'games';
        $data['show_scores'] = false;
        $view = $method;

        // used by the header & statistics
        $data['genre_list'] = $this->GameDB->get_genre_list_ordered_by_title();
        $data['number_of_games'] = $this->GameDB->get_number_of_games();
        $dates = $this->GameDB->get_dates();
        foreach ($dates as $date) {
            if ($date['date_id'] == '2') {
                $data['last_update_date'] = $date['date'];
            } else if ($date['date_id'] == '1') {
                $data['ground_zero_date'] = strtotime($date['date']);
            }
        }

        switch ($method) {
            case "game":
                $data['game_id'] = $this->uri->segment(3, 0);
                $data['game'] = $this->GameDB->get_game_by_id($data['game_id']);
                $data['title'] = 'Game Database &raquo; show game &raquo; ' . game_name($data['game']['item_title']);
                $view = 'games/game';
                break;
            case "search":
                $search = $this->input->post('searchinput');
                $data['title'] = 'Game Database &raquo; search';
                $view = 'games/game_list';
                $data['game_list'] = $this->GameDB->get_game_list_by_search($search);
                break;
            case "statistics":
                $data['title'] = 'Game Database &raquo; statistics';
                $view = 'games/statistics';
                break;
            case "current":
                $data['title'] = 'Game Database &raquo; show currently playing';
                $view = 'games/currently_playing';
                break;
            case "awards":
                $data['title'] = 'Game Database &raquo; show awards';
                $view = 'games/awards';
                break;
            case "company":
                $data['company_id'] = $this->uri->segment(3, 0);
                $data['company_name'] = $this->GameDB->get_company_name_by_id($data['company_id']);
                $data['title'] = 'Game Database &raquo; show company &raquo; ' . $data['company_name'];
                $view = 'games/company';
                break;
            case "developers":
                $data['title'] = 'Game Database &raquo; show all developers';
                $view = 'games/developer_list';
                break;
            case "publishers":
                $data['title'] = 'Game Database &raquo; show all publishers';
                $view = 'games/publisher_list';
                break;
            case "systems":
                $data['title'] = 'Game Database &raquo; show by system';
                $view = 'games/system_list';
                break;
            case "system":
                $data['system'] = $this->uri->segment(3, 0);
                $data['title'] = 'Movie Database &raquo; show by system &raquo; ' . $data['system'];
                $view = 'games/system';
                break;
            case "ratings":
                $data['title'] = 'Game Database &raquo; show by rating';
                $view = 'games/rating_list';
                break;
            case "rating":
                $rating = $this->uri->segment(3, 0);
                if (!preg_match('/(18|16|12|7|3)/', $rating)) {
                    redirect(site_url("games/ratings"));
                }
                $data['title'] = 'Game Database &raquo; show by rating &raquo; ' . $rating;
                $data['rating'] = $rating;
                $view = 'games/rating';
                break;
            case "scores":
                $data['title'] = 'Game Database &raquo; show by score';
                $view = 'games/game_list';
                $data['game_list'] = $this->GameDB->get_game_list_ordered_by_score();
                $data['show_scores'] = true;
                break;
            case "score":
                $score = $this->uri->segment(3, 0);
                $data['title'] = 'Game Database &raquo; show by score &raquo; ' . $score;
                $view = 'games/game_list';
                $data['game_list'] = $this->GameDB->get_game_list_by_score($score);
                $data['show_scores'] = true;
                break;
            case "genre":
                $data['genre_id'] = $this->uri->segment(3, 0);
                $data['genre_name'] = $this->GameDB->get_genre_name_by_id($data['genre_id']);
                $data['title'] = 'Game Database &raquo; show by genre &raquo; ' . $data['genre_name'];
                $view = 'games/genre';
                break;
            case "title":
                $data['char'] = $this->uri->segment(3, "A");
                $data['title'] = 'Game Database &raquo; show by title &raquo; ' . $data['char'];
                $view = 'games/char';
                break;
            case "index":
            case "welcome":
            case "names":
            default:
                $data['title'] = 'Game Database &raquo; show all';
                $view = 'games/game_list';
                $data['game_list'] = $this->GameDB->get_game_list_ordered_by_title();
                break;
        }

        $this->load->view('header', $data);
        $this->load->view('games/header', $data);
        $this->load->view($view, $data);
        $this->load->view('footer', $data);
    }

}

/* End of file games.php */
/* Location: ./application/controllers/games.php */