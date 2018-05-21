<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'sprout-spoon');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', '127.0.0.1');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'H<L2dSz>&ZGe_FeF,[V,ayK?}|5q&M}.PiE _1EJc`rxwt:Xho?PFP[^l]=`{UN7');
define('SECURE_AUTH_KEY',  '60pq67T/_6eynnr<<n-uJ=,UXsN[G1cA}6?H1[^;8R#I2&l^k>I&L9x|#T8,f+9F');
define('LOGGED_IN_KEY',    '#,2=[wYp}n:4#abS|K`?vgJZ`eG}M^X)3VkZLm#DaGgnopQPZ;zv~MH6n9st0)(K');
define('NONCE_KEY',        'J<Q>s0QGUhZfF&J,i0`p1^Y&7)+u;sGTTlIlkMgNePxV,ofagsV%~VZxcGQcw~)s');
define('AUTH_SALT',        ' K]!}r_to&6O:*,|7h:FUv[o[N{=uSy;qd/e!jT)[1U;ojI-dKQ7p_`n!~[Roof]');
define('SECURE_AUTH_SALT', 'O3IOcQ}7Y8p(vTz8H|-KX7/{Jx~Z7A_u*2=KFbL9qL<8Vy}Rx|[}nF2`(3]2qWE7');
define('LOGGED_IN_SALT',   'T3L1Nq.f#bSML(^S>YReJIjMx=)`z1JEl~@@RAWZeh8efTp+|qWGa`e! D<K*c}Y');
define('NONCE_SALT',       '>u%&ixF<h#e^c,}56R%/|oW0,OTsZyDroP`{5#b&ZgPwl,oFpi`{,fg</VWy/Voo');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
