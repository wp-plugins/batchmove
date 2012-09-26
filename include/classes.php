<?php
//include BATCH_PLUGIN_DIR . '/include/config.inc.php';
/**
 *
 * @version $Id$
 * @copyright 2012
 */
class bag {
    /**
     * Author developer
     * Date created 24-2-2010
     *
     * Constructor
     *
     * @access protected
     */

    /**
     * bag::__CONSTRUCT()
     *
     * @return
     */
    public function __CONSTRUCT()
    {
    }
    /**
     * Destructor
     *
     * @access protected
     */
    /**
     * bag::__DESTRUCT()
     *
     * @return
     */
    public function __DESTRUCT()
    {
    }

    /**
     * bag::__get()
     *
     * @param mixed $var
     * @return
     */
    public function __get($var)
    {
        return $this->$var;
    }

    /**
     * bag::__set()
     *
     * @param mixed $var
     * @param mixed $val
     * @return
     */
    public function __set($var, $val)
    {
        $this->$var = $val;
    }
    /**
     * bag::clear()
     *
     * @return
     */
    public function clear()
    {
        foreach ($this as $key) {
            // dont loose some methods, like __set and __get
            if (!method_exists($this->$key)) unset($this->$key);
        }
    }
    /**
     * bag::__call()
     *
     * @param mixed $var
     * @param mixed $val
     * @return
     */
    public function __call($var, $val = null)
    {
        switch ($var) {
            case "":
                break;
            case "":
                break;
            default: ;
        } // switch
        return $value;
    }
}
/**
 *
 *
 */
class batchMove extends bag {
	public  $_url_page=array(), $per_page;
	public  $cat, $keyword, $tag, $idate, $odate,
			$get,$order, $orderdef, $orderby, $orderbydef=array(),
			$orderflip, $num, $what, $done=array(), $paged,
			$frmlabels=array(), $frmhelp=array(),$pageing=array(),
			$information=array(),$ret_head=array();
	private $request, $data=array(), $filter, $actions=array();
	public function __CONSTRUCT(){
		if ($_POST) {
			foreach ($_POST as $value) {
				$value = filter_var($value, FILTER_SANITIZE_STRING,!FILTER_FLAG_STRIP_LOW);//no shit
			}
			$this->get = stripslashes_deep($_POST);
		} elseif ($_GET) {
			foreach ($_GET as $value) {
				$value = filter_var($value, FILTER_SANITIZE_STRING,!FILTER_FLAG_STRIP_LOW );//no shit
			}
			$this->get = stripslashes_deep($_GET);//edit.php?page=batch_categories&cat=%s
		}
		if ($_GET || $_POST) {
			$this->_url_page['admin'] = 'edit?page=batchadmin';
			$this->_url_page['category'] = 'edit?page=batchadmin&cat=%s';
			$this->_url_page['keyword'] = 'edit?page=batchadmin&s=%s';
			$this->_url_page['tag'] = 'edit?page=batchadmin&t=%s';

 			$cat = (empty($this->get['qcat']))
			 ?get_cat_name(intval($this->get['cat']))
			 :get_cat_name(intval($this->get['qcat']));

			$this->cat = empty($cat) ? '' : $cat;
			$this->keyword = empty($this->get['keyword']) ? '' : $this->keyword;
			$this->tag = empty($this->get['tag']) ? '' : $this->tag;
			$this->per_page = empty($this->get['row_amount']) ? 15 : intval($this->get['row_amount']);
			$this->orderby = empty($this->get['orderby']) ? 'post_date' : $this->get['orderby'];
			$this->order = empty($this->get['order']) ? 'desc' : $this->get['order'];
			$this->paged = empty($this->get['paged']) ? 1 : intval($this->get['paged']);
		}

	}
	public function __DESTRUCT(){
	}
	public function mess_done($done, $num, $what) {
		switch ($done) {
			case 'add':
				$this->message = "Added %1$s posts to the category &ldquo;%2$s&rdquo;.";;
				break;
			case 'remove':
				$this->message = "Removed %1$s posts from the category &ldquo;%2$s&rdquo;.";
				break;
			case 'replace':
				$this->message = "Replaced %1$s posts from the category &ldquo;%2$s&rdquo;.";
				break;
			case 'tag':
				$this->message = "Tagged %1$s posts with &ldquo;%2$s&rdquo;.";
				break;
			case 'untag':
				$this->message  = "Untagged %1$s posts with &ldquo;%2$s&rdquo;.";
				break;
			default:
				;
		} // switch
		return $mess_str =	sprintf($this->message, $num, $what);
	}
}

?>