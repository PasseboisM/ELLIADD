<?php get_header(); ?>
    <main>
        <section>
            <h1><?php echo ucfirst(get_query_var('term')); ?></h1>
            <div>
                <?php
                while (have_posts()): the_post();
                    $terms = get_terms(array(
                        'taxonomy' => 'concerne',
                        'object_ids' => get_the_ID(),
                        'hide_empty' => true,
                    ));
                    if (get_query_var('term') == 'ouvrages') { ?>
                        <div id="<?php the_ID() ?>">
                            <?php the_post_thumbnail('ouvrage'); ?>

                            <div>
                                <h3><a href="<?php rwmb_the_value('ELLIADD_lienPub'); ?>"><?php the_title(); ?></a></h3>
                                <span><em><a
                                            href="<?php echo get_page_by_title(rwmb_meta('ELLIADD_nomAuteur'), 'OBJECT', 'membres')->guid; ?>"><?php rwmb_the_value('ELLIADD_nomAuteur'); /*echo the_author().' ';*/ ?></a></em></span>
                                <div>
                                    <?php the_content();
                                    ?>
                                </div>
                            </div>
                            <div>
                                <?php
                                foreach ($terms as $term) { ?>
                                    <span title="<?php echo $term->name; ?>"
                                          class="<?php echo strtoupper($term->slug); ?>"></span>
                                <?php }
                                ?>
                            </div>
                        </div>
                        <?php
                    } else { ?>
                        <div id="<?php the_ID() ?>">
                            <div>
                                <h3><a href="<?php rwmb_the_value('ELLIADD_lienPub'); ?>"><?php the_title(); ?></a></h3>
                                <?php the_content(); ?>
                                <p>Collection : <?php rwmb_the_value('ELLIADD_nomCollection') ?></p>
                                <p>Responsable de la collection : <?php rwmb_the_value('ELLIADD_respPub') ?></p>
                                <p>Contact : <?php rwmb_the_value('ELLIADD_contactPub') ?></p>
                                <p class="infoPub"><span>Depuis le <?php rwmb_the_value('ELLIADD_debutPub') ?></span>
                                    <span>Status : <?php if (rwmb_meta('ELLIADD_finPub')) { ?>
                                            <i style="color: red;">fin de publication </i> <?php } else { ?><i
                                            style="color: green">toujours en publication</i><?php } ?></span>
                                </p>
                            </div>
                            <div>
                                <?php
                                foreach ($terms as $term) { ?>
                                    <span title="<?php echo $term->name; ?>"
                                          class="<?php echo strtoupper($term->slug); ?>"></span>
                                <?php }
                                ?>
                            </div>
                        </div>
                    <?php }
                endwhile;
                ?>
            </div>
        </section>
    </main>
<?php get_footer(); ?>