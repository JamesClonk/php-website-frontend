<table class="movies_list">
    <tbody>
        <?php
        echo('<tr>');
        for ($i = 1; $i <= count($movie_list); $i++) {
            echo('<td>'
            . movie_link(
                    $movie_list[$i-1]['item_id'],
                    movie_name($movie_list[$i-1]['item_title']),
                    $show_scores == true ? $movie_list[$i-1]['item_rating'] : NULL)
            . '&nbsp;<span class="movies_small">(' . $movie_list[$i-1]['item_year'] . ')</span></td>'
            );

            if ($i % 2 == 0) {
                echo('</tr><tr>');
            }
        }
        echo('</tr>');
        ?>
    </tbody>
</table>

<div class="movies_header_spacing">&nbsp;</div>