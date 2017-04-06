<?php   $tichluy[1] = 'Tích lũy reset theo ngày';
        $tichluy[2] = 'Tích lũy reset theo tuần';
        $tichluy[3] = 'Tích lũy reset theo tháng';
        $tichluy[4] = 'Tích lũy không reset';
?>
<div class="content_table">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <th class="th_no_cursor" width="40">No.</th>
            <th class="th_left th_no_cursor">
                <div id="title">Tên tích lũy</div>
            </th>
            <th width="200" class='th_no_cursor'>
                <div id="title">Loại tích lũy</div>
            </th>
            <th width="200" class='th_no_cursor'>
                <div id="title">Ngày bắt đầu</div>
            </th>
            <th width="200" class='th_no_cursor'>
                <div id="title">Ngày kết thúc</div>
            </th>
            <th width="200" class='th_no_cursor'>
                <div id="title">Trạng thái</div>
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
                    <td class="th_left"><a href="<?=PATH_URL.'admincp/'.$module.'/update/'.$v->id?>"><?= $v->name ?></a>
                    </td>
                    <td class="td_center"><a><?php if( isset($tichluy[$v->type]) ) print $tichluy[$v->type];else print 'Không có'; ?></a>
                    </td>
                    <td class="td_center"><a><?= date('d-m-Y H:i:s', strtotime($v->startdate)) ?></a>
                    </td>
                    <td class="td_center"><a><?= date('d-m-Y H:i:s', strtotime($v->enddate)) ?></a>
                    </td>
                    <td class="td_center" id="loadStatusID_<?=$v->id?>"><a href="javascript:void(0)" onclick="updateStatus(<?=$v->id?>,<?=$v->status?>,'<?=$module?>')"><img alt="Checked item" src="<?=PATH_URL.'static/images/admin/icons/'?><?php ($v->status==0) ? print 'uncheck_16x16.png' : print 'check_16x16.png' ?>" /></a></td>
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