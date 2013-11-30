<table class="movies_list">
    <tbody>
        <?php
        echo('<tr>');
        for ($i = 1; $i <= count($people_list); $i++) {
            echo('<td>'
            . person_link(
                    $people_list[$i-1]['people_id'],
                    str_replace("<br/>", "&nbsp;", $people_list[$i-1]['people_name'])
                    )
            . '&nbsp;<span class="movies_small">(' . $people_list[$i-1]['item_count'] . ')</span></td>'
            );

            if ($i % 3 == 0) {
                echo('</tr><tr>');
            }
        }
        echo('</tr>');
        ?>
    </tbody>
</table>

<div class="movies_header_spacing">&nbsp;</div>