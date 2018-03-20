<?php get_header(); ?>
<main class="alphabet">
    <section>
        <?php
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $projets = new WP_Query(array(
            'post_type' => 'membres',
            'taxonomy' => 'typeMembre',
            'term' => $term->slug,
            'nopaging' => true
        ));
        ?>
        <h1><?php echo $term->name; ?></h1>
        <div class="trie">
            <span>Trier&nbsp;:</span>
            <ul id="liste-poles">
                <li data-trie="select-AL" class="AL" title="Arts & Littératures">AL</li>
                <li data-trie="select-CCM" class="CCM" title="Conception Création Médiations">CCM</li>
                <li data-trie="select-CLD" class="CLD" title="Contextes Langages Didactiques">CLD</li>
                <li data-trie="select-DTEPS" class="DTEPS" title="Discours Texte Espace Public Société">DTEPS</li>
                <li data-trie="select-EECDS" class="EECDS" title="EECDS">ERCOS</li>
            </ul>
        </div>
        <?php
        while ($projets->have_posts()):
            $projets->the_post();
            $infoGeneral = get_post_meta(get_the_ID());
            $mots = preg_split("/[\s &]+/", $infoGeneral['ELLIADD_polePrinc'][0]);
            foreach ($mots as $mot) {
                $class .= strtoupper(substr($mot, 0, 1));
                if ($class == 'AEL') {
                    $class = 'AL';
                }
            }
            ?>
            <div id="<?php the_ID(); ?>" class="extrait-membre <?php echo $class ?>-trie">
                <h3 class="<?php echo $class ?>"><?php the_title() ?></h3>
                <div>
                    <div>

                        <?php if ($infoGeneral['ELLIADD_section'][0]) { ?>
                        <span>Section CNU : <?php echo $infoGeneral['ELLIADD_section'][0]; ?><?php } ?></span>
                        <?php if ($infoGeneral['ELLIADD_polePrinc'][0]) { ?>
                        <span>Pôle principal : <?php echo $infoGeneral['ELLIADD_polePrinc'][0]; ?><?php } ?></span>
                        <?php if ($infoGeneral['ELLIADD_poleSec'][0]) { ?>
                        <span>Pôle secondaire : <?php echo $infoGeneral['ELLIADD_poleSec'][0]; ?><?php } ?></span>
                        <?php if ($infoGeneral['ELLIADD_site'][0]) { ?>
                        <span>Site internet : <?php echo $infoGeneral['ELLIADD_site'][0]; ?><?php } ?></span>
                        <?php if ($infoGeneral['ELLIADD_contact'][0]) { ?>
                        <span>Contact : <?php foreach ($infoGeneral['ELLIADD_contact'] as $item) {
                                if (!empty($item)) {
                                    if ($item == end($infoGeneral['ELLIADD_contact'])) {
                                        echo $item;
                                    } else {
                                        echo $item . ', ';
                                    }
                                }
                            } ?><?php } ?></span>

                    </div>
                    <?php if ($term->slug == 'enseignants-chercheurs') { ?>
                        <a href="<?php the_permalink(); ?>">En savoir plus...</a>
                    <?php } ?>
                </div>
            </div>
            <?php
            $class = '';
        endwhile;
        ?>
    </section>
</main>
<?php get_footer(); ?>
<script>
    (function () {
        "use strict";
        var trie = document.querySelector('div.trie');
        var lesChercheurs = document.querySelector('body.tax-typeMembre>main');

        function clickAffiche(evt) {
            if (!evt.target.matches('.trie > span') && !evt.target.matches('.trie') && !evt.target.matches('.trie>ul')) {
                if (lesChercheurs.className == evt.target.dataset.trie) {
                    lesChercheurs.className = '';
                    lesChercheurs.classList.add('alphabet');
                } else {
                    lesChercheurs.className = '';
                    lesChercheurs.classList.add(evt.target.dataset.trie);
                }
            }
        }

        trie.addEventListener('click', clickAffiche);
    }());
    (function () {
        "use strict";
        var chercheurs = document.querySelectorAll('.extrait-membre > h3');

        for (var i = 0; i < chercheurs.length; i++) {
            var chercheur = chercheurs[i];
            chercheur.addEventListener('click', function () {
                console.log(this.nextElementSibling);
                this.nextElementSibling.classList.toggle('resume');
            });
        }
    }());
</script>
