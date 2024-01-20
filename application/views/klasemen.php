<div class="container">
    <div class="row">
        <h3><?php echo $title ?></h3>
    </div>
    <hr />
    <table border="1" width=100% style="text-align: center;">
        <tr>
            <th width=5%>No</th>
            <th>Klub</th>
            <th>Main</th>
            <th>Menang</th>
            <th>Seri</th>
            <th>Kalah</th>
            <th>GM</th>
            <th>GK</th>
            <th>Point</th>
        </tr>
        <?php
        $no = 1;
        foreach ($klasemen as $baris) {
        ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $baris->klub ?></td>
                <td><?php echo $baris->main ?></td>
                <td><?php echo $baris->menang ?></td>
                <td><?php echo $baris->seri ?></td>
                <td><?php echo $baris->kalah ?></td>
                <td><?php echo $baris->GM ?></td>
                <td><?php echo $baris->GK ?></td>
                <td><?php echo $baris->point ?></td>
            </tr>
        <?php
            $no++;
        } ?>
    </table>

</div>