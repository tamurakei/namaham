<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、MySQL、テーブル接頭辞、秘密鍵、ABSPATH の設定を含みます。
 * より詳しい情報は {@link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86 
 * wp-config.php の編集} を参照してください。MySQL の設定情報はホスティング先より入手できます。
 *
 * このファイルはインストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さず、このファイルを "wp-config.php" という名前でコピーして直接編集し値を
 * 入力してもかまいません。
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wp_namaham');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'wp_namaham');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'Nef7rPQzELjrYP3W');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$R37zzjJ0jui]tmoBTBo~AR=v~su!moL;V&A^|g#eFx&RyRwuD>>]#!Y;2@|JL7(');
define('SECURE_AUTH_KEY',  'DZ_],s{+P4:J#J607[YDZYIC5k~5F$rk0@DKX?1NBSwT*XZ{f]mz*_,uF$d$]`J2');
define('LOGGED_IN_KEY',    'UB)bU&A(*%F0*$RfiA-D?.w]-Kx,!dlKS4&`5-3Erd?b3#Lt21.;$U%sX}6~6g1l');
define('NONCE_KEY',        '49ef;F877a/=m!8NY3sE-1<hS$J5q)lw}RMCe#TZ%]}ZB9yW4I%i4,bT90o$0M!}');
define('AUTH_SALT',        'w)f#`5CYsj8[quQ=6>ZVlkkEM$&nO&5<Bf67;mt7L7z`P?r*.!kC(N^Qi NM$usr');
define('SECURE_AUTH_SALT', '*9 YY^0 6TV[6xB,z;Yr=GH>FXa*w~muIU]` m(}H;35E,<1~l:azgh&p=}%yoI@');
define('LOGGED_IN_SALT',   '|=uoLWQgsGJBQ(#_&~CYoLa/5l!FjOcf)NtE7A^`mEkd~:8B2x|`whMdgg9n2(wE');
define('NONCE_SALT',       '+_V3@,%HJ{&N0Gz*+2rhE[^s;*=/1/~2`YKFTctbao&w^{1u.P?~+O}^US0:A&*r');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 */
define('WP_DEBUG', false);

#define('WP_ALLOW_MULTISITE', true);
#define('FORCE_SSL_ADMIN', true);
define('WP_CACHE', true);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
