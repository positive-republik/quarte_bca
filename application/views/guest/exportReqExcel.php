<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=nama_filenya.xls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Kategori</th>
        </tr>
        <?php $i=1; foreach($export_data->result_array() as $key) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $key['produk'] ?></td>
            <td><?= $key['kategori'] ?></td>
        </tr>
        <?php $i++; endforeach; ?>
    </table>
</body>
</html>