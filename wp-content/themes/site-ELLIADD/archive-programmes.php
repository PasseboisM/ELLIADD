<?php get_header();
$projets = new WP_Query('post_type=pole&orderby=title&order=asc');
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
                        <?php the_title(); ?>
                    </h2>
                    <?php
                    $listeProg = new WP_Query(array(
                        'post_type' => 'programmes',
                        'taxonomy' => 'concerne'
                    ));
                    $titleParent = get_the_title();
                    while ($listeProg->have_posts()): $listeProg->the_post();
                        $terms = get_terms(array(
                            'taxonomy' => 'concerne',
                            'object_ids' => get_the_ID(),
                            'hide_empty' => true,
                        ));
                        /*echo '<pre>';
                        print_r($terms);
                        echo '</pre>';
                        echo $titleParent;*/
                        foreach ($terms as $term) {
                            if ($titleParent == $term->name) { ?>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
                            <?php }
                        } endwhile; ?>
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
