<?php
//include BATCH_PLUGIN_DIR . '/include/config.inc.php';

function execute_action(batchMove $bm, $apost=array()){
	//$_SERVER
	$do = strpos($_SERVER['HTTP_REFERER'],'page=batchadmin')>0;
	if (!current_user_can(USERLEVEL)) {
		die (__($bm->information['noright']));
	} else {
		if ( !empty($apost) && $do ) {
			$cat = intval($apost['qcat']);
			$num = count($apost['ids']);
			if (!empty($apost['qcat']))
				$query = '&cat=' . $apost['qcat'];
			if (!empty($apost['s']))
				$query = '&s=' . $apost['keywords'];
			if (!empty($apost['t']))
				$query = '&t=' . $apost['tag'];

			if ($apost['submit'] == 'send-cat') {
				switch ($apost['act-cats']) {
					case "add":
						foreach ((array) $apost['ids'] as $id) {
							$id = intval($id);
							$cats = wp_get_post_categories($id);
							if (!in_array($cat, $cats)) {
								$cats[] = intval($cat);
								wp_set_post_categories($id, $cats);
							}
						}
						//wp_redirect(get_option('siteurl') . "/wp-admin/edit.php?page=batch_categories&done=add&what=" . get_cat_name($cat) . "&num=$num$query");
						break;
					case 'upd':
						foreach ((array) $apost['ids'] as $id) {
							$new = array();
							$new[] = intval($cat);
							wp_set_post_categories($id, (array) $new);
						}
							break;
					case 'del':
						foreach ((array) $apost['ids'] as $id) {
							$id = intval($id);
							$existing = wp_get_post_categories($id);
							$new = array();
							foreach ((array) $existing as $_cat) {
								if ($cat != $_cat)
									$new[] = intval($_cat);
							}
							wp_set_post_categories($id, (array) $new);
						}
						break;
					default:
					;
				} // switch
			} elseif ($apost['submit'] == 'send-tag') {
				switch ($apost['act-tags']) {
					case "add":
						;
						break;
					case 'upd':
						;
						break;
					case 'del':
						;
						break;
					default:
					;
				} // switch
			}
		}
	}
}

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */

