<div class="games_category_title">
    <span class="games_category_title"><?php echo($company_name); ?></span>
</div>
<br/>

<?php
$data['game_list'] = $this->GameDB->get_game_list_by_developer($company_id);

if (count($data['game_list']) > 0) {
    echo("<div class=\"games_category_title\"><span class=\"games_category_title_small\">Developer</span>"
    . '&nbsp;&nbsp;<span class="games_small">(' . count($data['game_list']) . ')</span></div>');

    $data['show_scores'] = false;
    $this->load->view('games/game_list', $data);
}
?>

<?php
$data['game_list'] = $this->GameDB->get_game_list_by_publisher($company_id);

if (count($data['game_list']) > 0) {
    echo("<div class=\"games_category_title\"><span class=\"games_category_title_small\">Publisher</span>"
    . '&nbsp;&nbsp;<span class="games_small">(' . count($data['game_list']) . ')</span></div>');

    $data['show_scores'] = false;
    $this->load->view('games/game_list', $data);
}
?>

