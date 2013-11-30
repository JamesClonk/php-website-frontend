<div class="games_pane_left">
    <h4>- Game Database -</h4>
    <div class="games_header_small"><?php echo($number_of_games . ' @ ' . $last_update_date); ?></div>
    <div class="games_header_spacing">show <?php echo(anchor("games/statistics", "statistics")); ?></div>
</div>

<div class="games_pane_right">
    <div class="games_header_spacing">
        list all games by:&nbsp;
        <?php echo(anchor("games/names", "name")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("games/scores", "score")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("games/ratings", "rating")); ?>&nbsp;|&nbsp;
         <?php echo(anchor("games/systems", "system")); ?>
    </div>
    <div class="games_header_spacing">
        list all companies by:&nbsp;
        <?php echo(anchor("games/developers", "developers")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("games/publishers", "publishers")); ?>
    </div>
    <div class="games_header_spacing">
        list:&nbsp;
        <?php echo(anchor("games/current", "currently playing")); ?>&nbsp;|&nbsp;
        <?php echo(anchor("games/awards", "awards")); ?>
    </div>
    <div class="games_header_spacing">
        list by score:&nbsp;
        <?php echo(stars_link(5)); ?>&nbsp;|&nbsp;
        <?php echo(stars_link(4)); ?>&nbsp;|&nbsp;
        <?php echo(stars_link(3)); ?>&nbsp;|&nbsp;
        <?php echo(stars_link(2)); ?>&nbsp;|&nbsp;
        <?php echo(stars_link(1)); ?>
    </div>
</div>

<br class="clear"/>
<div class="games_header_spacing"></div>
<div class="games_line"></div>

<div class="games_header">
    list by genre:&nbsp;
    <?php
        $genres = "";
        foreach ($genre_list as $genre) {
            $genres .= genre_link($genre['genre_id'], $genre['genre_name']) . '&nbsp;| ';
        }
        echo(trim($genres, '&nbsp;| '));
    ?>
    </div>

    <div class="games_pane_left">
        <div class="games_header_borderless">
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

<div class="games_pane_right">
    <div class="games_header_borderless">
        <?php
        echo(form_open('games/search'));
        echo(form_fieldset());

        $data = array(
            'name' => 'searchinput',
            'id' => 'searchinput',
            'value' => '',
            'class' => 'games_search',
        );
        echo(form_input($data));
        echo(form_submit('search', 'search'));

        echo('</fieldset></form>');
        ?>
    </div>
</div>

<br class="clear"/>
<div class="games_line"></div>
<div class="games_header_spacing">&nbsp;</div>