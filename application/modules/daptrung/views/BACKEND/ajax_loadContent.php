<div class="content_table">
<div class="content_table">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <th class="th_no_cursor" width="40">No.</th>
            <th class="th_left" onclick="sort('title')">
                <div id="title" class="sort icon_no_sort">User</div>
            </th>

            <th width="70" onclick="sort('title')">
                <div id="status" class="sort icon_no_sort">Số lượt</div>
            </th>
            <th width="200" onclick="sort('title')">
                <div id="status" class="sort icon_no_sort">Chú thích</div>
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
                    <td class="th_left"><a href="<?= PATH_URL . 'admincp/' . $module . '/update/' . $v->id ?>"><?= $v->username ?></a>
                    </td>
                    <td class="th_left"><a href="<?= PATH_URL . 'admincp/' . $module . '/update/' . $v->id ?>"><?= $v->count ?></a>
                    </td>
                    <td class="th_left"><a href="<?= PATH_URL . 'admincp/' . $module . '/update/' . $v->id ?>"><?= $v->message ?></a>
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