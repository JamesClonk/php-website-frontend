<?php
$system_list = $this->GameDB->get_system_list_ordered_by_name();

foreach($system_list as $system) {
    $data['system'] = $system['system'];
    $this->load->view('games/system', $data);
}
?>