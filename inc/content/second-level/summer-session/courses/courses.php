<article>
    <section class="clearfix inside-header courses-books">
        <div class="border-box no-pad-wrapper clearfix">
            
            <h3 class="wrapper clearfix">Summer Courses</h3>

            <section class="clearfix inside-content inside-page-section-nav">
                <div class="border-box wrapper clearfix overflow-visible">
                    <header class="section-header clearfix">
                        <?php
                            $selected_sub_nav = 1;
                            $file = "summer-session/courses/courses-nav.php";
                            include($path . $content . $secLv . $file);
                        ?>
                    </header>
                </div>
            </section>
        </div>
    </section>

    <?php
        $file = "summer-session/inside-copy.php";
        //include($path . $content . $secLv . $file);
    ?>

    <section id="browse-departments" class="clearfix inside-content alt-headers wrapper">

        <div id="modify-search" class="clearfix">
            <?php
                $file = "summer-session/widgets/course-search-form.php";
                include($path . $content . $secLv . $file);
            ?>
        </div>

        <div class="border-box content clearfix">

            <p></p>

        </div>

        <h4>Browse Departments</h4>

        <div class="filter-wrapper border-box content clearfix sticky">
            <input id="live-filter-search" type="text" class="rounded-input text-filter" placeholder="Filter Departments" />
            <div class="filter-controls clearfix">
                <div class="filter-status"></div>
                <div class="clear-filter hide-accessible border-box">View all departments</div>
            </div>
        </div>

        <div id="live-filter-list" class="border-box content clearfix">

            <ul id="department_list" class="departments">
                <?=$render->listAllDepartments();?>
            </ul>

        </div>

    </section>

    <?php
        $file = "summer-session/widgets/course-circles.php";
        include($path . $content . $secLv . $file);
    ?>

</article>