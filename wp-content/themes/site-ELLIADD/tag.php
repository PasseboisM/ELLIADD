<?php get_header(); ?>
<main>
    <section>
        <h1><?php wp_title(); ?></h1>
        <?php
        while (have_posts()): the_post();
            ?>
            <ul>
                <li><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?></li>
            </ul>
            <?php
        endwhile
        ?>
    </section>
</main>
<?php get_footer(); ?>
