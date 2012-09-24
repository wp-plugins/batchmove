<?php

/**
 * CopyRight � ADE-Access
 * Author C. Stoltenkamp
 *
 * @user cees
 * @copyright � XXL_Dynamics 2011

 *

 $autho->check_level_count(true); check all group, application and system values
 $autho->set_ids(true); //set or reset all Ids

 repair all Id's
 $autho->set_ids(true);

 Delete all nodes with the name, ID
 $autho->deleteAllNode("id", $autho->levels);

 Beautiful function, but I have to rebuild yet a lot!

 $autho->insert_autho_level(array("name"=>"Ceessie",
 "value"=>"57",
 "position"=>"2",
 "desc"=>"Baas",
 "insideMode"=>"inside"));

 Super simpleXML MoveNode function works fine!!!

 $autho->move_autho_level_id(array("parent_id"=>170,"child_id"=>38,"insideMode"=>"inside"));

 */

class SimpleXMLExtend {
	public function addCData($nodename, $cdata_text) {
		$node = $this->addChild($nodename); //Added a nodename to create inside the function
		$node = dom_import_simplexml($node);
		$no = $node->ownerDocument;
		$node->appendChild($no->createCDATASection($cdata_text));
	}
	public function removeNodeByAttrib($nodename, $attribute, $value) {
		foreach ($this->xpath($nodename) as $key => $node) {
			foreach($node->attributes() as $attrib => $val) {
				if ($attrib == $attribute && $val == $value) {
					$oNode = dom_import_simplexml($node);
				}
			}
		}
		$oNode->parentNode->removeChild($oNode);
	}

	public function setParentIds ($xml, $parent_id=null) {
		//$xml->parent = $parent_id;
		foreach ($xml->menuitem as $node){
			if ((string)$node->position=="child") {
				$node->parent = $parent_id;
			} elseif ((string)$node->position=="prev"&&isset($node['id'])) {
				$prev_node->parent = $node['id'];
			} elseif ((string)$node->position=="after"&&isset($prev_node['id'])) {
				$node->parent = $prev_node['id'];
			} else {
				$node->parent = $parent_id;
			}
			if ($node->menuitem) {
				SimpleXMLExtend::setParentIds($node, (string)$node['id']);
			}
			$prev_node = $node;
		}
	}
	public function resetPostions ($xml) {
		/**
		 * I use attributes because you can access them direct from node
		 *
		 * like $node['attrib'] and, it is on the right level
		 *
		 * $node->index is a child that holds a value for his parent
		 *
		 */

		foreach ($xml->children() as $node){
			foreach ($xml->menuitem as $node){
				if ($node->position)
					switch((string)$node->position){
						case 'Na dit item':
							$node->position = 'after';
							break;
							;
							break;
						case 'Voor dit item' :
							$node->position = 'prev';
							break;
						case 'Volgend op dit item' :
							$node->position = 'child';
							break;
						default:
						;
					} // switch
				if ($node->menuitem) {
					SimpleXMLExtend::resetPostions($node);
				}
			}
		}
	}
	public function setMenuIds ($xml, $parent_id=null) {
		static $idNo;
		foreach ($xml->menuitem as $node){
			$idNo++;
			(isset($node["id"]))?
				$node["id"]=$idNo:
				$node->addAttribute("id", $idNo);
			if ($node->menuitem) {
				SimpleXMLExtend::setMenuIds($node);
			}
		}
	}
	static function delIds ($xml) {
		/**
		 * I use attributes because you can access them direct from node
		 *
		 * like $node['attrib'] and, it is on the right level
		 *
		 * $node->index is a child that holds a value for his parent
		 *
		 */

		foreach ($xml->children() as $node){
			unset($node['id']);
			if ($node->Children()) {
				SimpleXMLExtend::delIds($node);
			}
		}
	}

	static function setIds ($xml) {
		/**
		 * I use attributes because you can access them direct from node
		 *
		 * like $node['attrib'] and, it is on the right level
		 *
		 * $node->index is a child that holds a value for his parent
		 *
		 */

		static $idNo;
		foreach ($xml->children() as $node){
			$idNo++;
			if ($node->getName()!="idMax") {
				(isset($node["id"]))?
					$node["id"]=$idNo:
					$node->addAttribute("id", $idNo);
			}
			if ($node->Children()) {
				SimpleXMLExtend::setIds($node);
			}
		}
		return $idNo;
	}
	static function delete_aAttrib($xml, $name=null, $id=null) {
		if ($xml['id'] && ($xml['id']== $id)) {
			$node = $xml;
			//make a dom node
			$oNode = dom_import_simplexml($node);
			//remove ny parent that node
			$oNode->removeAttribute($name);
		} else {
			foreach ($xml->children() as $node){
				$nodename = $node->getName();
				if ($node[$name]) {
					//make a dom node
					$oNode = dom_import_simplexml($node);
					//remove ny parent that node
					$oNode->removeAttribute($name);
				} elseif ($node->Children()) {
					SimpleXMLExtend::delete_aAttrib($node, $name, $id);
				}
			}
		}
	}

