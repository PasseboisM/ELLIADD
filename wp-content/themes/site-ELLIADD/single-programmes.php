<?php get_header();
while (have_posts()):
the_post();

$pole = get_terms(array(
    'taxonomy' => 'concerne',
    'object_ids' => get_the_ID(),
    'hide_empty' => true,
))[0]->name;
$mots = preg_split("/[\s &]+/", $pole);
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
            <?php the_content(); ?>
            <?php endwhile; ?>
    </section>
</main>
<?php get_footer(); ?>
