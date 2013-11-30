<?php
$genres = "";
$genre_list = $this->GameDB->get_genre_list_by_game($game['item_id']);
foreach ($genre_list as $genre) {
    $genres .= genre_link($genre['genre_id'], $genre['genre_name']) . ',&nbsp;';
}
$genres = trim($genres, ',&nbsp;');

$developers = "";
$developer_list = $this->GameDB->get_developer_list_by_game($game['item_id']);
foreach ($developer_list as $developer) {
    $developers .= company_link($developer['company_id'], $developer['company_name']) . ',&nbsp;';
}
$developers = trim($developers, ',&nbsp;');

$publishers = "";
$publisher_list = $this->GameDB->get_publisher_list_by_game($game['item_id']);
foreach ($publisher_list as $publisher) {
    $publishers .= company_link($publisher['company_id'], $publisher['company_name']) . ',&nbsp;';
}
$publishers = trim($publishers, ',&nbsp;');
?>

<div class="games_game_title">
    <span class="games_game_title"><?php echo(game_name($game['item_title'])); ?></span>
</div>
<div class="games_game_alttitle">
    <?php echo(game_name($game['item_alttitle'])); ?>
</div>

<div class="games_game">

    <div class="games_game_pane_left">
        <img src="<?php echo(base_url() . 'images/games/covers/' . $game['item_pic']); ?>" alt="<?php echo(game_name($game['item_title'])); ?>" />
    </div>

    <div class="games_game_pane_right">
        <table>
            <tr>
                <td class="games_game_left">Score:</td>
                <td><?php echo(stars_link($game['item_rating'])); ?></td>
            </tr>
            <tr>
                <td class="games_game_left">System:</td>
                <td><?php echo(system_icon($game['item_system']) . '&nbsp;' . $game['item_system']); ?></td>
            </tr>
            <tr>
                <td class="games_game_left">Genre:</td>
                <td><?php echo($genres); ?></td>
            </tr>
            <tr>
                <td class="games_game_left">Players:</td>
                <td><?php echo($game['item_players']); ?></td>
            </tr>
            <tr>
                <td class="games_game_left">Rating:</td>
                <td><?php echo(rating_link($game['item_pegi'], rating_name($game['item_pegi']))); ?></td>
            </tr>
            <tr>
                <td class="games_game_left">Release:</td>
                <td><?php echo($game['item_release']); ?></td>
            </tr>
            <tr>
                <td class="games_game_left">Developer:</td>
                <td><?php echo($developers); ?></td>
            </tr>
            <tr>
                <td class="games_game_left">Publisher:</td>
                <td><?php echo($publishers); ?></td>
            </tr>
        </table>
    </div>

    <br class="clear"/>
</div>

<p class="games_game_desc"><?php echo($game['item_desc']); ?></p>

<br class="clear"/>

<!--<bgsound src="<?php echo(base_url() . 'images/games/musitsch/' . substr($game['item_pic'],0,-4) . '.mid'); ?>" loop="false"/>-->
<audio autoplay="autoplay" loop="loop">
  <source src="<?php echo(base_url() . 'images/games/musitsch/' . substr($game['item_pic'],0,-4)); ?>.ogg" type="audio/ogg" />
  <source src="<?php echo(base_url() . 'images/games/musitsch/' . substr($game['item_pic'],0,-4)); ?>.mp3" type="audio/mpeg" />
</audio>
