<?php
/////////////////////////////////////////////////
// PukiWiki - Yet another WikiWikiWeb clone.
//
// $Id: pukiwiki.ini.php,v 1.16.2.8 2004/07/31 03:12:13 henoheno Exp $
//
// PukiWiki setting file

/////////////////////////////////////////////////
// ディレクトリ指定 最後に / が必要 属性は 777
/////////////////////////////////////////////////
// データの格納ディレクトリ
define('DATA_DIR','./wiki/');
/////////////////////////////////////////////////
// 差分ファイルの格納ディレクトリ
define('DIFF_DIR','./diff/');
/////////////////////////////////////////////////
// バックアップファイル格納先ディレクトリ
define('BACKUP_DIR','./backup/');
/////////////////////////////////////////////////
// キャッシュファイル格納ディレクトリ
define('CACHE_DIR','./cache/');
/////////////////////////////////////////////////
// 添付ファイル格納ディレクトリ
define('UPLOAD_DIR','./attach/');
/////////////////////////////////////////////////
// カウンタファイル格納ディレクトリ
define('COUNTER_DIR', './counter/');

/////////////////////////////////////////////////
// ディレクトリ指定 最後に / が必要
/////////////////////////////////////////////////
// プラグインファイル格納先ディレクトリ
define('PLUGIN_DIR','./plugin/');
/////////////////////////////////////////////////
// スキン/スタイルシートファイル格納ディレクトリ
define('SKIN_DIR','./skin/');
/////////////////////////////////////////////////
// 画像ファイル格納ディレクトリ
define('IMAGE_DIR','./image/');

/////////////////////////////////////////////////
// スキンファイルの場所
define("SKIN_FILE","./skin/pukiwiki.skin.".LANG.".php");

/////////////////////////////////////////////////
// index.php などに変更した場合のスクリプト名の設定
// とくに設定しなくても問題なし
//$script = "http://hogehoge/pukiwiki/";

/////////////////////////////////////////////////
// トップページの名前
$defaultpage = "FrontPage";
/////////////////////////////////////////////////
// 更新履歴ページの名前
$whatsnew = "RecentChanges";
/////////////////////////////////////////////////
// InterWikiNameページの名前
$interwiki = "InterWikiName";
/////////////////////////////////////////////////
// 編集者の名前(自由に変えてください)
$modifier = 'me';
/////////////////////////////////////////////////
// 編集者のホームページ(自由に変えてください)
$modifierlink = 'http://change me!/';

/////////////////////////////////////////////////
// ホームページのタイトル(自由に変えてください)
// RSS に出力するチャンネル名
$page_title = "PukiWiki";

/////////////////////////////////////////////////
// 凍結機能を有効にするか
$function_freeze = 1;
/////////////////////////////////////////////////
// 管理者パスワード

// 以下は md5('pass') の出力結果です
$adminpass = '1a1dc91c907325c69271ddf0c944bc72';

// = 注意 =
//
// パスワードを設定する方法として、md5()関数を使う方法と、
// md5()関数の結果を別途算出して使う方法があります。
// あなたがコンピュータの操作に充分慣れているのであれば、
// 後者をお勧めします。
//
// 例えばパスワードを「pass」としたい場合、以下の様に記述する
// ことができます。
//
// $adminpass = md5('pass');	// md5() 関数を使う方法
//
// ただし、この方法では、このファイルを覗き見ることができる
// (できた) 誰かに、パスワードそのものを知られる高い危険性が
// あります。この危険性を下げるために、MD5関数の結果だけを
// 記述することができます。
//
// MD5関数の結果(ハッシュ)は0から9の数字と、AからFまでの英字
// からなる32文字の文字列で、この情報だけでは元の文字列を
// 推測することは困難です。
//
// 'pass' のMD5ハッシュを算出するには、Linuxやcygwinであれば
//    $ echo -n 'pass' | md5sum
// の様にして算出する事ができます。('-n' オプションを忘れずに!)
// FreeBSDなどではmd5sumの代わりにmd5コマンドを使ってください。
//
// お勧めできませんが、PukiWikiのmd5コマンドでも算出が可能です。
// http://<設置した場所>/pukiwiki.php?md5=pass
// このURLにアクセスすることで、算出結果が表示されます。その
// かわり、あなたがタイプしたパスワードはネットワークを流れ、
// 誰にでも覗き見ができ、Webサーバーのログにも残ってしまう、
// といった様々なリスクを負う可能性があります。あなたが使って
// いるコンピュータ、サーバーまでのネットワーク、サーバーの
// どこかが信頼できないのであれば、この方法は使わないで下さい。

