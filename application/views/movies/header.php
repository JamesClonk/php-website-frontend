<div class="movies_pane_left">
    <h4>- Movie Database -</h4>
    <div class="movies_header_small"><?php echo($number_of_movies . ' @ ' . $last_update_date); ?></div>
    <div class="movies_header_spacing">show <?php echo(anchor("movies/statistics", "statistics")); ?></div>
</div>

<div class="movies_pane_right">
    <div class="movies_header_spacing">
        list all movies by:&nbsp;
        <?php echo(anchor("movies/names", "name")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("movies/scores", "score")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("movies/ratings", "rating")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("movies/codes", "code")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("movies/languages", "language")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("movies/id", "id")); ?>
    </div>
    <div class="movies_header_spacing">
        list all people by:&nbsp;
        <?php echo(anchor("movies/actors", "actors")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("movies/directors", "directors")); ?>
    </div>
    <div class="movies_header_spacing">
        list by score:&nbsp;
        <?php echo(stars_link(5)); ?>&nbsp;|&nbsp;
        <?php echo(stars_link(4)); ?>&nbsp;|&nbsp;
        <?php echo(stars_link(3)); ?>&nbsp;|&nbsp;
        <?php echo(stars_link(2)); ?>&nbsp;|&nbsp;
        <?php echo(stars_link(1)); ?>
    </div>
</div>

<br class="clear"/>
<div class="movies_header_spacing"></div>
<div class="movies_line"></div>

<div class="movies_header">
    list by genre:&nbsp;
    <?php
        $genres = "";
        foreach ($genre_list as $genre) {
            $genres .= genre_link($genre['genre_id'], $genre['genre_name']) . '&nbsp;| ';
        }
        echo(trim($genres, '&nbsp;| '));
    ?>
    </div>

    <div class="movies_pane_left">
        <div class="movies_header_borderless">
            list by title:&nbsp;
        <?php
        echo(title_link('number', '#'));

        $a = 65;
        while ($a < 91) {
            $char = chr($a);
            echo('&nbsp;' . title_link($char, NULL));
            $a++;
        }
        ?>
    </div>
</div>

<div class="movies_pane_right">
    <div class="movies_header_borderless">
        <?php
        echo(form_open('movies/search'));
        echo(form_fieldset());

        //echo(form_label('search&nbsp;by&nbsp;title,description:&nbsp;', 'searchinput'));
        $data = array(
            'name' => 'searchinput',
            'id' => 'searchinput',
            'value' => '',
            'class' => 'movies_search',
        );
        echo(form_input($data));
        echo(form_submit('search', 'search'));

        echo('</fieldset></form>');
        ?>
    </div>
</div>

<br class="clear"/>
<div class="movies_line"></div>
<div class="movies_header_spacing">&nbsp;</div>