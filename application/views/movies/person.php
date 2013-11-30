<div class="movies_category_title">
    <span class="movies_category_title"><?php echo($person_name); ?></span>
</div>
<br/>

<?php
$data['movie_list'] = $this->MovieDB->get_movie_list_by_actor($person_id);

if (count($data['movie_list']) > 0) {
    echo("<div class=\"movies_category_title\"><span class=\"movies_category_title_small\">Actor</span>"
    . '&nbsp;&nbsp;<span class="movies_small">(' . count($data['movie_list']) . ')</span></div>');

    $data['show_scores'] = false;
    $this->load->view('movies/movie_list', $data);
}
?>

<?php
$data['movie_list'] = $this->MovieDB->get_movie_list_by_director($person_id);

if (count($data['movie_list']) > 0) {
    echo("<div class=\"movies_category_title\"><span class=\"movies_category_title_small\">Director</span>"
    . '&nbsp;&nbsp;<span class="movies_small">(' . count($data['movie_list']) . ')</span></div>');

    $data['show_scores'] = false;
    $this->load->view('movies/movie_list', $data);
}
?>