/////////////////////////////////////////////////
// 更新履歴を表示するときの最大件数
$maxshow = 80;
/////////////////////////////////////////////////
// 編集することのできないページの名前 , で区切る
$cantedit = array( $whatsnew, );

/////////////////////////////////////////////////
// プレビューを表示するときのテーブルの背景色
$preview_color = "#F5F8FF";
/////////////////////////////////////////////////
// [[ページ]] へのリンク時[[]]を外すか
$strip_link_wall = 1;
/////////////////////////////////////////////////
// 一覧ページに頭文字インデックスをつけるか
$list_index = 1;
/////////////////////////////////////////////////
// http:// リンクのウィンドウ名指定(_top,_blank,etc)
$link_target = "_top";
/////////////////////////////////////////////////
// InterWikiNameのウィンドウ名指定(_top,_blank,etc)
$interwiki_target = "_top";

/////////////////////////////////////////////////
// リスト構造の左マージン
$_list_left_margin = 0; // リストと画面左端との間隔(px)
$_list_margin = 16;      // リストの階層間の間隔(px)
$_list_pad_str = ' class="list%d" style="padding-left:%dpx;margin-left:%dpx"';

/////////////////////////////////////////////////
// テキストエリアのカラム数
$cols = 80;
/////////////////////////////////////////////////
// テキストエリアの行数
$rows = 20;

/////////////////////////////////////////////////
// 大・小見出しから目次へ戻るリンクの文字
$top = $_msg_content_back_to_top;
/////////////////////////////////////////////////
// 関連ページ表示のページ名の区切り文字
$related_str = " ";
/////////////////////////////////////////////////
// 整形ルールでの関連ページ表示のページ名の区切り文字
$rule_related_str = "\n<li>";
/////////////////////////////////////////////////
// 水平線のタグ
$hr = '<hr class="full_hr">';
/////////////////////////////////////////////////
// 文末の注釈の直前に表示するタグ
$note_hr = '<hr class="note_hr">';
/////////////////////////////////////////////////
// 関連するリンクを常に表示する(負担がかかります)
$related_link = 1;
/////////////////////////////////////////////////
// WikiName,BracketNameに経過時間を付加する
$show_passage = 1;

/////////////////////////////////////////////////
// Last-Modified ヘッダを出力する
$lastmod = 0;

/////////////////////////////////////////////////
// 日付フォーマット
$date_format = "Y-m-d";
/////////////////////////////////////////////////
// 時刻フォーマット
$time_format = "H:i:s";
/////////////////////////////////////////////////
// 曜日配列
$weeklabels = $_msg_week;

/////////////////////////////////////////////////
// RSS に出力するページ数
$rss_max = 15;

/////////////////////////////////////////////////
// バックアップを行うか指定します 0 or 1
$do_backup = 1;
/////////////////////////////////////////////////
// ページを削除した際にバックアップもすべて削除する
$del_backup = 0;
/////////////////////////////////////////////////
// 定期バックアップの間隔を時間(hour)で指定します(0で更新毎)
$cycle = 6;
/////////////////////////////////////////////////
// バックアップの最大世代数を指定します
$maxage = 20;
/////////////////////////////////////////////////
// バックアップの世代を区切る文字列を指定します
// (通常はこのままで良いが、文章中で使われる可能性
// があれば、使われそうにない文字を設定する)
$splitter = ">>>>>>>>>>";
/////////////////////////////////////////////////
// ページの更新時にバックグランドで実行されるコマンド(mknmzなど)
//$update_exec = '/usr/local/bin/mknmz -O /vhosts/www.factage.com/sng/pukiwiki/nmz -L ja -k -K /vhosts/www.factage.com/sng/pukiwiki/wiki';

