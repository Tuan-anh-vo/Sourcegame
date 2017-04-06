<?php if($list_event) foreach ($list_event as $k => $vl) {
    $name_event[$vl->id] = CutText($vl->name,60);
}
    if($servers) foreach ($servers as $k => $vl) {
    $name_sever[$vl->id] = CutText($vl->name,60);
}

?>
<div class="content_table">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <th class="th_no_cursor" width="40">No.</th>
            <th class="th_left th_no_cursor">
                <div id="title">User</div>
            </th>
            <th width="200" class='th_no_cursor'>
                <div id="status">Event</div>
            </th>
            <th width="200" class='th_no_cursor'>
                <div id="status">Server</div>
            </th>
            <th width="200" class='th_no_cursor'>
                <div id="status">Award Name</div>
            </th>
            <th width="80" class='th_no_cursor'>
                <div id="status">Award Sum</div>
            </th>
            <th width="80" class='th_no_cursor'>
                <div id="status">Level Award</div>
            </th>
            <th class="th_last" width="100" onclick="sort('created')">
                <div id="created" class="sort icon_sort_asc">Created</div>
            </th>
        </tr>
        <?php
        if ($result) {
            $i = 0;
            foreach ($result as $k => $v) {
                ?>
                <tr class="item_row<?= $i ?> <?php ($k % 2 == 0) ? print 'row1' : print 'row2' ?>">
                    <td class="td_center"><?= $k + 1 + $start ?></td>
                    <td class="th_left"><a href="avascript:;"><?= $v->username ?></a>
                    </td>
                    <td class="th_left"><a href="javascript:;"><?= $name_event[$v->id_event] ?></a>
                    </td>
                    <td class="th_left"><a href="javascript:;"><?= $name_sever[$v->server_id] ?></a>
                    </td>
                    <td class="th_left"><a href="javascript:;"><?= $v->award_name ?></a>
                    </td>
                    <td class="th_left"><a href="javascript:;"><?= $v->award_sum ?></a>
                    </td>
                    <td class="th_left"><a href="javascript:;"><?= $v->level_award ?></a>
                    </td>
                    <td class="th_last td_center"><?= date('d-m-Y H:i:s', strtotime($v->created)) ?></td>
                </tr>
                <?php $i++;
            }
        } else { ?>
            <tr class="row1">
                <td class="th_last td_center" colspan="50" style="font-size: 20px; padding: 50px 0">No data</td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php if ($result) { ?>
    <div class="footer_table">
        <div class="item_per_page">Items per page:</div>
        <div class="select_per_page">
            <select id="per_page" onchange="searchContent(<?= $start ?>,this.value)">
                <option <?php ($per_page == 10) ? print 'selected="selected"' : print '' ?> value="10">10</option>
                <option <?php ($per_page == 25) ? print 'selected="selected"' : print '' ?> value="25">25</option>
                <option <?php ($per_page == 50) ? print 'selected="selected"' : print '' ?> value="50">50</option>
                <option <?php ($per_page == 100) ? print 'selected="selected"' : print '' ?> value="100">100</option>
            </select>
        </div>

        <div class="pagination"><?= $this->adminpagination->create_links(); ?></div>
    </div>
    <div class="clearAll"></div>
<?php } ?>