<?php get_header(); ?>
    <main>
        <section>
            <h2>Actualité</h2>
            <iframe src="http://actu.univ-fcomte.fr/univ/elliad/iframe" frameborder="0"></iframe>
        </section>
        <section>
            <h2>Derniers articles publiés</h2>
            <div class="publication">
                <?php
                $publication = new WP_Query(array(
                    'post_type' => array(
                        'revision',
                        'membres'
                    ),
                    'order' => 'DESC',
                    'orderby' => 'modified',
                    'posts_per_page' => 8
                ));
                while ($publication->have_posts()):
                    $publication->the_post();
                    if (substr(array_pop(rwmb_meta('ELLIADD_articles'))['path'], -3) == 'pdf') {
                        $mots = preg_split("/[\s &]+/", get_post_meta(get_the_ID())['ELLIADD_polePrinc'][0]);
                        foreach ($mots as $mot) {
                            $class .= strtoupper(substr($mot, 0, 1));
                        }
                        ?>
                        <div>
                            <a href="<?php the_permalink(); ?>"><span><?php echo the_title(); ?></span></a>
                            <h4><a href="<?php echo array_pop(rwmb_meta('ELLIADD_articles'))['url'] ?>"><?php echo array_pop(rwmb_meta('ELLIADD_articles'))['title']; ?></a></h4>
                            <iframe src="<?php echo array_pop(rwmb_meta('ELLIADD_articles'))['url'] ?>"
                                    frameborder="0"></iframe>
                            <p>Date de publication
                                : <?php echo date('d/m/Y (H:i:s)', filemtime(array_pop(rwmb_meta('ELLIADD_articles'))['path'])); ?></p>
                            <span class="<?php echo $class; ?>"></span>
                        </div>
                    <?php }
                    $class = ''; endwhile; ?>
            </div>
        </section>
        <aside>
            <h4>Qui sommes-nous&nbsp;?</h4>
            <p>L’EA 4661 ELLIADD (Edition, Littératures, Langages, Informatique, Arts, Didactique, Discours) est une
                Unité
                de Recherche de l’Université de Franche-Comté reconnue par le Ministère et évaluée A par l'AERES pour
                son
                projet scientifique. </p>
            <p><a href="<?php echo get_page_by_title('À propos d\'ELLIADD')->guid; ?>">En savoir plus</a></p>
        </aside>
    </main>
<?php get_footer(); ?>