function show_bm_selector(batchMove $bm){
	$html   = '<div id="selector">';
	$html .= '<form name="selector" id="selector" method="get" action="edit.php">';//actio = edit.php
	$html .= '<input type="hidden" name="page" value="batchadmin" />';
	$html .= '<fieldset style="border:solid black 1px;padding:5px;">';
	$html .= '<legend class="legend">'.BM_FILTER.'</legend>';
	$html .= '<table border="0" cellspacing="5" width="100%">';
	$html .= '<tr>';
	$html .= '<td>' . $bm->frmlabels['rows'];
	$html .= '</td>';
	$html .= '<td>' . '<input name="row_amount" type="text" value="'.$bm->per_page.'" />';
	$html .= '</td>';
	$html .= '<td>' . $bm->frmlabels['sortby'];
	$html .= '</td>';
	$html .= '<td>';
	$html .= '<select name="orderby" id="orderby">';
	foreach ($bm->orderbydef as $key => $value) {
		$selected = ( $bm->orderby == $key ) ? ' selected="selected"' : '';
		$html .=  '<option value="'.$key.'"'.$selected .'>'.$value.'&nbsp;</option>\n';
	}
	$html .= '</select>';
	$html .= '</td>';
	$html .= '<td>' . $bm->frmlabels['desc'];
	$html .= '</td>';
	$html .= '<td>';
	$html .= '<select name="order" id="order">';
	foreach ($bm->orderdef as $key => $value) {
		$selected = ( $bm->order == $key ) ? ' selected="selected"' : '';
		$html .=  '<option value="'.$key.'"'.$selected .'>'.$value.'&nbsp;</option>\n';
	}
	$html .= '</select>';
	$html .= '</td>';
	$html .= '<td rowspan="3" style="text-align:right"><img src="'.BATCH_PLUGIN_URL.'/include/ade.png" align="right" /></td>';
	$html .= '</tr>';

	$html .= '<tr>';
	$html .= '<td>' . $bm->frmlabels['category'];
	$html .= '</td>';
	$html .= '<td>';
	$html .= wp_dropdown_categories('hide_empty=0&hierarchical=1&echo=0&selected=' .
			( isset($_REQUEST['cat']) ? intval($_REQUEST['cat']) : -1 ));
	$html .= '</td>';
	$html .= '<td>' . $bm->frmlabels['keyword'];
	$html .= '</td>';
	$html .= '<td>';
	$html .= '<input type="text" name="keywords" id="keywords" value="' .
			htmlentities($_REQUEST['keywords']) . '" title="'.$bm->frmhelp['keyword'].'" />';
	$html .= '</td>';
	$html .= '<td>' . $bm->frmlabels['tag'];
	$html .= '</td>';
	$html .= '<td>';
	$html .= '<input type="text" name="tag" id="tag" value="' .
			htmlentities($_REQUEST['tag']) . '" title="'.$bm->frmhelp['tag'].'" />';
	$html .= '</td>';
	$html .= '</tr>';

	$html .= '<tr>';
	$html .= '<td>' . $bm->frmlabels['postedfrom'];
	$html .= '</td>';
	$html .= '<td>';
	$html .= '<input type="text" name="iDate" id="iDate" value="' .
			htmlentities($_REQUEST['iDate']) . '" title="'.$bm->frmhelp['postedfrom'].'" />';
	$html .= '</td>';
	$html .= '<td>' . $bm->frmlabels['postedto'];
	$html .= '</td>';
	$html .= '<td>';
	$html .= '<input type="text" name="oDate" id="oDate" value="' .
			htmlentities($_REQUEST['oDate']) . '" title="'.$bm->frmhelp['postedto'].'" />';
	$html .= '</td>';
	$html .= '<td>' . $bm->frmlabels['submitquery'];
	$html .= '</td>';
	$html .= '<td><button type="submit" value="Verzend" >'.$bm->frmlabels['send'].'</button>';
	$html .= '</td>';
	$html .= '</tr>';

	$html .= '</table>';
	$html .= '</fieldset>';
	$html .= '</form>';
	$html .= '</div>';
	return $html;
}
function show_bm_actions(batchMove $bm){
	$html .= '<div id="actions" class="actions">';
	$html  = '<fieldset style="border:solid black 1px;padding:5px;">';
	$html .= '<table width="100%"><tr><td width="50%">';
	$html .= '<input type="hidden" name="page" value="batchadmin" />';
	$html .= $bm->frmlabels['category'] . ': ';
	$html .= wp_dropdown_categories('name=qcat&hide_empty=0&hierarchical=1&echo=0' );
	$html .= '<select name="act-cats" id="actions">';
	foreach ($bm->action as $key => $value) {
		//$selected = ( $_GET['actions'] == $key ) ? ' selected="selected"' : '';
		$html .=  '<option value="'.$key.'"'.$selected .'>'.$value.'&nbsp;</option>\n';
	}
	$html .= '</select>';
	$html .= '<button name="submit" type="submit" value="send-cat">'.$bm->frmlabels['send'].'</button>';
	$html .= '</td>';
	$html .= '<td>';
/*
	$html .= $bm->frmlabels['tag'].': ';
		$html .= '<input type="text" name="tags" id="tags" />';
	$html .= '<select name="act-tags" id="actions">';
	foreach ($bm->action as $key => $value) {
		//$selected = ( $_GET['actions'] == $key ) ? ' selected="selected"' : '';
		$html .=  '<option value="'.$key.'"'.$selected .'>'.$value.'&nbsp;</option>\n';
	}
	$html .= '</select>';
	$html .= '<button name="submit" type="submit" value="send-tag">'.$bm->frmlabels['send'].'</button>';
*/
	$html .= '</td>';
	$html .= '</tr></table>';
	$html .= '</fieldset>';
	$html .= '</div>';
	return $html;
}

