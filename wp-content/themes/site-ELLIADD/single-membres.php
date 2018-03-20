<?php
get_header();
$get_post_id = url_to_postid(home_url() . $_SERVER['REQUEST_URI']);
$infoGeneral = get_post_meta($get_post_id);
$image = wp_get_attachment_image($infoGeneral['ELLIADD_profil'][0]); ?>
<main>
    <section>
        <h1><?php wp_title(''); ?></h1>
        <?php if (!empty($image)) { ?>
        <div>
            <figure><?php echo $image; ?></figure>
            <?php } else{ ?>
            <div style="flex-direction: row">
                <?php } ?>
                <ul>
                    <?php if ($infoGeneral['ELLIADD_section'][0]) { ?>
                        <li><span>Section CNU : </span><?php echo $infoGeneral['ELLIADD_section'][0]; ?></li><?php } ?>
                    <?php if ($infoGeneral['ELLIADD_polePrinc'][0]) { ?>
                        <li><span>Pôle principal : </span><?php echo $infoGeneral['ELLIADD_polePrinc'][0]; ?>
                        </li><?php } ?>
                    <?php if ($infoGeneral['ELLIADD_poleSec'][0]) { ?>
                        <li><span>Pôle secondaire : </span><?php echo $infoGeneral['ELLIADD_poleSec'][0]; ?>
                        </li><?php } ?>
                    <?php if ($infoGeneral['ELLIADD_competences'][0]) { ?>
                        <li>
                        <span>Compétences, domaine sientifique : </span><?php echo $infoGeneral['ELLIADD_competences'][0]; ?>
                        </li><?php } ?>
                    <?php if ($infoGeneral['ELLIADD_site'][0]) { ?>
                        <li><span>Site internet : </span><?php echo $infoGeneral['ELLIADD_site'][0]; ?></li><?php } ?>
                </ul>
            </div>
            <h2> Thème de recherche </h2>
            <div>
                <p>
                    <?php echo $infoGeneral['ELLIADD_recherche'][0]; ?>
                </p>
            </div>
            <h2> Publications</h2>
            <div>
                <?php if ($publications = rwmb_meta('ELLIADD_articles', 'file', $get_post_id)) { ?>
                    <h3>Articles</h3>
                    <div>
                        <ul>
                            <?php foreach ($publications as $publication) {
                                if (substr($publication[path], -3) == 'pdf') {
                                    ?>
                                    <li>
                                        <a href="<?php echo $publication['url']; ?>"><?php echo str_replace('-', ' ', $publication['title']); ?></a>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                <?php }
                if ($publications = rwmb_meta('ELLIADD_projets', 'file', $get_post_id)) { ?>
                    <h3>Projets</h3>
                    <div>
                        <ul>
                            <?php foreach ($publications as $publication) {
                                if (substr($publication[path], -3) == 'pdf') {
                                    ?>
                                    <li>
                                        <a href="<?php echo $publication['url']; ?>"><?php echo str_replace('-', ' ', $publication['title']); ?></a>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                <?php }
                if ($publications = rwmb_meta('ELLIADD_ouvrages', 'file', $get_post_id)) { ?>
                    <h3> Ouvrages</h3>
                    <div>
                        <ul>
                            <?php foreach ($publications as $publication) {
                                if (substr($publication[path], -3) == 'pdf') {
                                    ?>
                                    <li>
                                        <a href="<?php $publication['url']; ?>"><?php echo str_replace('-', ' ', $publication['title']); ?></a>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                <?php }
                $publications = rwmb_meta('ELLIADD_colloques', null, $get_post_id);
                if (!empty($publications[0][0] && $publications[0][1] && $publications[0][2])) { ?>
                    <h3>Colloques</h3>
                    <div>
                        <ul>
                            <?php foreach ($publications as $publication) {
                                ?>
                                <li>
                                    <ul>
                                        <li><span>Thème : </span><?php echo $publication[0]; ?></li>
                                        <li><span>Date : </span><?php echo $publication[1]; ?></li>
                                        <li><span>Lieu : </span><?php echo $publication[2]; ?></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <h2>Enseignement</h2>
            <div>
                <div>
                    <?php if ($values = rwmb_meta('ELLIADD_cours', null, $get_post_id)) { ?>
                        <h3>Liste des cours :</h3>
                        <ul>
                            <?php foreach ($values as $value) { ?>
                                <li><?php echo $value ?></li>
                            <?php } ?>
                        </ul> <?php
                    } ?>
                </div>
            </div>
            <h2>Parcours</h2>
            <div>
                <p>
                    <?php if ($values = rwmb_meta('ELLIADD_parcours', null, $get_post_id)) {
                        echo $values;
                    } ?>
                </p>
            </div>
            <h2>Contact</h2>
            <div class="contact">
                <div>
                    <ul>
                        <?php if ($infoGeneral['ELLIADD_contact'][0]) { ?>
                            <li><span>Twitter : </span><?php echo $infoGeneral['ELLIADD_contact'][0]; ?></li><?php } ?>
                        <?php if ($infoGeneral['ELLIADD_contact'][1]) { ?>
                            <li><span>Site internet : </span><a href="<?php echo $infoGeneral['ELLIADD_contact'][1]; ?>"><?php echo $infoGeneral['ELLIADD_contact'][1]; ?></a>
                            </li><?php } ?>
                        <?php if ($infoGeneral['ELLIADD_contact'][2]) { ?>
                            <li><span>Mail : </span><?php echo $infoGeneral['ELLIADD_contact'][2]; ?></li><?php } ?>
                    </ul>
                </div>
            </div>
    </section>
</main>
<?php
get_footer();
?>
<script>
    (function () {
        "use strict";
        var typePub = document.querySelectorAll('body.single-membres > main > section > div:nth-of-type(3) > h3');

        for (var i = 0; i < typePub.length; i++) {
            var chercheur = typePub[i];
            chercheur.addEventListener('click', function () {
                this.nextElementSibling.classList.toggle('resume');
            });
        }
    }());
</script>
