<?php
$conn = @mysql_connect("localhost","root","root");
if (!$conn){
	die("连接数据库失败：" . mysql_error());
}
mysql_select_db("test", $conn);

/*
CREATE TABLE `user` (
  `uid` mediumint(8) unsigned NOT NULL auto_increment,
  `username` varchar(16) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `email` varchar(40) NOT NULL default '',
  `regdate` int(10) unsigned NOT NULL default '0',
  `truename` varchar(16) NOT NULL default '',
  `year` varchar(16) NOT NULL default '',
  `learn` varchar(32) NOT NULL default '',
  `work` varchar(255) NOT NULL default '',
  `tel` varchar(32) NOT NULL default '',
  `location` varchar(255) NOT NULL default '',
  `usr_type` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/
?>