/////////////////////////////////////////////////
// 一覧・更新一覧に含めないページ名(正規表現で)
$non_list = "^(\[\[\:)";

/////////////////////////////////////////////////
// 雛形とするページの読み込みを表示させるか
$load_template_func = 1;

/////////////////////////////////////////////////
// ページ名に従って自動で、雛形とするページの読み込み
$auto_template_func = 1;
$auto_template_rules = array(
'\[\[((.+)\/([^\/]+))\]\]' => '[[\2/template]]'
);

/////////////////////////////////////////////////
// ユーザ定義ルール
//
//  正規表現で記述してください。?(){}-*./+\$^|など
//  は \? のようにクォートしてください。
//  前後に必ず / を含めてください。行頭指定は ^ を頭に。
//  行末指定は $ を後ろに。
//
/////////////////////////////////////////////////
// ユーザ定義ルール(直接ソースを置換)
$str_rules = array(
"now\?" => date($date_format,UTIME)." (".$weeklabels[date("w",UTIME)].") ".date($time_format,UTIME),
"date\?" => date($date_format,UTIME),
"time\?" => date($time_format,UTIME),
);

/////////////////////////////////////////////////
// ユーザ定義ルール(コンバート時に置換、直接しない)
$line_rules = array(
"COLOR\(([^\(\)]*)\){([^}]*)}" => "<span style=\"color:\\1\">\\2</span>",
"SIZE\(([^\(\)]*)\){([^}]*)}" => "<span style=\"font-size:\\1px;display:inline-block;line-height:130%;text-indent:0px\">\\2</span>",
"COLOR\(([^\(\)]*)\):((?:(?!COLOR\([^\)]+\)\:).)*)" => "<span style=\"color:\\1\">\\2</span>",
"SIZE\(([^\(\)]*)\):((?:(?!SIZE\([^\)]+\)\:).)*)" => "<span class=\"size\\1\">\\2</span>",
"LEFT:((?:(?!LEFT\:).)*)" => "<div style=\"text-align:left\">\\1</div>",
"CENTER:((?:(?!CENTER\:).)*)" => "<div style=\"text-align:center\">\\1</div>",
"RIGHT:((?:(?!RIGHT\:).)*)" => "<div style=\"text-align:right\">\\1</div>",
"%%((?:(?!%%).)*)%%" => "<del>\\1</del>",
"'''((?:(?!''').)*)'''" => "<em>\\1</em>",
"''((?:(?!'').)*)''" => "<strong>\\1</strong>",
"~((?:<\\/[a-zA-Z]+>)*)$" => "\\1<br />", /* 行末にチルダは改行 */
"&amp;aname\(([A-Za-z][\w\-]*)\);" => "<a id=\"\\1\" name=\"\\1\"></a>",
);

/////////////////////////////////////////////////
// フェイスマーク定義ルール
// $usefacemark = 1ならフェイスマークが置換されます
// 文章内にXDなどが入った場合にfacemarkに置換されてしまうので
// 必要のない方は $usefacemarkを0にしてください。
$usefacemark = 1;
$facemark_rules = array(
	"\s(\:\))"	=> " <img alt=\"\\1\" src=\"./face/smile.gif\" />",
	"\s(\:D)"	=> " <img alt=\"\\1\" src=\"./face/bigsmile.gif\" />",
	"\s(\:p)"	=> " <img alt=\"\\1\" src=\"./face/huh.gif\" />",
	"\s(\:d)"	=> " <img alt=\"\\1\" src=\"./face/huh.gif\" />",
	"\s(XD)"	=> " <img alt=\"\\1\" src=\"./face/oh.gif\" />",
	"\s(X\()"	=> " <img alt=\"\\1\" src=\"./face/oh.gif\" />",
	"\s(;\))"	=> " <img alt=\"\\1\" src=\"./face/wink.gif\" />",
	"\s(;\()"	=> " <img alt=\"\\1\" src=\"./face/sad.gif\" />",
	"\s(\:\()"	=> " <img alt=\"\\1\" src=\"./face/sad.gif\" />",
	"&amp;(heart);" => " <img alt=\"\\1\" src=\"./face/heart.gif\" />",
);

?>
