<?php
$language_list = $this->MovieDB->get_language_list_ordered_by_name();

foreach($language_list as $language) {
    $data['language_id'] = $language['language_id'];
    $data['language'] = $language;
    $this->load->view('movies/language', $data);
}
?>