<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<form action="pertandingan/input" method="post">
    <div class="container">
        <div class="row">
            <h3 class="text-center"><?php echo $title ?></h3>
            <button type="button" class="btn btn-add" id="addMatch">Add</button>
        </div>

        <div class="col" id="formMatches">
            <div class="match">
                <div class="row">
                    <select class="form-control" name="klub1[]" required>
                        <option value="" selected disabled>Pilih Klub</option>
                        <?php foreach ($klub as $baris) : ?>
                            <option value="<?php echo $baris->id; ?>"><?php echo $baris->nm_klub; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>VS</label>
                    <select class="form-control" name="klub2[]" required>
                        <option value="" selected disabled>Pilih Klub</option>
                        <?php foreach ($klub as $baris) : ?>
                            <option value="<?php echo $baris->id; ?>"><?php echo $baris->nm_klub; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>-</label>
                    <input type="number" class="form-control" name="score1[]" placeholder="Score" min="0" required>
                    <label>-</label>
                    <input type="number" class="form-control" name="score2[]" placeholder="Score" min="0" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#addMatch").on("click", function() {
            var newMatch = $(".match:last").clone();
            newMatch.find("input[type='number']").val("");
            $("#formMatches").append(newMatch);
        });
    });
</script>