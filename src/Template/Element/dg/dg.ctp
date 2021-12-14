<?php $arrElts = ["pageSize" => isset($pageSize) ? $pageSize : "1000"]; ?>
<?= $this->element($pathDg . $typeDg, $arrElts); ?>
<?php //dd($typeDg, $arrCol);      ?>
<thead>
    <tr>
        <?php
        foreach ($arrCol as $k => $v) {
            echo $this->element($pathDg . $dgCol, ["k" => $k, "v" => $v]);
        }
        ?>
    </tr>
</thead>
</table>
