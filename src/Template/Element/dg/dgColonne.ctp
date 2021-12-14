<?php

use Cake\Utility\Inflector;

/**
 * Prise en compte de la syntaxe "plugin", à séparateur point.
 */
$format = '';
$needle = ".";
if (strpos($k, $needle) !== false) {
    $elts = explode($needle, $k);
    $format = ',formatter:formatter';
    $format .= ucfirst(mb_strtolower($elts[0]));
    $format .= Inflector::camelize(mb_strtolower($elts[1]));
}
$ck = ("ck" === $k) ? ",checkbox:true" : "";
$col = "<th data-options=" . "field:'$k'$ck$format,sortable:true" . ">$v</th>";
?>
<?= $col ?>

