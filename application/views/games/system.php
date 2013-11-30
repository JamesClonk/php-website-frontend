<?php
$system = preg_replace("/(%20|_)/", " ", $system);

$data['game_list'] = $this->GameDB->get_game_list_by_system($system);

echo('<div class="games_category_title"><span class="games_category_title">'
        . $system
        . '</span>'
        . '&nbsp;&nbsp;<span class="games_small">(' . count($data['game_list']) . ')</span></div>');

$data['show_scores'] = false;
$this->load->view('games/game_list', $data);
?>
