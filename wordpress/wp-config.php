<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'asm' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );



/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'cNU@vC1.@T`c:;Vw|pNHG/}5:1dnW`b[q;lDAm0wr.pmDj %3nqTT{cbbAsx9s$N' );
define( 'SECURE_AUTH_KEY',  'U(t*u9PqVMu]KpS#?vb}h u$xOOr}Ei`P>AqQ+g!r(ZDj3+r$GMy_~oZlh4<y9<V' );
define( 'LOGGED_IN_KEY',    'X?uoV[CS_lB(K-LQzB9j)Ri)&~hh0<Y.>,f5;B104 wpWlWM9zCO>cO90?()N/6<' );
define( 'NONCE_KEY',        'IUIgA@QB)n;pZ68+tZ=@TEN*WqUF2pS-{0Zoq6S7wu=QC#dnce#<Y+JxKcIArnKG' );
define( 'AUTH_SALT',        'Mj0}nbb/V3w,s<|j11u,f)BrK (!jlf3AEs*?(h&u|E U9Jz2-}j+dV#dVlfj|~6' );
define( 'SECURE_AUTH_SALT', 'D1>c10_pft-dN1[&I39^0mju<%aYI)A/%~uC|UU)INq+?YMlMt)/Q3^I,6&G]%/b' );
define( 'LOGGED_IN_SALT',   'H(=` c9Y{-y bl.32/S6_/ }|240~d,CmwL,OpGQSwD22Ji^vx//w5J45_6rOH3T' );
define( 'NONCE_SALT',       '@N{.p>g(-Zr;+R3C` *viZS$b8D}X>i>.2&Ps]S6i m3LGFw3w9Eh]tN:f}TAIgW' );
/**#@-*/

define( 'WP_MEMORY_LIMIT', '256M' );



/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
