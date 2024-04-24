<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Permintaan</title>
    <!-- Tambahkan CSS dan tag style jika diperlukan -->
</head>

<body>
    <h5>Laporan Permintaan Barang</h5>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_konfperm as $row => $value) : ?>
                <?php $nama_barang = $this->M_permintaan->nama_barang($value->kode_perm); ?>

                <?php foreach ($nama_barang as  $barang) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $barang->nama_barang; ?></td>
                        <td><?= $barang->jumlah_perm; ?></td>
                        <td><?= $barang->sub_total; ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Tambahkan tombol cetak jika diperlukan -->
    <button onclick="window.print()">Cetak Laporan</button>
</body>

</html>