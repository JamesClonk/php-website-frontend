<?php
$data['game_list'] = $this->GameDB->get_game_list_by_rating($rating);

echo('<img src="' . base_url() . 'images/games/pegi'
        . $rating . '.gif" alt="PEGI ' . $rating . '" class="games_ratings" /><br/>');

$data['show_scores'] = false;
$this->load->view('games/game_list', $data);
?>
