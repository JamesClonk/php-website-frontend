<?php
$genres = "";
$genre_list = $this->MovieDB->get_genre_list_by_movie($movie['item_id']);
foreach ($genre_list as $genre) {
    $genres .= genre_link($genre['genre_id'], $genre['genre_name']) . ', ';
}
$genres = trim($genres, ', ');

$languages = "";
$language_list = $this->MovieDB->get_language_list_by_movie($movie['item_id']);
foreach ($language_list as $language) {
    $languages .= language_link($language['language_id'], $language['language_name']) . ', ';
}
$languages = trim($languages, ', ');

$actors = "";
$actor_list = $this->MovieDB->get_actor_list_by_movie($movie['item_id']);
foreach ($actor_list as $actor) {
    $actors .= person_link($actor['people_id'], $actor['people_name']) . ', ';
}
$actors = trim($actors, ', ');

$directors = "";
$director_list = $this->MovieDB->get_director_list_by_movie($movie['item_id']);
foreach ($director_list as $director) {
    $directors .= person_link($director['people_id'], $director['people_name']) . ', ';
}
$directors = trim($directors, ', ');
?>

<div class="movies_movie_title">
    <span class="movies_movie_title"><?php echo(movie_name($movie['item_title'])); ?></span>
</div>
<div class="movies_movie_alttitle">
    <?php echo(movie_name($movie['item_alttitle'])); ?>
</div>

<div class="movies_movie">

    <div class="movies_movie_pane_left">
        <img src="<?php echo(base_url() . 'images/movies/covers/' . $movie['item_pic']); ?>" alt="<?php echo(movie_name($movie['item_title'])); ?>" />
    </div>

    <div class="movies_movie_pane_right">
        <table>
            <tr>
                <td class="movies_movie_left">Score:</td>
                <td><?php echo(stars_link($movie['item_rating'])); ?></td>
            </tr>
            <tr>
                <td class="movies_movie_left">Genre:</td>
                <td><?php echo($genres); ?></td>
            </tr>
            <tr>
                <td class="movies_movie_left">Language:</td>
                <td><?php echo($languages); ?></td>
            </tr>
            <tr>
                <td class="movies_movie_left">Year:</td>
                <td><?php echo($movie['item_year']); ?></td>
            </tr>
            <tr>
                <td class="movies_movie_left">Runtime:</td>
                <td><?php echo($movie['item_length']); ?>&nbsp;min.</td>
            </tr>
            <tr>
                <td class="movies_movie_left">Rating:</td>
                <td><?php echo(rating_link($movie['item_fsk'], rating_name($movie['item_fsk']))); ?></td>
            </tr>
            <tr>
                <td class="movies_movie_left">Format:</td>
                <td><?php echo($movie['item_format']); ?></td>
            </tr>
            <tr>
                <td class="movies_movie_left">Discs:</td>
                <td><?php echo($movie['item_dvds']); ?></td>
            </tr>
            <tr>
                <td class="movies_movie_left"><?php echo(code_title($movie['item_code'])); ?>:</td>
                <td><?php echo(code_link($movie['item_code'], code_name($movie['item_code']))); ?></td>
            </tr>
        </table>
    </div>

    <br class="clear"/>
</div>

<div class="movies_movie_cast">
    <table>
        <tr>
            <td class="movies_movie_left">Actors:</td>
            <td><?php echo($actors); ?></td>
        </tr>
        <tr>
            <td class="movies_movie_left">Directors:</td>
            <td><?php echo($directors); ?></td>
        </tr>
    </table>
</div>

<p class="movies_movie_desc"><?php echo($movie['item_desc']); ?></p>

<br class="clear"/>
