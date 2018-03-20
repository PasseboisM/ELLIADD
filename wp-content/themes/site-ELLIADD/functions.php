<?php

/*suppression bar admin*/

function plus_admin_bar()
{
    show_admin_bar(false);
}

add_action('after_setup_theme', 'plus_admin_bar');

/*suppression des menus indésirables*/

function remove_menu_items()
{
    global $menu;
    $restricted = array(__('Comments'), __('Posts'));
    end($menu);
    while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
        if (in_array($value[0] != NULL ? $value[0] : "", $restricted)) {
            unset($menu[key($menu)]);
        }
    }
    remove_menu_page('index.php');
}

add_action('admin_menu', 'remove_menu_items');

/*chargement des feuilles de styles*/

function css_js()
{
    wp_enqueue_style('normalize', get_stylesheet_directory_uri() . '/css/normalise.css');
    wp_enqueue_style('mise en page', get_stylesheet_directory_uri() . '/css/mise_en_page.css');
    wp_enqueue_style('typographie couleurs', get_stylesheet_directory_uri() . '/css/typographie-couleurs.css');

    wp_enqueue_script('menu', get_stylesheet_directory_uri() . '/js/menu.js', null, null, true);
}

add_action('wp_enqueue_scripts', 'css_js');


/*ajout du support des images à la une*/

add_theme_support('post-thumbnails');

/*tailles des image*/

add_image_size('ouvrage', 170, 'auto', false);

/*suppression paragraphes indésirables*/

remove_filter('the_content', 'wpautop');

/*menu*/

add_theme_support('menus');
register_nav_menus(array(
    'principale' => 'Navigation principale'
));

/*
 * Création template personalisé
 */

function create_post_type()
{
    register_post_type('membres',
        array(
            'labels' => array(
                'name' => __('Membres'),
                'singular_name' => __('Membre')
            ),
            'public' => true,
            'has_archive' => true,
            'query_var' => true,
            'supports' => array('title', 'thumbnail', 'revisions'),
        )
    );

    register_post_type('pole',
        array(
            'labels' => array(
                'name' => __('Pôles'),
                'singular_name' => __('Pôle')
            ),
            'public' => true,
            'has_archive' => true,
            'query_var' => true,
            'supports' => array('title', 'editor', 'excerpt')
        )
    );

    register_post_type('publications',
        array(
            'labels' => array(
                'name' => __('Publications'),
                'singular_name' => __('Publication')
            ),
            'public' => true,
            'has_archive' => true,
            'query_var' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'author')
        )
    );

    register_post_type('programmes',
        array(
            'labels' => array(
                'name' => __('Programmes'),
                'singular_name' => __('Programme')
            ),
            'public' => true,
            'has_archive' => true,
            'query_var' => true,
            'supports' => array('title', 'editor')
        )
    );

    register_post_type('formations',
        array(
            'labels' => array(
                'name' => __('Formations'),
                'singular_name' => __('Formation')
            ),
            'public' => true,
            'has_archive' => true,
            'query_var' => true,
            'supports' => array('title', 'editor'),
        )
    );

    //flush_rewrite_rules(false);
}

add_action('init', 'create_post_type');

/*
 * Création des taxonomies
 */

function ajout_taxonomy()
{
    // répétez pour chaque taxonomie : lui donner un nom ici 'competences'
    register_taxonomy('typeMembre',
        // le type ou les types classés par cette taxonomie (séparé par des virgules)
        'membres',
        // options, voir documentation
        array(
            'label' => __('Type de membre'), // Au minimum fixer son nom affiché ('label')
            'hierarchical' => true // Tag (false) ou  Category (true)
        )
    );

    register_taxonomy('typePub',
        'publications',
        array(
            'label' => __('Type de publication'),
            'hierarchical' => true
        )
    );

    register_taxonomy('concerne',
        array('programmes', 'publications'),
        array(
            'label' => __('Concerne les pôles'),
            'hierarchical' => true
        )
    );

    register_taxonomy('typeFormation',
        'formations',
        array(
            'label' => __('Type de formation'),
            'hierarchical' => true
        )
    );

    //flush_rewrite_rules(false);
}

add_action('init', 'ajout_taxonomy');

/*
 * Champs personalisé avec meta box
 */

