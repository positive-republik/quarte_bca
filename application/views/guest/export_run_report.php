<?php 
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=report_".date('d-M-y').".xls"); 
?>
<html>
    <body>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Priode</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
            <?php $i=1; foreach($data as $key) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= date('M',mktime(0, 0, 0, $key['month'], 12)) ?> <?= substr($key['created_at'],0,4) ?></td>
                <td><?= $key['produk'] ?></td>
                <td><?= $key['kategori'] ?></td>
                <td><?= $key['cnt'] ?></td>
            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </body>
</html>