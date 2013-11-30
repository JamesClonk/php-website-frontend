<div class="movies_category_title">
    <span class="movies_category_title">Directors</span>
</div>
<?php
$data['people_list'] = $this->MovieDB->get_director_list_ordered_by_name();
$this->load->view('movies/people_list', $data);
?>

