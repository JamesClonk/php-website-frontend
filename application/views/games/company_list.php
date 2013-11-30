<table class="games_list">
    <tbody>
        <?php
        echo('<tr>');
        for ($i = 1; $i <= count($company_list); $i++) {
            echo('<td>'
            . company_link(
                    $company_list[$i-1]['company_id'],
                    str_replace("<br/>", "&nbsp;", $company_list[$i-1]['company_name'])
                    )
            . '&nbsp;<span class="games_small">(' . $company_list[$i-1]['item_count'] . ')</span></td>'
            );

            if ($i % 3 == 0) {
                echo('</tr><tr>');
            }
        }
        echo('</tr>');
        ?>
    </tbody>
</table>

<div class="games_header_spacing">&nbsp;</div>