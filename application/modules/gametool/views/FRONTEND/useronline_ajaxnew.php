<?php
    if($result)
    {
    ?>
<table class="useronline">
    <tr>
        <th>Thời Gian</th>
          <?php
            if($servers)
            {
                foreach($servers as $item)
                {
                    ?>
                    <th> <?=$item->name?> </th>
                <?php
                }
            }
            ?>
    </tr>
    <?
        if($time)
        {
            $row = 0;
                ?>
                <?php  
                    foreach($time as $item)
                    {

                 ?>
                <tr <?php if($row++ % 2 == 0)  echo "class='row1'"  ;?> >
                    <td><?=$item->created?></td>
                    <?php
                        foreach($servers as $key => $value)
                        {
                            echo "<td>";
                            foreach($result as $key2 => $value2)
                            {
                                if($value2->created == $item->created && $value2->sid == $value->id)
                                {      
                                    if($value2->total == -1 )
                                        echo "0";
                                    else
                                        echo $value2->total;
                                }
                            }
                            echo "</td>";
                        }  
                        ?>
                
                <?php   }   ?>
                </tr>
            
    <?php
        }
    ?>
</table>
        <?=$pageLink?>
<?php
    }
?>

