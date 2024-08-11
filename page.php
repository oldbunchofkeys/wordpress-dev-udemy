<?php get_header(); 

while (have_posts()) {
    the_post(); ?>
    <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?= the_title(); ?></h1>
    <div class="page-banner__intro">
        <p>Don't forget to replace me later.</p>
    </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <?php
        // Render breadcrumb box IF page is a child page
        $parent_Id = wp_get_post_parent_id(get_the_ID());
        if ($parent_Id): ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?= get_the_permalink($parent_Id) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?= get_the_title($parent_Id); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
        <?php endif; ?>

        <?php 
        $test_array = get_pages(array(
            'child_of' => get_the_ID()
        ));
        // the commented out code below is another way to check if the page is a parent (the second condition of the below if statement). 
        // this is based on my work i had done to render content if and only if a page is a parent:
        // $child_pages = get_children(array('post_parent' => get_the_ID())); 

        if ($parent_Id or $test_array): ?>
        <div class="page-links">
            <h2 class="page-links__title"><a href="<?= get_the_permalink($parent_Id); ?>"><?= get_the_title($parent_Id); // this works because the function will return the current page's title if the argument is 0 (integer)?></a></h2>
            <ul class="min-list">
                <?php
                    if ($parent_Id) {
                        $find_children_of = $parent_Id;
                    } else {
                        $find_children_of = get_the_ID();
                    }
                    wp_list_pages(array(
                        'title_li' => NULL, // remove the "Pages" title that renders by default
                        'child_of' => $find_children_of, // the if else blocks above handle the logic to say 
                        //"if the current page has a parent, render the parent in the blue box and then render 
                        //the children (including the current page) below it, and if the current page IS the parent, 
                        //then render the current page in the blue box and render its children below it.
                        'sort_column' => 'menu_order' //this tells wordpress to use the order of subpages (set manually in the page admin) to determine the list order
                    ));
                ?>
            </ul>
        </div>
        <?php endif; ?>
    
    <div class="generic-content">
    <?php the_content(); ?>
    </div>
</div>
<?php }?>



    <?php get_footer(); ?>