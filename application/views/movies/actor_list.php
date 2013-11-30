<div class="movies_category_title">
    <span class="movies_category_title">Actors</span>
</div>
<?php
$data['people_list'] = $this->MovieDB->get_actor_list_ordered_by_name();
$this->load->view('movies/people_list', $data);
?>
