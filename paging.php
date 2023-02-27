<?php
/**
 * Страница пагинации главной страницы
 * @var $page
 * @var $page_url
 * @var $total_rows
 * @var $records_per_page
 */
?>
<nav>
    <ul class="pagination justify-content-center">
    <!-- button for first page -->
<!--    --><?php //if($page > 1): ?>
        <li class="page-item<?php if ($page == 1) echo ' active' ?>">
            <a href="<?= $page_url ?>" class="page-link">1</a>
        </li>
<!--    --><?php //endif ?>

    <?php
    // calculate total pages
    $total_pages = ceil($total_rows / $records_per_page);

    // range of links to show
    $range = 3;

    // display links to 'range of pages' around 'current page'
    $initial_num = $page - $range;
    $condition_limit_num = ($page + $range) + 1;

    for ($x=$initial_num; $x<$condition_limit_num; $x++) {

        // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
        if (($x > 0) && ($x <= $total_pages)) {
            if ($x == 1 || $x == $total_pages) {
                continue;
            }

            // current page
            if ($x == $page) {
                echo "<li class='page-item active'><a href=\"#\" class='page-link'>$x <span class=\"sr-only\">(current)</span></a></li>";
            }

            // not current page
            else {
                echo "<li class='page-item'><a href='{$page_url}page=$x' class='page-link'>$x</a></li>";
            }
        }
    }
    ?>
    <!-- button for last page -->
<!--    --><?php //if($page < $total_pages): ?>
        <li class="page-item<?php if ($page == $total_pages) echo ' active' ?>">
            <a href="<?= $page_url . 'page=' . $total_pages ?>" class="page-link"><?= $total_pages ?></a>
        </li>
<!--    --><?php //endif ?>
    </ul>
</nav>