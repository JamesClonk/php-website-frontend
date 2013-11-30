<div class="movies_category_title">
    <span class="movies_category_title">Statistics</span>
</div>

<?php
// #avg_movies_per_day, #est_new_movies
$sysdate = time();
$avgdvd = ($number_of_movies / ((strtotime($last_update_date) - $ground_zero_date) / (60 * 60 * 24)));
$days_last_update = (($sysdate - strtotime($last_update_date)) / (60 * 60 * 24));
$dvdestimate = round(($days_last_update * $avgdvd), 1);
$avgdvd = round($avgdvd, 2);

// get statistics data
$statistics = $this->MovieDB->get_statistics_data();

// #dvd_movies, #bluray_movies, #dvd_discs, #bluray_discs
$movie_type_count = $statistics['movie_type_count'];

//
$lengthsum = $statistics['length_sum']['length'];
$lengthavgmovie = round($lengthsum / $number_of_movies);
$lengthavgdisc = round($lengthsum / ($movie_type_count[0]['discs'] + $movie_type_count[1]['discs']));

// #actors, #directors, #total
$people_count = $statistics['people_count'];

// =============================================================================
// movie_per_code/region
$code_count = $statistics['code_count'];

// movie_per_score
$score_count = $statistics['score_count'];

// movie_per_rating
$rating_count = $statistics['rating_count'];
?>

<div class="movies_stats">
    Last&nbsp;update:&nbsp;<span class="movies_stats_number"><?php echo($last_update_date); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Average&nbsp;Movies&nbsp;per&nbsp;day:&nbsp;<span class="movies_stats_number"><?php echo($avgdvd); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Est.&nbsp;new&nbsp;Movies:&nbsp;<span class="movies_stats_number"><?php echo($dvdestimate); ?></span>
</div>

<div class="movies_stats">
    #Movies:&nbsp;<span class="movies_stats_number"><?php echo($number_of_movies); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #DVD&nbsp;Movies:&nbsp;<span class="movies_stats_number"><?php echo($movie_type_count[0]['movies']); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #BluRay&nbsp;Movies:&nbsp;<span class="movies_stats_number"><?php echo($movie_type_count[1]['movies']); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #DVD&nbsp;Discs:&nbsp;<span class="movies_stats_number"><?php echo($movie_type_count[0]['discs']); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #BluRay&nbsp;Discs:&nbsp;<span class="movies_stats_number"><?php echo($movie_type_count[1]['discs']); ?></span>
</div>

<div class="movies_stats">
    #Total&nbsp;Length:&nbsp;<span class="movies_stats_number"><?php echo($lengthsum); ?>&nbsp;min.</span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Average&nbsp;/&nbsp;Movie:&nbsp;<span class="movies_stats_number"><?php echo($lengthavgmovie); ?>&nbsp;min.</span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Average&nbsp;/&nbsp;Disc:&nbsp;<span class="movies_stats_number"><?php echo($lengthavgdisc); ?>&nbsp;min.</span>
</div>

<div class="movies_stats">
    #Actors:&nbsp;<span class="movies_stats_number"><?php echo($people_count['actors']); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Directors:&nbsp;<span class="movies_stats_number"><?php echo($people_count['directors']); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
    #Total&nbsp;People:&nbsp;<span class="movies_stats_number"><?php echo($people_count['total']); ?></span>
</div>

<div class="movies_pane_left">
    <?php

    // create graphs for actors,directors and actor&director's
    function create_people_graph($list, $color, $title) {
        echo('<h4 class="movies_stats_title">' . $title . '</h4><table>');

        $sum = 0;
        foreach ($list as $item) {
            $sum += $item['count'];
        }

        $max_values = max($list);
        $multiplier = (400 - ($max_values['count'] / 2)) / $sum;
        $graph_height = 15;

        foreach ($list as $item) {
            $id = $item['people_id'];
            $name = $item['people_name'];
            $count = $item['count'];
            $graph_width = ceil($count * $multiplier);
            echo('<tr><td>' . person_link($id, $name) . '</td>');
            echo('<td><img src="' . base_url() . 'images/movies/graph_' . $color . '.png" style="height:'
            . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
            . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$count</td></tr>");
        }

        echo('</table>');
    }

    create_people_graph(
            $statistics['top5_actors'],
            'green', 'Top5&nbsp;&#8209;&nbsp;Actor:'
    );

    create_people_graph(
            $statistics['top5_directors'],
            'blue', 'Top5&nbsp;&#8209;&nbsp;Director:');

    create_people_graph(
            $statistics['top5_actors_and_directors'],
            'red', 'Top5&nbsp;&#8209;&nbsp;Actor&nbsp;&&nbsp;Director:');
    ?>
</div>

<div class="movies_pane_right">
    <h4 class="movies_stats_title">Movie&nbsp;/&nbsp;Code&nbsp;&amp;&nbsp;Region:</h4>
    <table>
        <?php
        $max_values = max($code_count);
        $multiplier = (500 - ($max_values['count'] / 2)) / $number_of_movies;
        $graph_height = 15;
        foreach ($code_count as $code) {
            $key = $code['item_code'];
            $value = $code['count'];
            $graph_width = ceil($value * $multiplier);
            echo('<tr><td>' . code_link($key, code_name($key)) . '</td>');
            echo('<td><img src="' . base_url() . 'images/movies/graph_black.png" style="height:'
            . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
            . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$value</td></tr>");
        }
        ?>
    </table>


    <h4 class="movies_stats_title">Movie&nbsp;/&nbsp;Score:</h4>
    <table>
        <?php
        $max_values = max($score_count);
        $multiplier = (500 - ($max_values['count'] / 2)) / $number_of_movies;
        $graph_height = 15;
        foreach ($score_count as $score) {
            $key = $score['item_rating'];
            $value = $score['count'];
            $graph_width = ceil($value * $multiplier);
            echo('<tr><td>' . stars_link($key) . '</td>');
            echo('<td><img src="' . base_url() . 'images/movies/graph_yellow.png" style="height:'
            . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
            . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$value</td></tr>");
        }
        ?>
    </table>

    
    <h4 class="movies_stats_title">Movie&nbsp;/&nbsp;Rating:</h4>
    <table>
        <?php
        $max_values = max($rating_count);
        $multiplier = (500 - ($max_values['count'] / 2)) / $number_of_movies;
        $graph_height = 15;
        foreach ($rating_count as $rating) {
            $key = $rating['item_fsk'];
            $value = $rating['count'];
            $graph_width = ceil($value * $multiplier);
            echo('<tr><td>' . rating_link($key, rating_name($key)) . '</td>');
            echo('<td><img src="' . base_url() . 'images/movies/graph_brown.png" style="height:'
            . $graph_height . 'px; width:' . $graph_width . 'px;" width="'
            . $graph_width . 'px" height="' . $graph_height . 'px">' . "&nbsp;$value</td></tr>");
        }
        ?>
    </table>
</div>

<br class="clear"/>
<br class="clear"/>
