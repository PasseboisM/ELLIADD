<?php get_header();
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
?>
<main>
    <section>
        <h1><?php echo $term->name; ?></h1>
        <?php
        while (have_posts()): the_post();
            ?>
            <div class="formation">
                <h3 class="gris_bloc"><?php the_title() ?></h3>
                <div>
                    <div>
                        <span>Directeur : <?php rwmb_the_value('ELLIADD_dirForm') ?></span>
                        <span>Adresse : <?php rwmb_the_value('ELLIADD_adresseForm') ?></span>
                        <a href="<?php rwmb_the_value('ELLIADD_siteForm') ?>">Site web</a>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <?php
        endwhile
        ?>
    </section>
</main>
<?php get_footer(); ?>
<script>
    (function () {
        "use strict";
        var formations = document.querySelectorAll('.formation > h3');

        for (var i = 0; i < formations.length; i++) {
            var chercheur = formations[i];
            chercheur.addEventListener('click', function () {
                console.log(this.nextElementSibling);
                this.nextElementSibling.classList.toggle('resume');
            });
        }
    }());
</script>
