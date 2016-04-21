<?php
/**
* the following displays a list of the 10 most recent weblog titles
* and links to the full weblogs of a certain user.
* If you want to increase/reduce
* the number of titles displayed..simply change the $listlength value
*
* for a different user change the $userid value
*
* works with drupal 4.6.
*
*/
	$listlength = "10";
	$userid = "4";

	$output = node_title_list(db_query_range(db_rewrite_sql("SELECT n.nid, n.title, n.created FROM {node} n WHERE n.type = 'blog' AND n.uid = $userid AND n.status = 1 ORDER BY n.created DESC"), 0, $listlength));
	print $output;
?>