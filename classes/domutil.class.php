<?php

class DOMUtil {

  public static function loadHTMLFile($fileName) {
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTMLFile($fileName);
    return $doc;
  }

  public static function xpathQuery($query,$node=null) {
    if ($node == null) {
  		$doc = Moriarti::get('view');
  	} else {
      $doc = $node->ownerDocument;
    }
  	$xpath = new DOMXPath($doc);
  	return $xpath->query($query,$node);
  }

  public static function findElementsByClassName($className,$doc=null) {
    return self::xpathQuery("//*[contains(concat(' ', normalize-space(@class), ' '), '$className')]");
  }

  public static function parseHTML($fragment) {
  	$hdoc = new DOMDocument();
  	$hdoc->loadHTML($fragment);
  	return $hdoc;
  }

  public static function importDOM($targetNode,$documentToImport) {
  	$xpath = new DOMXPath($documentToImport);
  	$nodes = $xpath->query("/*");
  	foreach($nodes as $nodeToImport) {
  		$nodeToImport = $targetNode->ownerDocument->importNode($nodeToImport,true);
  		$targetNode->appendChild($nodeToImport);
  	}

  }
}

?>