	public function delete_aNode($xml, $name=null, $id=null) {
		if ($xml['id'] == $id) {
			$node = $xml;
			//make a dom node
			$oNode = dom_import_simplexml($node);
			//remove ny parent that node
			$oNode->parentNode->removeChild($oNode);
		} else {
			foreach ($xml->children() as $node){
				$nodename = $node->getName();
				if (($node->getName()===$name)||(($node["id"]!==null)&&($node["id"]===$id))) {
					//make a dom node
					$oNode = dom_import_simplexml($node);
					//remove ny parent that node
					$oNode->parentNode->removeChild($oNode);
				} elseif ($node->Children()) {
					SimpleXMLExtend::delete_aNode($node, $name, $id);
				}
			}
		}
	}
	private function getNodefunc ($xml, $name=null, $id=null, $empty=false) {
		static $found;
		if ($empty) $found = null;
		if (!isset($found)) {
			if ($xml->children())
				foreach ($xml->children() as $node){
					if (!isset($found)) {
						if (strlen($name)) {
							$nodename = $node->getName();
							if (($node->getName()==$name)&&isset($node->value)) {
								$found = $node;
							} elseif ($node->Children()) {
								SimpleXMLExtend::getNodefunc($node, $name);
							}
						} elseif (isset($id)) {
							if ($node["id"]==$id) {
								$found = $node;
							} elseif ($node->Children()) {
								SimpleXMLExtend::getNodefunc($node,"",$id);
							}
						}
					}
				}
			if (isset($found)) {
				return $found;
			}
		}
	}
	public function getNode ($xml, $name) {
		return SimpleXMLExtend::getNodefunc($xml, $name, "",true);
	}
	public function getIdNode ($xml, $id) {
		return SimpleXMLExtend::getNodefunc($xml, "", $id, true);
	}
	public function getaNode ($name, $xml) {
		static $found;
		if (!isset($found)) {
			foreach ($xml->children() as $node){
				if (!isset($found)) {
					$nodename = $node->getName();
					if ($node->getName()==$name) {
						$found = $node;
					} elseif ($node->Children()) {
						SimpleXMLExtend::getaNode($name, $node);
					}
				}
			}
			return $found;
		}
	}

	public function moveNode($parentNode, $childNode, $insideMode = null) {
		//make some DOM
		$parent = dom_import_simplexml($parentNode);
		//child can have childs
		$child  = dom_import_simplexml($childNode);
		$saveChild = $child;
		//first delete current childNode
		//$child->parentNode->removeChild($child);
		//witch insideMode is used
		if($insideMode == "inside") {
			//insert ChildNode
			$child = $parent->appendChild($saveChild);

		} else if($insideMode == "before") {
			//insert before actual Node
			$child = $parent->parentNode->insertBefore($saveChild, $parent);

		} else if(!$insideMode || $insideMode == "after") {
			//insert after actual node
			if($parent->nextSibling) {
				$child = $parent->parentNode->insertBefore($saveChild, $parent->nextSibling);
			} else {
				$child = $parent->parentNode->appendChild($saveChild);
			}

		}
		//return some simpelXML
		return simplexml_import_dom($child);
	}
	public function insertNode($node, $name, $insideMode = null) {
		//make some DOM
		$parent = dom_import_simplexml($node);
		//create a Node
		$newNode = $parent->ownerDocument->createElement($name);
		//witch insideMode is used
		if($insideMode == "inside") {
			//insert ChildNode
			$newNode = $parent->appendChild($newNode);

		} else if($insideMode == "before") {
			//insert before actual Node
			$newNode = $parent->parentNode->insertBefore($newNode, $sd);

		} else if(!$insideMode || $insideMode == "after") {
			//insert after actual node
			if($parent->nextSibling) {
				$newNode = $parent->parentNode->insertBefore($newNode, $parent->nextSibling);
			} else {
				$newNode = $parent->parentNode->appendChild($newNode);
			}

		}
		//return some simpelXML
		return simplexml_import_dom($newNode);
	}
}
?>