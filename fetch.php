<?php
include("includes/config.php");
$config = new Config();
$db = $config->getConnection();
include_once('includes/skor.inc.php');
include_once('includes/alternatif.inc.php');
include_once('includes/kriteria.inc.php');
include_once('includes/nilai.inc.php');

$altObj = new Alternatif($db);
$skoObj = new Skor($db);
$kriObj = new Kriteria($db);
$nilObj = new Nilai($db);

$altCount = $altObj->countByFilter();

$no = 1;
$r = [];
$nid = [];
$alt1 = $altObj->readByFilter();
while ($row = $alt1->fetch(PDO::FETCH_ASSOC)) {
    $alt2 = $altObj->readByFilter();
    while ($roww = $alt2->fetch(PDO::FETCH_ASSOC)) {
        $nid[$row['id_alternatif']][] = $roww['id_alternatif'];
    }
    $total = $altCount - $no;
    if ($total >= 1) {
        $r[$row['id_alternatif']] = $total;
    }
    $no++;
}

$ni = 1;
foreach ($nid as $key => $value) {
    array_splice($nid[$key], 0, $ni++);
}
$ne = count($nid) - 1;
array_splice($nid, $ne, 1);

?>

<?php $no = 1;
                        foreach ($r as $k => $v) : ?>
<?php $j = 0;
                            for ($i = 1; $i <= $v; $i++) : ?>
<?php $rows = $altObj->readSatu($k);
                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
<div class="row">
    <div class="col-xs-12 col-md-3">
        <div class="form-group">
            <?php $rows = $skoObj->readAlternatif($k);?>
            <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
            <input type="text" class="form-control" value="<?= $row['nama'] . ' - ' . $row['nilai'] ?>" readonly />
            <input type="hidden" name="<?= $k ?><?= $no ?>" value="<?= $row['id_alternatif'] ?>" />
            <?php endwhile; ?>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <select class="form-control" name="nl<?= $no ?>">
                <?php $stmt1 = $nilObj->readAll();
                                                    while ($row2 = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>
                <option value="<?= $row2['jum_nilai'] ?>"><?= $row2['jum_nilai'] ?> -
                    <?= $row2['ket_nilai'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="form-group">
            <?php $rows = $skoObj->readAlternatif($nid[$k][$j]);
                                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
            <input type="text" class="form-control" value="<?= $row['nama'] . ' - ' . $row['nilai'] ?>" readonly />
            <input type="hidden" name="<?= $nid[$k][$j] ?><?= $no ?>" value="<?= $row['id_alternatif'] ?>" />
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php endwhile;
                                $no++;
                                $j++; ?>
<?php endfor; ?>
<?php endforeach; ?>