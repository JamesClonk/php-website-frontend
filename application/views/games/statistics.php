<div class="games_category_title">
    <span class="games_category_title">Statistics</span>
</div>

<?php
// #avg_games_per_day, #est_new_games
$sysdate = time();
$avggame = ($number_of_games / ((strtotime($last_update_date) - $ground_zero_date) / (60 * 60 * 24)));
$days_last_update = (($sysdate - strtotime($last_update_date)) / (60 * 60 * 24));
$gameestimate = round(($days_last_update * $avggame), 1);
$avggame = round($avggame, 2);

// #developers, #publishers, #total
$company_count = $this->GameDB->get_company_count();

// =============================================================================
// game_per_score
$score_count = $this->GameDB->get_game_score_count();

// game_per_rating
$rating_count = $this->GameDB->get_game_rating_count();

// game_per_system
$system_count = $this->GameDB->get_game_system_count();
?>

<div class="games_stats">
    Last&nbsp;update:&nbsp;<span class="games_stats_number"><?php echo($last_update_date); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Average&nbsp;games&nbsp;per&nbsp;day:&nbsp;<span class="games_stats_number"><?php echo($avggame); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Est.&nbsp;new&nbsp;games:&nbsp;<span class="games_stats_number"><?php echo($gameestimate); ?></span>
</div>

<div class="games_stats">
    #Games:&nbsp;<span class="games_stats_number"><?php echo($number_of_games); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Systems:&nbsp;<span class="games_stats_number"><?php echo(count($system_count)); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Developers:&nbsp;<span class="games_stats_number"><?php echo($company_count['developers']); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Publishers:&nbsp;<span class="games_stats_number"><?php echo($company_count['publishers']); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Total&nbsp;Companies:&nbsp;<span class="games_stats_number"><?php echo($company_count['total']); ?></span>
</div>

<div class="games_pane_left">
    <?php

    // create graphs for developers,publishers and developer&publishers
    function create_company_graph($list, $color, $title) {
        echo('<h4 class="games_stats_title">' . $title . '</h4><table>');

        $sum = 0;
        foreach ($list as $item) {
            $sum += $item['count'];
        }

        $max_values = max($list);
        $multiplier = (400 - ($max_values['count'] / 2)) / $sum;
        $graph_height = 15;

        foreach ($list as $item) {
            $id = $item['company_id'];
            $name = $item['company_name'];
            $count = $item['count'];
            $graph_width = ceil($count * $multiplier);
            echo('<tr><td>' . company_link($id, $name) . '</td>');
            echo('<td><img src="' . base_url() . 'images/games/graph_' . $color . '.png" style="height:'
            . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
            . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$count</td></tr>");
        }

        echo('</table>');
    }

    create_company_graph(
            $this->GameDB->get_top5_developer_list(),
            'green', 'Top5&nbsp;&#8209;&nbsp;Developer:');

    create_company_graph(
            $this->GameDB->get_top5_publisher_list(),
            'blue', 'Top5&nbsp;&#8209;&nbsp;Publisher:');

    // create_company_graph(
            // $this->GameDB->get_top5_developer_and_publisher_list(),
            // 'red', 'Top5&nbsp;&#8209;&nbsp;Developer&nbsp;&amp;&nbsp;Publisher:');
    ?>

    <h4 class="games_stats_title">Game&nbsp;/&nbsp;Score:</h4>
    <table>
        <?php
        $max_values = max($score_count);
        $multiplier = (500 - ($max_values['count'] / 2)) / $number_of_games;
        $graph_height = 15;
        foreach ($score_count as $score) {
            $key = $score['item_rating'];
            $value = $score['count'];
            $graph_width = ceil($value * $multiplier);
            echo('<tr><td>' . stars_link($key) . '</td>');
            echo('<td><img src="' . base_url() . 'images/games/graph_yellow.png" style="height:'
            . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
            . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$value</td></tr>");
        }
        ?>
    </table>
</div>

<div class="games_pane_right">
    <h4 class="games_stats_title">Game&nbsp;/&nbsp;System:</h4>
    <table>
        <?php
        $max_values = max($system_count);
        $multiplier = (500 - ($max_values['count'] / 2)) / $number_of_games;
        $graph_height = 15;
        foreach ($system_count as $system) {
            $key = $system['item_system'];
            $value = $system['count'];
            $graph_width = ceil($value * $multiplier);
            echo('<tr><td>' . system_link($key, $key) . '</td>');
            echo('<td><img src="' . base_url() . 'images/games/graph_black.png" style="height:'
            . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
            . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$value</td></tr>");
        }
        ?>
    </table>

    <h4 class="games_stats_title">Game&nbsp;/&nbsp;Rating:</h4>
    <table>
        <?php
        $max_values = max($rating_count);
        $multiplier = (500 - ($max_values['count'] / 2)) / $number_of_games;
        $graph_height = 15;
        foreach ($rating_count as $rating) {
            $key = $rating['item_pegi'];
            $value = $rating['count'];
            $graph_width = ceil($value * $multiplier);
            echo('<tr><td>' . rating_link($key, rating_name($key)) . '</td>');
            echo('<td><img src="' . base_url() . 'images/games/graph_brown.png" style="height:'
            . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
            . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$value</td></tr>");
        }
        ?>
    </table>
</div>

<br class="clear"/>
<br class="clear"/>
