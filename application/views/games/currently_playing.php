<div class="games_category_title">
    <span class="games_category_title">Currently&nbsp;Playing</span>
</div>

<table>
    <tr>
    <thead>
    <th>game</th>
    <th>completion</th>
</thead>
</tr>
<tbody>
    <?php
    $game_list = $this->GameDB->get_game_list_currently_playing();

    $multiplier = 4;
    $graph_height = 15;
    foreach ($game_list as $game) {
        $percentage = $game['item_status'];
        $graph_width = ceil($percentage * $multiplier);

        echo('<tr><td>'
                . ($show_scores == true ? "" : system_icon($game['item_system']))
                . '&nbsp;'
                . game_link(
                $game['item_id'],
                game_name($game['item_title']),
                $show_scores == true ? $game['item_rating'] : NULL)
                . '&nbsp;<span class="games_small">(' . $game['item_release'] . ')</span></td>'
        );

        $graph_color = 'green';
        if($percentage <= 15) {
            $graph_color = 'red';
        }
        elseif($percentage <= 75) {
            $graph_color = 'blue';
        }

        echo('<td><img src="' . base_url() . 'images/games/graph_' . $graph_color . '.png" style="height:'
                . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
                . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$percentage%</td></tr>");
    }
    ?>
</tbody>
</table>

<div class="games_header_spacing">&nbsp;</div>
