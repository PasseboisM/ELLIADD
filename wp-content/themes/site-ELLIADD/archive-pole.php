<?php get_header();
$projets = new WP_Query('post_type=' . get_query_var('post_type') . '&orderby=title&order=asc');
?>
<main>
    <section>
        <h1><?php wp_title('') ?></h1>
        <div class="publication">
            <?php
            while ($projets->have_posts()): $projets->the_post();
                $mots = preg_split("/[\s &]+/", get_the_title());
                foreach ($mots as $mot) {
                    $class .= strtoupper(substr($mot, 0, 1));
                    if ($class == 'AEL') {
                        $class = 'AL';
                    }
                }
                ?>
                <div>
                    <h2>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div>
                        <p>
                            <?php the_excerpt(); ?>
                        </p>
                    </div>
                    <span class="<?php echo $class ?>"></span>
                </div>
                <?php
                $class = '';
            endwhile;
            ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
