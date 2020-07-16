
<?php get_header();?>

<main>
<?php if ( !is_front_page() ) { ?>
    <div class="container-fluid">
    <div class="row subheader">
        <div class="subheader__overlay"></div>
        <div class="col d-flex justify-content-center align-items-center">
            <h1><?php the_title();?></h1>
        </div>
    </div>
    </div>
    <?php } ?>

    <?php if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_content();
        }
    }
    ?>
</main>

<?php get_footer(); ?>