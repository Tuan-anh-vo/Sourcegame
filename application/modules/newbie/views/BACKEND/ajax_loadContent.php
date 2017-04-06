<?php if($server) foreach ($server as $key => $value) {
    $name_sever[$value->id] = $value->name;
}
    $name_sever[0] = 'Không có server';
    $notice[1] = 'Nhận vật phẩm đua top';
    $notice[0] = 'Nhận vật phẩm đập trứng';
?>
<div class="content_table">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <th class="th_no_cursor" width="40">No.</th>
            <th class="th_left" onclick="sort('title')">
                <div id="title" class="sort icon_no_sort">User</div>
            </th>
            <th width="200" onclick="sort('title')">
                <div id="title" class="sort icon_no_sort">Vật phẩm</div>
            </th>
            <th width="200" onclick="sort('title')">
                <div id="title" class="sort icon_no_sort">Số lượng</div>
            </th>
            <th width="200" onclick="sort('title')">
                <div id="title" class="sort icon_no_sort">Server</div>
            </th>
            <th width="200" onclick="sort('title')">
                <div id="title" class="sort icon_no_sort">Hạng</div>
            </th>
            <th width="200" onclick="sort('title')">
                <div id="title" class="sort icon_no_sort">Type</div>
            </th>
            <th class="th_last" width="100" onclick="sort('created')">
                <div id="created" class="sort icon_sort_asc">Created</div>
            </th>
        </tr>
        <?php
        if ($result) {
            $i = 0;
            foreach ($result as $k => $v) {
                $type = '';
                if($v->type = 1)    $type = 'Top Lực Chiến';
                else if($v->type = 2)    $type = 'Top Cấp Độ';
                else if($v->type = 3)    $type = 'Top Thời Trang';
                else if($v->type = 4)    $type = 'Top Trang Bị';
                ?>
                <tr class="item_row<?= $i ?> <?php ($k % 2 == 0) ? print 'row1' : print 'row2' ?>">
                    <td class="td_center"><?= $k + 1 + $start ?></td>
                    <td class="th_left"><a><?= $v->username ?></a>
                    </td>
                    <td class="td_center"><a><?= $v->itemid ?></a>
                    </td>
                    <td class="td_center"><a><?= $v->sum ?></a>
                    </td>
                    </td>
                    <td class="td_center"><a><?= $name_sever[$v->server_id];?></a>
                    </td>
                    <td class="td_center"><a><?= $v->rank;?></a>
                    </td>
                    <td class="td_center"><a><?= $type;?></a>
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
            <select id="per_page" onchange="searchContent2(<?= $start ?>,this.value)">
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