function get_a_query(batchMove $bm){
	$qa = array( 'paged' => $bm->paged,
	 			 'posts_per_page' => $bm->per_page,
				 'orderby' => $bm->orderby,
				 'order' => $bm->order);
	// A category has been given; get posts that are in that category.
	/*
	$q  = 'paged=' . $bm->paged;
	$q .= '&posts_per_page=' . $bm->per_page;
	$q .= '&orderby=' . $bm->orderby;
	$q .= '&order=' . $bm->order;
	*/
	//$q .= '&post_type=' . $bm->post;
	$gets = $bm->get;
	$cat = (empty($gets['cat']))?$gets['qcat']:$gets['cat'];
	if ($cat) {
		$qa['cat'] = intval($cat);
	}
	// A keyword has been given; get posts whose content contains that keyword.
	if ( !empty($gets['keywords']) ) {
		//$q .= "&s=" . urlencode($gets['keywords']);
		$qa['s'] = urlencode($gets['keywords']);
	}

	// A tag has been given; get posts tagged with that tag.
	if ( !empty($gets['tag']) ) {
		$t = preg_replace('#[^a-z0-9\-\,\+]*#i', '', $gets['tag']);
		$qa['tag'] = $t;
		//$q .= "&t=$t";
	}

	return $qa;
}
function get_d_query(batchMove $bm){
	if (!empty($bm->get['iDate']) && empty($bm->get['oDate'])) {
		$fdate = $bm->get['iDate'];
		$q = '&paged=' . $bm->paged;
		$dt = split('-', $fdate);
		$q .= '&year=' . $dt[0];
		$q .= '&monthnum=' . $dt[1];
		$q .= '&day=' . $dt[2];
	} elseif ( !empty($bm->get['iDate']) && !empty($bm->get['oDate'])) {
		$q .= '&paged=' . $bm->paged;
		$q .= " AND post_date >= '2012-08-30' AND post_date < '2012-09-01'";
	}
}
function get_pagination(batchMove $bm, $maxpages=1){
	$pagination = '';
	if ( $maxpages > 1 ) {
		$current = preg_replace('/&?paged=[0-9]+/i', '', strip_tags($_SERVER['REQUEST_URI'])); // I'll happily take suggestions on a better way to do this, but it's 3am so

		$pagination .= "<div class='tablenav-pages nav-pages'>";

		if ( $bm->paged > 1 ) {
			$prev = $bm->paged - 1;
			$pagination .= '<a class="prev page-numbers" href="'.$current.'&amp;paged='.$prev.'">&laquo;'.$bm->pageing['prev'].'</a>';
		}

		for ( $i = 1; $i <= $maxpages; $i++ ) {
			if ( $i == $bm->paged ) {
				$pagination .= '<span class="page-numbers current">'.$i.'</span>';
			} else {
				$pagination .= '<a class="page-numbers" href="'.$current.'&amp;paged='.$i.'">'.$i.'</a>';
			}
		}

		if ( $bm->paged < $maxpages ) {
			$next = $bm->paged + 1;
			$pagination .= '<a class="next page-numbers" href="'.$current.'&amp;paged='.$next.'">'.$bm->pageing['next'].'&raquo;</a>';
		}

		$pagination .= "</div>";
		return $pagination;
	}
}
function get_information (batchMove $bm, $founded=0){
	$str  = $bm->information['lookedforpost'];
	$str .= '<strong>%s</strong>,';
	$str .= $bm->information['taggedwith'];
	$str .= '<strong>%s</strong>,';
	$str .= $bm->information['orderedby'];
	$str .= '<strong>%s</strong>,';
	$str .= $bm->information['posts'];
	$str .= '<strong>%s</strong>,';
	$str .= $bm->information['displayed'];
	$str .= '<strong>%s</strong> ';
	$str .= $bm->information['perpage'];
	$order = $bm->orderbydef[$bm->orderby];
	$str = sprintf($str,
					!empty($bm->cat)? $bm->cat : $bm->information['any'],
					!empty($bm->tag)? $bm->tag : $bm->information['none'],
					!empty($order)? $order : $bm->information['none'],
					!empty($founded)? $founded : $bm->information['none'],
					!empty($bm->per_page)? $bm->per_page : $bm->information['none']);
	return $str;


}

