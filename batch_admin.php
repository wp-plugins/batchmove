<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */

echo '<h1>'.BM_HEADER.'</h1>';
global $bm;
/**
 * Post values
 *
 */
execute_action($bm, $_POST);

/**
 * Echo form to filter data
 *
 */

echo $html = show_bm_selector($bm);
/**
 * Get query fields and values
 *
 */

$q = get_a_query($bm);

/**
 * Get date query values, even a RANGE will work!
 *
 */
if ( !empty($bm->get['iDate']) || !empty($bm->get['oDate'])) {
	if (!empty($bm->get['iDate']) && empty($bm->get['oDate'])) {
		$fdate = $bm->get['iDate'];
		$dt = split('-', $fdate);
		$q['year'] = $dt[0];
		$q['monthnum'] = $dt[1];
		$q['day'] = $dt[2];
	} elseif ( !empty($bm->get['iDate']) && !empty($bm->get['oDate'])) {
		function filter_where($where = '') {
			global $bm;
			//posts in the last 30 days
			//$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
			//posts  30 to 60 days old
			//$where .= " AND post_date >= '" . date('Y-m-d', strtotime('-60 days')) . "'" . " AND post_date <= '" . date('Y-m-d', strtotime('-30 days')) . "'";
			//posts for March 1 to March 15, 2009
			$where .= ' AND post_date >= "'.$_GET['iDate'].'" AND post_date <= "'.$_GET['oDate'].'" ' ;
			return $where;
		}
		$filter = add_filter('posts_where', 'filter_where');
	}
}

/**
 * Create WP_Wquery object
 *
 */

$query = new WP_Query;

//echo $q;

/**
 * Execute query
 *
 */
//$query->set('hide_empty' ,0);
$posts = $query->query($q);

if ($bm->cat == "") {return;}
/**
 *  Stuppid, table used to force footer down
 *
 */
$html  = '<table width="100%"><tr><td>';
/**
 * Set some page pagination
 *
 */
$html .= get_pagination($bm,$query->max_num_pages);
/**
 * Get query result information
 *
 */
$html .= get_information($bm, $query->found_posts);
/**
 * Start form with results
 *
 */
$html .= '<form name="selector" id="selector" method="post" action="edit.php?page=batchadmin">';//actio = edit.php
$html .= '<input type="hidden" name="page" value="batchadmin" />';

/**
 * Get results
 *
 */
$html .= get_results($bm, $posts);
/**
 * Show action buttons
 *
 */
$html .= show_bm_actions($bm);
$html .= '</form>';
echo $html;
echo '</td></tr></table>';
echo '<div class="clear"></div>';
/**
 * Echo query string
 *
 */
//echo '<br />' . $query->request ;
//echo get_bloginfo('language');
//echo getcwd();



?>