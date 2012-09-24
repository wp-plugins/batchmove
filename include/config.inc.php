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
$language = 'EN';
if ($language === 'NL') {
	define('BM_HEADER', 'Batch Post Category Verplaatsen/Verwijderen');
	define('BM_FILTER', 'Filter uw data');
	$application = 'Verplaats categorien';
	$formLabels =
		array(
			'rows' 			=> 'Regels',
			'sortby' 		=> 'Gesorteerd op',
			'desc' 			=> 'Op of aflopend',
			'category' 		=> 'Category',
			'keyword' 		=> 'Key-woord',
			'tag' 			=> 'Tag',
			'postedfrom'	=> 'Datum van',
			'postedto'		=> 'Datum tot',
			'criteria' 		=> 'Kies voor start gewenste filter criteria',
			'submitquery' 	=> 'Activeer filter',
			'send' 			=> 'Verzenden');
	$formHelp = array(
			'postedfrom'    => 'Datum formaat Jaar-Maand-Dag zoals 2010-08-30',
			'postedto'    	=> 'Datum formaat Jaar-Maand-Dag zoals 2010-08-30',
			'keyword'		=> 'Gebruik % als wildcards.',
			'tag'			=> '\'foo, bar\': posts tag is \'foo\' of \'bar\'. \'foo+bar\': posts tag met beiden \'foo\' en \'bar\'.'
			);
	$orderbysLng =
		array(
			'post_author' 	  => 'Autheur',
			'post_date' 	  => 'Datum bericht',
			'post_modified'   => 'Datum wijzeging',
			'post_title' 	  => 'Titel bericht',
			'post_status'	  => 'Status bericht');
	$orderLng =
		array(
			'asc'	=> 'Oplopend',
			'desc'	=> 'Aflopend');
	$pageing =
		array(
			'prev'  => 'Vorig',
			'next'  => 'Volgende');
	$information = array(
			'lookedforpost' => 'Gezocht in berichten ',
			'taggedwith' => 'met Tag ',
			'orderedby' => 'op volgorde ',
			'descendig' => 'op of aflopend ',
			'found' => 'gevonden in ',
			'posts' => 'berichten ',
			'displayed' => 'getoond ',
			'perpage' => 'per pagina ',
			'any' => 'allemaal',
			'none' => 'geen',
			'noright' => 'Voor deze handeling heeft U onvoldoende rechten ');
	$ret_head = array(
			'id' => 'ID',
			'date' => 'Datum',
			'title' => 'Titel',
			'categories' => 'Categorien',
			'tags' => 'Tags',
			'actions' => 'Acties');
	$actions = array(
			'action' => 'Aktie ',
			'add' => 'Toevoegen ',
			'upd' => 'Wijzigen ',
			'del' => 'Verwijderen ');
} elseif ($language === 'DE') {
	define('BM_HEADER', 'Stapel Nachrichten Kategorie Move / Entfernt');
	define('BM_FILTER', 'Filtern daten');
	$application = 'Kategorie verschieben';
	$formLabels =
		array(
			'rows' 			=> 'Zeilen',
			'sortby' 		=> 'Sortiert nach',
			'desc' 			=> 'Auf oder absteigend',
			'category' 		=> 'Kategorie',
			'keyword' 		=> 'Stichwort',
			'tag' 			=> 'Tag',
			'postedfrom'	=> 'Datum von',
			'postedto'		=> 'Datum auf',
			'criteria' 		=> 'Um loszulegen w&auml;hlen Sie einige Kriterien',
			'submitquery' 	=> 'Filter aktivieren',
			'send' 			=> 'Senden');
	$formHelp = array(
			'postedfrom'    => 'Datumsformat Jahr-Monat-Tag wie 2010-08-30',
			'postedto'    	=> 'Datumsformat Jahr-Monat-Tag wie 2010-08-30',
			'keyword'		=> 'Verwenden Sie% für Wildcards.',
			'tag'			=> '\'foo, bar\': Beitr&auml;ge getaggt mit \'foo\' or \'bar\'. \'foo+bar\': Beitr&auml;ge sowohl getaggt \'foo\' and \'bar\'.'
			);
	$orderbysLng = array(
			'post_author'	=> 'Autor',
			'post_date'		=> 'Datum der Ver&ouml;ffentlichung',
			'post_modified'	=> '&#195;nderungsdatum',
			'post_title'	=> 'Titel',
			'post_status'	=> 'Status');
	$orderLng =
		array(
			'asc'	=> 'Aufsteigend',
			'desc'  => 'Absteigend');
	$pageing =
		array(
			'prev'  => 'Fr&uuml;her',
			'next'  => 'N&auml;chste');
	$information = array(
			'lookedforpost' => 'Sah f&uuml;r Stellen in,',
			'taggedwith' => 'mit Tag ',
			'orderedby' => 'sortiert nach ',
			'descendig' => 'Asc oder Desc ',
			'found' => 'gefunden in ',
			'posts' => 'Beitr&auml;ge ',
			'displayed' => 'angezeigt ',
			'perpage' => 'pro Seite ',
			'any' => 'allemaal',
			'none' => 'geen',
			'noright' => 'F&uuml;r diesen Vorgang m&uuml;ssen Sie ausreichende Rechte haben ');
	$ret_head = array(
			'id' => 'ID',
			'date' => 'Datum',
			'title' => 'Titel',
			'categories' => 'Kategorien',
			'tags' => 'Tags',
			'actions' => 'Aktionen');
	$actions = array(
			'action' => 'Aktion ',
			'add' => 'Hinzuf&uuml;gen',
			'upd' => 'Aktualisieren',
			'del' => 'L&ouml;schen');
} else {
	define('BM_HEADER', __('Batch Post Category Move/Removed'));
	define('BM_FILTER', 'Filter data');
	$application = 'Move categories';
	$formLabels =
		array(
			'rows' 			=> 'Rows',
			'sortby' 		=> 'Sorted by',
			'desc' 			=> 'Asc or Desc',
			'category' 		=> 'Catogory',
			'keyword' 		=> 'Keyword',
			'tag' 			=> 'Tag',
			'postedfrom'	=> 'Date from',
			'postedto'		=> 'Datum to',
			'criteria' 		=> 'To get started select some criteria',
			'submitquery' 	=> 'Activate filter',
			'send' 			=> 'Send');
	$formHelp = array(
			'postedfrom'    => 'Date format YEAR-MONTH-DAY like 2010-08-30',
			'postedto'    	=> 'Date format YEAR-MONTH-DAY like 2010-08-30',
			'keyword'		=> 'Use % for wildcards.',
			'tag'			=> '\'foo, bar\': posts tagged with \'foo\' or \'bar\'. \'foo+bar\': posts tagged with both \'foo\' and \'bar\'.'
			);
	$orderbysLng = array(
			'post_author'	=> 'Author',
			'post_date'		=> 'Date Posted',
			'post_modified'	=> 'Date Modified',
			'post_title'	=> 'Title',
			'post_status'	=> 'Status');
	$orderLng =
		array(
			'asc'	=> 'Ascending',
			'desc'  => 'Descending');
	$pageing =
		array(
			'prev'  => 'Previous',
			'next'  => 'Next');
	$information = array(
			'lookedforpost' => 'Looked for posts in,',
			'taggedwith' => 'with Tag ',
			'orderedby' => 'ordered by ',
			'descendig' => 'Asc or Desc ',
			'found' => 'found in ',
			'posts' => 'posts ',
			'displayed' => 'displayed ',
			'perpage' => 'per page ',
			'any' => 'all ',
			'none' => 'none ',
			'noright' => 'For this operation, you have insufficient rights ');

	$ret_head = array(
			'id' => 'ID',
			'date' => 'Date',
			'title' => 'Title',
			'categories' => 'Categories',
			'tags' => 'Tags',
			'actions' => 'Actions');
	$actions = array(
			'action' => 'Aktion ',
			'add' => 'Add',
			'upd' => 'Update',
			'del' => 'Delete');
}
?>