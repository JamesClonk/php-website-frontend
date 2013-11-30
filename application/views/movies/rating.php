<?php
if ($rating == '21') { $rating = 'X'; }

$data['movie_list'] = $this->MovieDB->get_movie_list_by_rating($rating);

echo('<img src="' . base_url() . 'images/movies/rating' 
        . $rating . '.jpg" alt="' . $rating . '" class="movies_ratings" /><br/>');

$data['show_scores'] = false;
$this->load->view('movies/movie_list', $data);
?>
