<?php
$code_list = $this->MovieDB->get_movie_code_count();

foreach($code_list as $code) {
    $data['code_id'] = $code['item_code'];
    $this->load->view('movies/code', $data);
}
?>