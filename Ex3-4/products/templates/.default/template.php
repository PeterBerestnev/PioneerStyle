<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<h2>Product table</h2>
<table style="width:100%; border:solid black 1px; background-color: rgba(255,0,0,0.7); border-collapse: collapse; margin-bottom: 20px">
    <tr >
        <th style="width:25%; font-size: medium; padding:5px;border:1px solid black"><strong>ID</strong></th>
        <th style="width:25%; font-size: medium; padding:5px;border:1px solid black"><strong>Название</strong></th>
    </tr>
    <?php foreach ($arResult["PRODUCTS"] as $product): ?>
        <tr style="background-color: rgba(255,255,255,0.5);">
            <td style="width:25%; padding:5px; border:1px solid black"><?= $product["ID"] ?></td>
            <td style="width:25%;padding:5px; border:1px solid black"><?= $product["NAME"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>