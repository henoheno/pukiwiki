<?php
/////////////////////////////////////////////////
// PukiWiki - Yet another WikiWikiWeb clone.
//
// $Id: init.php,v 1.26 2003/02/15 13:10:38 panda Exp $
//

/////////////////////////////////////////////////
// 初期設定
define('ENCODING','EUC-JP');
define('LANG','ja');

/////////////////////////////////////////////////
// 初期設定 (バージョン/著作権)
define('S_VERSION','1.4pre4');
define('S_COPYRIGHT','
<strong>"PukiWiki" '.S_VERSION.'</strong> Copyright &copy; 2001,2002
<a href="http://pukiwiki.org">PukiWiki Developers Team</a>.
License is <a href="http://www.gnu.org/">GNU/GPL</a>.<br />
Based on "PukiWiki" 1.3 by <a href="http://factage.com/sng/">sng</a>
');

/////////////////////////////////////////////////
// 初期設定 (サーバ変数)
foreach (array('HTTP_USER_AGENT','PHP_SELF','SERVER_NAME','SERVER_SOFTWARE','SERVER_ADMIN') as $key) {
	define($key,array_key_exists($key,$HTTP_SERVER_VARS) ? $HTTP_SERVER_VARS[$key] : '');
}

/////////////////////////////////////////////////
// 初期設定(時間)
define('LOCALZONE',date('Z'));
define('UTIME',time() - LOCALZONE);
define('MUTIME',getmicrotime());

/////////////////////////////////////////////////
// 言語ファイル読み込み
if (!file_exists(LANG.'.lng')||!is_readable(LANG.'.lng')) {
	die_message(LANG.'.lng(language file) is not found.');
}
require(LANG.'.lng');

/////////////////////////////////////////////////
// 初期設定(設定ファイルの場所)
define('INI_FILE','./pukiwiki.ini.php');

/////////////////////////////////////////////////
// 設定ファイル読み込み
if (!file_exists(INI_FILE)||!is_readable(INI_FILE)) {
	die_message(INI_FILE.' is not found.');
}
require(INI_FILE);

/////////////////////////////////////////////////
// 設定ファイルの変数チェック
if(!is_writable(DATA_DIR)) {
	die_message('DATA_DIR is not found or not writable.');
}
if(!is_writable(DIFF_DIR)) {
	die_message('DIFF_DIR is not found or not writable.');
}
if($do_backup && !is_writable(BACKUP_DIR)) {
	die_message('BACKUP_DIR is not found or not writable.');
}
$wrong_ini_file = '';
if (!isset($rss_max)) $wrong_ini_file .= '$rss_max ';
if (!isset($page_title)) $wrong_ini_file .= '$page_title ';
if (!isset($note_hr)) $wrong_ini_file .= '$note_hr ';
if (!isset($related_link)) $wrong_ini_file .= '$related_link ';
if (!isset($show_passage)) $wrong_ini_file .= '$show_passage ';
if (!isset($rule_related_str)) $wrong_ini_file .= '$rule_related_str ';
if (!isset($load_template_func)) $wrong_ini_file .= '$load_template_func ';
if (!defined('LANG')) $wrong_ini_file .= 'LANG ';
if (!defined('PLUGIN_DIR')) $wrong_ini_file .= 'PLUGIN_DIR ';
if ($wrong_ini_file) {
	die_message('The setting file runs short of information.<br>The version of a setting file may be old.<br><br>These option are not found : '.$wrong_ini_file);
}
if (!is_page($defaultpage)) {
	touch(get_filename($defaultpage));
}
if (!is_page($whatsnew)) {
	touch(get_filename($whatsnew));
}
if (!is_page($interwiki)) {
	touch(get_filename($interwiki));
}

/////////////////////////////////////////////////
// 初期設定($script)
if (!isset($script) or $script == '') {
	$script =
		 ($_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://')
		. $_SERVER['SERVER_NAME']
		.($_SERVER['SERVER_PORT'] == 80 ? '' : ':'.$_SERVER['SERVER_PORT'])
		. $_SERVER['SCRIPT_NAME'];
}
if (php_sapi_name() == 'cgi' && !preg_match("/^http:\/\/[-a-zA-Z0-9\@:;_.]+\//",$script)) {
	die_message("please set '\$script' in ".INI_FILE);
}

/////////////////////////////////////////////////
// 入力値の整形
$cookie = $HTTP_COOKIE_VARS;
if (get_magic_quotes_gpc()) {
	$get = $post = $cookie = array();
	foreach($HTTP_GET_VARS as $key => $value) {
		if (!is_array($value)) {
			$get[$key] = stripslashes($value);
		}
	}
	foreach($HTTP_POST_VARS as $key => $value) {
		$post[$key] = stripslashes($value);
	}
	foreach($HTTP_COOKIE_VARS as $key => $value) {
		$cookie[$key] = stripslashes($value);
	}
}
else {
	$post = is_array($HTTP_POST_VARS) ? $HTTP_POST_VARS : array();
	$get = is_array($HTTP_GET_VARS) ? $HTTP_GET_VARS : array();
}
if (!empty($get['page'])) {
	$get['page']  = preg_replace('/^(\[\[)?(.*)(?(1)\]\])$/','$2',$get['page']);
}
if (!empty($post['page'])) {
	$post['page'] = preg_replace('/^(\[\[)?(.*)(?(1)\]\])$/','$2',$post['page']);
}
if (!empty($post['msg'])) {
	$post['msg']  = preg_replace("/\r/",'',$post['msg']);
}
/*
if (!empty($post['word'])) {
	$post['word'] = $post['word'];
}
if (!empty($get['word'])) {
	$get['word']  = $get['word'];
}
*/

@$vars = array_merge($post,$get);
if (!array_key_exists('page',$vars)) {
	$get['page'] = $post['page'] = $vars['page'] = '';
}

$arg = rawurldecode((getenv('QUERY_STRING') != '') ? getenv('QUERY_STRING') :
	(array_key_exists(0,$HTTP_SERVER_VARS['argv']) ? $HTTP_SERVER_VARS['argv'][0] : ''));

/////////////////////////////////////////////////
// 初期設定($WikiName,$BracketNameなど)
// $WikiName = '[A-Z][a-z]+(?:[A-Z][a-z]+)+';
// $WikiName = '\b[A-Z][a-z]+(?:[A-Z][a-z]+)+\b';
$WikiName = '(?<![[:alnum:]])(?:[[:upper:]][[:lower:]]+){2,}(?![[:alnum:]])';
// $BracketName = ':?[^\s\]#&<>":]+:?';
$BracketName = '(?!\s):?[^\r\n\t\f\[\]<>#&":]+:?(?<!\s)';
// InterWiki
$InterWikiName = "(\[\[)?(\[*[^\s\]]+?\]*):(\[*[^>\]]+?\]*)(?(1)\]\])";
// 注釈
$NotePattern = '/\(\(((?:(?>(?:(?!\(\()(?!\)\)(?:[^\)]|$)).)+)|(?R))*)\)\)/ex';

/////////////////////////////////////////////////
// 初期設定(その他のグローバル変数)
// 現在時刻
$now = format_date(UTIME);
// 脚注
$foot_explain = array();
// 関連するページ
$related = array();
// skin内でDTD宣言を切り替えるのに使用。paint.inc.php対策
// FALSE:XHTML 1.1
// TRUE :XHTML 1.0 Transitional
$html_transitional = FALSE;
// フェイスマークを$line_rulesに加える
if ($usefacemark) {
	$line_rules = array_merge($line_rules,$facemark_rules);
}
// ユーザ定義ルール
$user_rules = array_merge($str_rules,$line_rules);

/////////////////////////////////////////////////
// 初期設定(URL変数の処理)
// 後方互換性 (?md5=...)
if (array_key_exists('md5',$vars) and $vars['md5'] != '') {
	$vars['cmd'] = 'md5';
}

// cmdもpluginも指定されていない場合は、$argをページ名かInterWikiNameであるとみなす
if (!array_key_exists('cmd',$vars)  and !array_key_exists('plugin',$vars)) {
	//$argも指定されていなかった場合は$defaultpageを表示
	if ($arg == '') {
		$arg = $defaultpage;
	}
	$get['cmd'] = $post['cmd'] = $vars['cmd'] = 'read';
	$get['page'] = $post['page'] = $vars['page'] = preg_replace('/^(\[\[)?(.*)(?(1)\]\])$/','$2',$arg);
}
?>
