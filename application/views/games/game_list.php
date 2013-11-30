<table class="games_list">
    <tbody>
        <?php
        echo('<tr>');
        for ($i = 1; $i <= count($game_list); $i++) {
            echo('<td>'
            . ($show_scores == true ? "" : system_icon($game_list[$i-1]['item_system']))
            . '&nbsp;'
            . game_link(
                    $game_list[$i-1]['item_id'],
                    game_name($game_list[$i-1]['item_title']),
                    $show_scores == true ? $game_list[$i-1]['item_rating'] : NULL)
            . '&nbsp;<span class="games_small">(' . $game_list[$i-1]['item_release'] . ')</span></td>'
            );

            if ($i % 2 == 0) {
                echo('</tr><tr>');
            }
        }
        echo('</tr>');
        ?>
    </tbody>
</table>

<div class="games_header_spacing">&nbsp;</div>