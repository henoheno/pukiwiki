<?php
/*
 * PukiWiki カウンタープラグイン
 *
 * CopyRight 2002 Y.MASUI GPL2
 * http://masui.net/pukiwiki/ masui@masui.net
 *
 * $Id: counter.inc.php,v 1.5.2.1 2003/01/27 04:13:29 panda Exp $
 */

// counter file
define(COUNTER_DIR, "./counter/");

function plugin_counter_convert()
{
	global $vars,$HTTP_SERVER_VARS;
	
	if (arg_check("add") || arg_check("edit") || arg_check("preview") || $vars['preview'] != '' || $vars['write'] != '') {
		return "";
	}
	
	$file = COUNTER_DIR.encode($vars["page"]).".count";
	if(!file_exists($file))
	{
		$nf = fopen($file, "w");
		fputs($nf,"0\n0\n0\n0\n\n");
		fclose($nf);
	}
	$array = file($file);
	$count = rtrim($array[0]);
	$today = rtrim($array[1]);
	$today_count = rtrim($array[2]);
	$yesterday_count = rtrim($array[3]);
	$ip = rtrim($array[4]);
	if($ip != $HTTP_SERVER_VARS["REMOTE_ADDR"] && !(arg_check("add") || arg_check("edit") || arg_check("preview") || $vars['preview'] != '' || $vars['write'] != '')) {
		$t = date("Y/m/d");
		if($t != $today) {
			$yesterday_count = $today_count;
			$today_count = 0;
			$today = $t;
		}
		++$count;
		++$today_count;
	}
	
	$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
	$nf = fopen($file, "w");
	fputs($nf,"$count\n");
	fputs($nf,"$today\n");
	fputs($nf,"$today_count\n");
	fputs($nf,"$yesterday_count\n");
	fputs($nf,"$ip\n");
	fclose($nf);
	
	return "<span class=\"counter\">Counter: $count, today: $today_count, yesterday: $yesterday_count</span>";

}
?>
