<?php
$language_data = $this->MovieDB->get_movie_list_by_language($language_id);
$data['movie_list'] = $language_data['items'];

echo('<div class="movies_category_title"><span class="movies_category_title">'
        . $language['language_name']
        . '&nbsp;-&nbsp;' 
        . $language['native_language_name']
        . '</span>'
        . '&nbsp;&nbsp;<span class="movies_small">(' . count($data['movie_list']) . ')</span></div>');

$data['show_scores'] = false;
$this->load->view('movies/movie_list', $data);
?>
