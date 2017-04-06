
    <nav class="blockmenu"><!---->
    <?php
    $menus = $multimenu;
    function show_menu($menus = array(), $parrent = 0)
    {
        // LAY MENU DUA VAO MENU ID MENU CHA TRUYEN VAO
        $current_menus = array();
        foreach ($menus as $key => $val) {
            if ($val['parent'] == $parrent) {
                $current_menus[] = $val;
                unset($menus[$key]);
            }
        }
        // SHOW RA MENU THEO UL
        if (sizeof($current_menus) > 0) {
            echo '<ul class="parent'.$parrent.'">';
            foreach ($current_menus as $key => $val) {
                echo '<li><a href="', $val['slug'], '">', $val['name'], '</a>';
                show_menu($menus, $val['id'], false);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    echo  show_menu($menus);
    ?>
    </nav>

