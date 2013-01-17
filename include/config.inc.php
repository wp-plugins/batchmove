<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 *
 * Language set
 */
//$language = ($language=="")?trim(get_bloginfo('language')): 'nl-NL';//empty will always select Englisch
/**
 * get_bloginfo('language') not always get the right language
 *
 */
define('BM_HEADER', __('Batch Post Category Move/Removed', 'batch-move'));
define('BM_FILTER', __('Filter data', 'batch-move'));
define('USERLEVEL', 'level_7');
$application = __('Move categories', 'batch-move');
$formLabels =
	array(
		'rows' 			=> __('Rows', 'batch-move'),
		'sortby' 		=> __('Sorted by', 'batch-move'),
		'desc' 			=> __('Asc or Desc', 'batch-move'),
		'category' 		=> __('Catogory', 'batch-move'),
		'keyword' 		=> __('Keyword', 'batch-move'),
		'tag' 			=> __('Tag', 'batch-move'),
		'postedfrom'	=> __('Date from', 'batch-move'),
		'postedto'		=> __('Datum to', 'batch-move'),
		'criteria' 		=> __('To get started select some criteria', 'batch-move'),
		'submitquery' 	=> __('Activate filter', 'batch-move'),
		'send' 			=> __('Send', 'batch-move'));
$formHelp = array(
		'postedfrom'    => __('Date format YEAR-MONTH-DAY like 2010-08-30', 'batch-move'),
		'postedto'    	=> __('Date format YEAR-MONTH-DAY like 2010-08-30', 'batch-move'),
		'keyword'		=> __('Use % for wildcards.'),
		'tag'			=> __('\'foo, bar\': posts tagged with \'foo\' or \'bar\'. \'foo+bar\': posts tagged with both \'foo\' and \'bar\'.', 'batch-move'));
$orderbysLng = array(
		'date'			=> __('Date Posted', 'batch-move'),
		'modified'		=> __('Date Modified', 'batch-move'),
		'author'		=> __('Author', 'batch-move'),
		'title'			=> __('Title', 'batch-move'),
		'status'		=> __('Status', 'batch-move'));
$orderLng =
	array(
		'asc'			=> __('Ascending', 'batch-move'),
		'desc'  		=> __('Descending', 'batch-move'));
$pageing =
	array(
		'prev'  		=> __('Previous', 'batch-move'),
		'next'  		=> __('Next', 'batch-move'));
$information = array(
		'lookedforpost' => __('Looked for posts in,', 'batch-move'),
		'taggedwith' 	=> __('with Tag ', 'batch-move'),
		'orderedby' 	=> __('ordered by ', 'batch-move'),
		'descendig' 	=> __('Asc or Desc ', 'batch-move'),
		'found' 		=> __('found in ', 'batch-move'),
		'posts' 		=> __('posts ', 'batch-move'),
		'displayed' 	=> __('displayed ', 'batch-move'),
		'perpage' 		=> __('per page ', 'batch-move'),
		'any' 			=> __('all ', 'batch-move'),
		'none' 			=> __('none ', 'batch-move'),
		'noright' 		=> __('For this operation, you have insufficient rights ', 'batch-move'));

$ret_head = array(
		'id' 			=> __('ID', 'batch-move'),
		'date' 			=> __('Date', 'batch-move'),
		'title' 		=> __('Title', 'batch-move'),
		'categories' 	=> __('Categories', 'batch-move'),
		'tags' 			=> __('Tags', 'batch-move'),
		'actions' 		=> __('Actions', 'batch-move'));
$actions = array(
		'action' 		=> __('Aktion ', 'batch-move'),
		'add' 			=> __('Add', 'batch-move'),
		'upd' 			=> __('Update', 'batch-move'),
		'del' 			=> __('Delete', 'batch-move'));

?>