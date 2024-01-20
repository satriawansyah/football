<div class="container">
    <div class="row">
        <h3><?php echo $title ?></h3>
        <a href="pertandingan/input" class="btn btn-input">Tambah</a>
    </div>
    <hr />
    <table border="1" width=100% style="text-align: center;">
        <tr>
            <th width=5%>No</th>
            <th>Pertandingan</th>
            <th>Skor</th>
        </tr>
        <?php
        $no = 1;
        foreach ($pertandingan as $baris) {
        ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $baris->klub1 ?> VS <?php echo $baris->klub2 ?></td>
                <td><?php echo $baris->score1 ?> - <?php echo $baris->score2 ?></td>
            </tr>
        <?php
            $no++;
        } ?>
    </table>

</div>