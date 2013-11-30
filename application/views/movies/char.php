<?php
$data['movie_list'] = $this->MovieDB->get_movie_list_by_char($char);

echo("<div class=\"movies_category_title\"><span class=\"movies_category_title\">$char ...</span>"
        . '&nbsp;&nbsp;<span class="movies_small">(' . count($data['movie_list']) . ')</span></div>');

$data['show_scores'] = false;
$this->load->view('movies/movie_list', $data);
?>

