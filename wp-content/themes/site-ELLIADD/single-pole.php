<?php get_header();
while (have_posts()): the_post();
    $mots = preg_split("/[\s &]+/", get_the_title());
    foreach ($mots as $mot) {
        $class .= strtoupper(substr($mot, 0, 1));
        if ($class == 'AEL') {
            $class = 'AL';
        }
    } ?>
    <main>
    <section>
    <h1 class="coul<?php echo $class; ?>"> <?php wp_title(''); ?></h1>
    <h3>Présentation</h3>
    <div class="polesDESC">
    <p><?php the_content(); ?></p>
<?php endwhile ?>
    </div>
    </section>
    </main>
<?php get_footer(); ?>