<?php get_header();
$projets = new WP_Query('post_type=' . get_query_var('post_type') . '&orderby=title&order=asc');
?>
    <main>
        <section>
            <h1><?php wp_title('') ?></h1>
            <div class="publication">
                <?php
                while ($projets->have_posts()): $projets->the_post(); ?>
                    <div>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div><p> <?php the_excerpt(); ?></p></div>
                        <span class="gris_bloc"></span>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
        </section>
    </main>
<?php get_footer(); ?>