<?php
$code_data = $this->MovieDB->get_movie_list_by_code($code_id);
$data['movie_list'] = $code_data['items'];

echo('<div class="movies_category_title"><span class="movies_category_title">'
        . code_name($code_id) . '</span>'
        . '&nbsp;&nbsp;<span class="movies_small">(' . count($data['movie_list']) . ')</span></div>');

$data['show_scores'] = false;
$this->load->view('movies/movie_list', $data);
?>