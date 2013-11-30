<div class="games_category_title">
    <span class="games_category_title">Developers</span>
</div>
<?php
$data['company_list'] = $this->GameDB->get_developer_list_ordered_by_name();
$this->load->view('games/company_list', $data);
?>
