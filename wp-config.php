<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'elliadd');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '29Q2e<]GXGow:1?Tc;fY8kh.:z87bT0@#73&Pt!1Rj<RSax/JRqvUBdISpX%yklS');
define('SECURE_AUTH_KEY',  '|?Sp^BpO9){Y=PlANWati@1.TDujms,^K)iH1v^v^V~i-Za.vggXkIbQB3zX1KQ8');
define('LOGGED_IN_KEY',    ':Z(8>o,6>VK6>*Ca3n<9l*@X4-c}s4~vK._lFRPkWZUt8x1Wku9f/q Uj/-Xecbk');
define('NONCE_KEY',        '?+BV|8&5d;} Vp$<oeB@L<#.hiN]`R:e]bDM3Wj>&7zkSAn$f~fyf[uPd})_0m`t');
define('AUTH_SALT',        'nf*%T:*=v>D3qFMBxMd^,Qx+E%K/?~c4[!n$pBH}UIP-.Lh_6ah$F9F7(TSn~=fH');
define('SECURE_AUTH_SALT', 'enLR@k`vIzL4cr1q5^6=-;Q!yq6f0LQGFr~A$;VY#D2c08R3G|x-,/{h3~auxzfL');
define('LOGGED_IN_SALT',   '{le&DIL<d6D3|6<:i#|D@sb2fv;91FI8fZ]9Sp^n4@2YU|!uwJ)ZrXOosa+MqPdu');
define('NONCE_SALT',       'ANWhAN8Tv$<j$fQnV=z*G&z(4PNM8p#Rs`nBJnbFZ=,{OD+.AD(2*_uFPUtW0gwK');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');