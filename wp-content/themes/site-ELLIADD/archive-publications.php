<?php get_header();
$projets = new WP_Query('post_type=' . get_query_var('post_type') . '&orderby=title&order=asc');
?>
<main>
    <section>
        <h1><?php wp_title('') ?></h1>
        <div class="publication">
            <?php
            while ($projets->have_posts()): $projets->the_post();
                $term = get_terms(array(
                    'taxonomy' => 'typePub',
                    'object_ids' => get_the_ID(),
                    'hide_empty' => true,
                ))[0];
                $id = get_the_ID(); ?>
                <div>
                    <div>
                        <h2>
                            <a href="<?php echo home_url() . '/' . strtolower($term->taxonomy) . '/' . $term->slug . '/#' . $id; ?>"><?php the_title(); ?></a>
                        </h2>
                        <div>
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                        </div>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'concerne',
                            'object_ids' => get_the_ID(),
                            'hide_empty' => true,
                        )); ?>
                    </div>
                    <div>
                        <?php foreach ($terms as $term) { ?>
                            <span title="<?php echo $term->name; ?>"
                                  class="<?php echo strtoupper($term->slug); ?>"></span>
                        <?php }
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
            ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
