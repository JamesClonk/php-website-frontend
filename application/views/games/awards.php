<table class="games_list">
    <thead>
    <th>award</th>
    <th>game</th>
</thead>
<tbody>
    <?php
    $award_list = $this->GameDB->get_award_list();

    foreach ($award_list as $award) {
        echo('<tr><td class="games_bold"><div class="games_header_spacing">&nbsp;</div>' . $award['award_desc'] . '</td>');
        echo('<td><div class="games_header_spacing">&nbsp;</div>'
                . system_icon($award['item_system'])
                . '&nbsp;'
                . game_link(
                $award['item_id'],
                game_name($award['item_title']),
                NULL)
                . '&nbsp;<span class="games_small">(' . $award['item_release'] . ')</span>'
                . '<br/><span class="games_small">' . stars_link($award['item_rating'])
                . '&nbsp;' . $award['item_rating'] 
                . '&nbsp;/&nbsp;5</span></td></tr>'
        );
    }
    ?>
</tbody>
</table>

<div class="games_header_spacing">&nbsp;</div>
