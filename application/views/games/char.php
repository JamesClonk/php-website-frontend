<?php
if ($char == 'number') { $char = '#'; }

$data['game_list'] = $this->GameDB->get_game_list_by_char($char);

echo("<div class=\"games_category_title\"><span class=\"games_category_title\">$char ...</span>"
        . '&nbsp;&nbsp;<span class="games_small">(' . count($data['game_list']) . ')</span></div>');

$data['show_scores'] = false;
$this->load->view('games/game_list', $data);
?>

