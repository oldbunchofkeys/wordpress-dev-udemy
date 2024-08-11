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
        if ($parent_Id) { ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?= get_the_permalink($parent_Id) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?= get_the_title($parent_Id); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
        <?php }
    ?>
    
    <?php
        // Render child links sidebar IF page is a parent of 1 or more child pages
        // TODO remove this code and follow the video. (lesson 19 - Section 5)
        // I got the objective wrong. it wasn't to render on parent pages only. it was
        // to render on parent OR child pages only. big difference between that and what i did here.
        $child_pages = get_children(array('post_parent' => get_the_ID())); 
        if (count($child_pages)): ?>
            <div class="page-links">
                <h2 class="page-links__title"><a href="<?= get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <ul class="min-list">
                    <?php foreach ($child_pages as $child): ?>
                    <!-- <li class="current_page_item"><a href="#">Our History</a></li> -->
                    <li><a href="<?= get_permalink($child->ID); ?>"><?= $child->post_title; ?></a></li>
                    <?php endforeach; ?> 
                </ul>
            </div>
        <?php endif; ?>
    
    <div class="generic-content">
    <?php the_content(); ?>
    </div>
</div>
<?php }?>



    <?php get_footer(); ?>