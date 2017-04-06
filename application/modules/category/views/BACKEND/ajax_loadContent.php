<div class="content_table">
    
    <div class="menu_change_admin">
    <?php echo $menu; ?>
    </div>
  
    <br style="clear:both">

 <script>
    $(function() {
        $( "ul.droptrue" ).sortable({
        connectWith: "ul"
        });
        $( "ul.cate_group" ).sortable({
        connectWith: "ul",
        dropOnEmpty: false,
            update: function( event, ui ) {
                var data="";
                  
                //$(ui.item).attr('data-index',ui.item.index());
                var sors=sor=$(ui.item);
                var ix=ui.item.index();
                var jx=ui.item.index();
                for(var i=0;i<50;i++){          
                    sor.attr("data-index",ix);
                    sor=sor.next();
                    sors.attr("data-index",jx);
                    sors=sors.prev();
                    ix++;
                    jx--;           
                }

                $('li.list_c').each(function(){
                    data+='&data['+$(this).attr('id')+']='+$(this).attr("data-index")+'';
                })

                var parentid=$(ui.item).parent().parent().attr('id');
                obj='&obj['+$(ui.item).attr('id')+']='+parentid+'';

                $.ajax({
                    type: "POST",
                    url: root+"category/category_change/",
                    data: data+obj,
                        success: function(msg){
                        
                        },
                    
                });


                console.log(data);

            }
        });
        $( "#sortable1, #sortable2, #sortable3" ).disableSelection();
    });
</script>


    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <th class="th_no_cursor" width="40">No.</th>
            <th class="th_no_cursor" width="31">
                <input type="checkbox" class="custom_chk" id="selectAllItems" onclick="selectAllItems(<?= count($result) ?>)"/></th>

            <th class="th_left" onclick="sort('name')">
                <div id="name" class="sort icon_no_sort">Tên</div>
            </th>

            <th onclick="sort('parent')">
                <div id="parent" class="sort icon_no_sort">Menu cấp cha</div>
            </th>

            <th width="80" onclick="sort('status')">
                <div id="status" class="sort icon_no_sort">Trạng thái</div>
            </th>



            <th width="70" onclick="sort('order')">
                <div id="order" class="sort icon_no_sort">Thứ tự</div>
            </th>
            <th class="th_last" width="100" onclick="sort('created')">
                <div id="created" class="sort icon_sort_asc">Ngày tạo</div>
            </th>
        </tr>
        <?php
        if ($result) {
            $i = 0;
            foreach ($result as $k => $v) {
                ?>
                <tr class="item_row<?= $i ?> <?php ($k % 2 == 0) ? print 'row1' : print 'row2' ?>">
                    <td class="td_center"><?= $k + 1 + $start ?></td>
                    <td class="td_no_padd">
                        <input type="checkbox" class="custom_chk" id="item<?= $i ?>" onclick="selectItem(<?= $i ?>)" value="<?= $v->id ?>"/>
                    </td>
                    <td class="th_left">
                        <a href="<?= PATH_URL . 'admincp/' . $module . '/update/' . $v->id ?>"><?= $v->name ?></a>
                    </td>
                    <td class="td_left">
                        <a href="<?= PATH_URL . 'admincp/' . $module . '/update/' . $v->id ?>">
                            <?php
                            if($v->parent == 0)
                            {
                                echo "Không có";
                            }
                            else
                                foreach ($cate as $value) {
                                    if($v->parent == $value->id)
                                    {
                                        echo $value->name;
                                    }

                                }?>

                        </a>
                    </td>
                    <td class="td_center" id="loadStatusID_<?= $v->id ?>"><a href="javascript:void(0)"
                                                                             onclick="updateStatus(<?= $v->id ?>,<?= $v->status ?>,'<?= $module ?>')"><img
                                alt="Checked item"
                                src="<?= PATH_URL . 'static/images/admin/icons/' ?><?php ($v->status == 0) ? print 'uncheck_16x16.png' : print 'check_16x16.png' ?>"/></a>
                    </td>
                    <td class="td_center">
                        <span><?= $v->order ?></span>
                    </td>
                    <td class="td_center">
                        <?= date('d-m-Y H:i:s', strtotime($v->created)) ?>
                    </td>
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