function ajout_meta_boxes($meta_boxes)
{
    $prefix = 'ELLIADD_';

    //type de contenu : MEMBRES informations premières
    $meta_boxes[] = array(
        'title' => 'Informations générales',
        'pages' => array('membres'),
        'fields' => array(
            array(
                'name' => 'Section CNU',
                'id' => $prefix . 'section',
                'desc' => 'Section d\'appartenance',
                'type' => 'number'
            ),
            array(
                'name' => 'Pôle principal',
                'id' => $prefix . 'polePrinc',
                'type' => 'text',
                'datalist' => array(
                    'options' => array(
                        'Arts et Littérature',
                        'Conception, Création, Médiations',
                        'Contextes, Langages, Didactique',
                        'Discours, Texte, Espace Public, Société',
                        'ERgonomie et COnception des Systèmes',
                    ),
                ),
            ),
            array(
                'name' => 'Pôle secondaire',
                'id' => $prefix . 'poleSec',
                'type' => 'text',
                'datalist' => array(
                    'options' => array(
                        'Arts et Littérature',
                        'Conception, Création, Médiations',
                        'Contextes, Langages, Didactique',
                        'Discours, Texte, Espace Public, Société',
                        'ERgonomie et COnception des Systèmes',
                    ),
                ),
            ),
            array(
                'name' => 'Image de profil',
                'id' => $prefix . 'profil',
                'type' => 'image'
            ),
            array(
                'name' => 'Thème de recherche',
                'id' => $prefix . 'recherche',
                'placeholder' => 'Présentez globalement le type de vos travaux',
                'type' => 'textarea',
            ),
            array(
                'name' => 'Site web',
                'id' => $prefix . 'site',
                'type' => 'url'
            ),
        )
    );

    //type de contenu : MEMBRES Informations supl
    $meta_boxes[] = array(
        'title' => 'Informations complémentaires',
        'pages' => array('membres'),
        'fields' => array(
            array(
                'name' => 'Liste des articles',
                'id' => $prefix . 'articles',
                'desc' => 'Liste contenant les articles',
                'type' => 'file_upload'
            ),
            array(
                'name' => 'Liste de projets',
                'id' => $prefix . 'projets',
                'desc' => 'Liste contenant les projets',
                'type' => 'file_upload'
            ),
            array(
                'name' => 'Liste des ouvrages',
                'id' => $prefix . 'ouvrages',
                'desc' => 'Liste contenant les ouvrages',
                'type' => 'file_upload'
            ),
            array(
                'name' => 'Liste des colloques',
                'id' => $prefix . 'colloques',
                'type' => 'text_list',
                'clone' => true,
                'sort_clone' => true,
                'options' => array(
                    'Thème du colloque' => 'Titre',
                    'jj/mm/aaaa' => 'Date',
                    'exemple : Paris' => 'Lieu'
                )
            ),
            array(
                'name' => 'Liste des cours proposés',
                'id' => $prefix . 'cours',
                'type' => 'text',
                'placeholder' => 'Nom du cours',
                'clone' => true,
            ),
            array(
                'name' => 'Parcours',
                'id' => $prefix . 'parcours',
                'type' => 'textarea',
            ),
            array(
                'name' => 'Liste des moyens de contact',
                'id' => $prefix . 'contact',
                'type' => 'text_list',
                'options' => array(
                    'Twitter' => 'Twitter',
                    'Site web' => 'Site web',
                    'Mail' => 'Mail'
                )
            ),
        )
    );

    $meta_boxes[] = array(
        'title' => 'Information sur la publication',
        'pages' => array('publications'),
        'fields' => array(
            array(
                'name' => 'Nom de(s) auteur(s)',
                'id' => $prefix . 'nomAuteur',
                'type' => 'text'
            ),
            array(
                'name' => 'Nom de la collection',
                'id' => $prefix . 'nomCollection',
                'type' => 'text'
            ),
            array(
                'name' => 'Début de publication',
                'id' => $prefix . 'debutPub',
                'type' => 'date',

                // option de format de date ici : http://api.jqueryui.com/datepicker
                'js_options' => array(
                    'dateFormat' => 'dd-mm-yy',
                    'showButtonPanel' => false,
                ),

                // afficher en ligne
                'inline' => false,

                // Enregistrer la valeur en tant qu'horodatage ?
                'timestamp' => false,
            ),
            array(
                'name' => 'Publication finie',
                'id' => $prefix . 'finPub',
                'type' => 'checkbox',
                'std' => 0, // 0 (non coché par défaut) ou 1 pour cocher
            ),
            array(
                'name' => 'Lien d\'achat',
                'id' => $prefix . 'lienPub',
                'type' => 'url'
            ),
            array(
                'name' => 'Responsable de la collection',
                'id' => $prefix . 'respPub',
                'type' => 'text'
            ),
            array(
                'name' => 'Contact',
                'id' => $prefix . 'contactPub',
                'type' => 'text'
            )
        )
    );

    $meta_boxes[] = array(
        'title' => 'Information sur la formation',
        'pages' => array('formations'),
        'fields' => array(
            array(
            'name' => 'Directeur',
            'id' => $prefix.'dirForm',
            'type' => 'text'
            ),
            array(
                'name' => 'Adresse',
                'id' => $prefix.'adresseForm',
                'type' => 'text'
            ),
            array(
                'name' => 'Site web',
                'id' => $prefix.'siteForm',
                'type' => 'url'
            )
        )
    );

    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'ajout_meta_boxes');