function get_results(batchMove $bm, $q_posts){													//action.php
	$html  = '<div id="posts">';

	$html .='<table class="widefat">
			<tr>
			<th class="t_left" scope="col"><input onclick="toggle_checkboxes()" type="checkbox" id="toggle" title="Select all posts" /></th>
			<th class="t_left" scope="col">ID</th>
			<th class="t_left" scope="col">' . $bm->ret_head['date'] . '</th>
			<th class="t_left" scope="col">' . $bm->ret_head['title'] . '</th>
			<th class="t_left" scope="col">' . $bm->ret_head['categories'] . '</th>
			<th class="t_left" scope="col">' . $bm->ret_head['tags'] . '</th>
			<th class="t_left" scope="col" colspan="2">' . $bm->ret_head['actions'] . '</th>
			</tr>';
	$html .= '<tbody>';
	foreach ( (array) $q_posts as $post ) {
//		$categories = get_categories('type=post&hide_empty=0');
		$categories = wp_get_post_categories($post->ID);
		$cats = '';
		$comma = false;
		foreach ( (array) $categories as $cat ) {
			//$cats .= '<a href="' . sprintf($bm->_url_page['category'], $cat) . '">' . get_cat_name($cat). '</a> ';
			$cats .= $comma ? ', ' : '';
			$cats .=  get_cat_name($cat);
			$comma = true;
		}


		$_tags = wp_get_post_tags($post->ID);
		$tags = '';
		foreach ( $_tags as $tag ) {
			$tags .= "<a href='?page=batch_categories&t=$tag->slug'>$tag->name</a>, ";
		}
		$tags = substr($tags, 0, strlen($tags) - 2);
		if ( empty ($tags) ) {
			$tags = 'No Tags';
		}

		$html .= '
				<tr' . ( $i++ % 2 == 0  ? ' class="alternate"' : '' ) .'>
					<td><input type="checkbox" name="ids[]" value="' . $post->ID . '" /></td>
					<td>' . $post->ID . '</td>
					<td>
		';

		if ( '0000-00-00 00:00:00' == $post->post_date ) {
			_e('Unpublished');
		} else {
			if ( ( time() - get_post_time() ) < 86400 ) {
				$html .= sprintf( __('%s ago'), human_time_diff( get_post_time() ) );
			} else {
				$html .= date(__('Y/m/d'), strtotime($post->post_date));
			}
		}

		$html .=  '</td>
					<td>' . $post->post_title . '</td>
					<td>' . $cats . '</td>
					<td>' . $tags . '</td>
					<td><a href="' . get_permalink($post->ID) . '" target="_blank">View</a></td>
					<td><a href="post.php?action=edit&post=' . $post->ID . '">Edit</a></td>
				</tr>
		';
	}
	$html .= '<tbody>';
	$html .= '</table>';
	$html .= '</div>';
	return $html;
}
function get_action(){
	$html  = '<div id="actions" class="tablenav">';
	$html .= '	<div class="action">
					<label for="cat">Category:</label>
					' . wp_dropdown_categories('name=qcat&hide_empty=0&hierarchical=1&echo=0') . '
					<input type="submit" name="add" value="Add to" title="Add the selected posts to this category." />
					<input type="submit" name="remove" value="Remove from" title="Remove the selected posts from this category." />
				</div>

				<div class="action">
					<label for="cat">Tags:</label>
					<input type="text" name="tags" title="Separate multiple tags with commas." />
					<input type="submit" name="replace_tags" value="Replace" title="Replace the selected posts\' current tags with these ones." />
					<input type="submit" name="tag" value="Add" title="Add these tags to the selected posts without altering the posts\' existing tags." />
					<input type="submit" name="untag" value="Remove" title="Remove these tags from the selected posts." />
				</div>

				' . $pagination . '
			</div>';

}
function date_greaterorless_then($date1, $date2){
	$statement = $where . 'postdate>=' . $date1 . ' OR ' . 'postdate<=' . $date2;
	return $statement;
}

function date_greater_then($date){
	$statement = 'postdate>=' . $date;
	return $statement;
}
function date_less_then($date){
	$statement = 'postdate<=' . $date;
	return $statement;
}
?>