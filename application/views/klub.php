<div class="container">
    <div class="row">
        <h3><?php echo $title ?></h3>
        <a href="klub/input" class="btn btn-input">Tambah</a>
    </div>
    <hr />
    <table border="1" width=100% style="text-align: center;">
        <tr>
            <th width=5%>No</th>
            <th>Nama Klub</th>
            <th>Kota</th>
        </tr>
        <?php
        $no = 1;
        foreach ($klub as $baris) {
        ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $baris->nm_klub ?></td>
                <td><?php echo $baris->kota ?></td>
            </tr>
        <?php
            $no++;
        } ?>
    </table>

</div>