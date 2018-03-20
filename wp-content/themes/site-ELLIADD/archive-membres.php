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
                    'taxonomy' => 'typeMembre',
                    'object_ids' => get_the_ID(),
                    'hide_empty' => true,
                ))[0];
                $id = get_the_ID();
                $infoGeneral = get_post_meta(get_the_ID());
                $mots = preg_split("/[\s &]+/", $infoGeneral['ELLIADD_polePrinc'][0]);
                foreach ($mots as $mot) {
                    $class .= strtoupper(substr($mot, 0, 1));
                    if ($class == 'AEL') {
                        $class = 'AL';
                    }
                } ?>
                <div>
                    <?php if ($term->slug == 'enseignants-chercheurs') { ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php } else { ?>
                        <h2><a href="<?php echo home_url() . '/' . strtolower($term->taxonomy) . '/' . $term->slug . '/#' . $id; ?>"><?php the_title(); ?></a></h2>
                    <?php } ?>
                    <div>
                        <p>
                            <?php echo rwmb_meta('ELLIADD_recherche'); ?>
                        </p>
                    </div>
                    <span title="<?php echo $infoGeneral['ELLIADD_polePrinc'][0] ?>"
                          class="<?php echo $class ?>"></span>
                </div>
                <?php
                $class = '';
            endwhile;
            ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
