<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
$ucret = $db->query("SELECT SUM(ucret) AS ucret FROM rezervasyonlar");
$kapora = $db->query("SELECT SUM(kapora) AS kapora FROM rezervasyonlar");
$alinanKaparo= $db->query("SELECT SUM(alinan_kapora) AS alinan_kapora FROM rezervasyonlar");
$kisisayisi=$db->query("SELECT SUM(kisi_sayisi) AS kisi_sayisi FROM rezervasyonlar");

// Sonucu al ve yazdır
$ucrettoplam = $ucret->fetch();
$kaporatoplam = $kapora->fetch();
$alinanKaparotoplam = $alinanKaparo->fetch();
$kisisayisitoplam = $kisisayisi->fetch();

?>
<div class="col-md-12 col-sm-12 col-xs-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Rezervasyon Listesi</h2><?php if ($_GET && $_GET['sil']) {
                echo '<h2 style="color:green;" >&nbsp;Successfully Deleted. </h2>';
            } ?>
            <?php if ($_GET && $_GET['ok']) {
                echo '<h2 style="color:green;" >&nbsp;Successfully updated.</h2>';
            } ?>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-3"><h4 style="color:black">Toplam Kişi:<?php echo $kisisayisitoplam['kisi_sayisi']?></h4></div>
                <div class="col-md-3"><h4 style="color:black">Toplam Ücret:<?php echo $ucrettoplam['ucret']?></h4></div>
                <div class="col-md-3"><h4 style="color:black">Toplam Kapora:<?php echo $kaporatoplam['kapora']?></h4></div>
                <div class="col-md-3"><h4 style="color:black">Toplam Alınan Kapora:<?php echo $alinanKaparotoplam['alinan_kapora']?></h4></div>

            </div>
        </div>

        <div class="x_content" style="overflow-x: scroll">
            <table id="datatable-responsive" class="table table-striped table-bordered   nowrap"
                   cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th >Ad Soyad</th>
                    <th class="tablecolumn">Telefon</th>
                    <th class="tablecolumn">Mail</th>
                    <th class="tablecolumn">Varış</th>
                    <th class="tablecolumn">Masa</th>
                    <th class="tablecolumn">Kişi Sayısı</th>
                    <th class="tablecolumn">Program</th>
                    <th class="tablecolumn">Menü</th>
                    <th class="tablecolumn">Not</th>
                    <th class="tablecolumn">Ücret</th>
                    <th class="tablecolumn">Kapora</th>
                    <th class="tablecolumn">Alınan Kapora</th>
                    <th class="tablecolumn">Onay Durumu</th>
                    <th class="tablecolumn">Düzenle</th>


                </tr>
                </thead>
                <tbody>
                <?php $rezervasyonlar = $db->prepare('select * from rezervasyonlar order by id desc ');
                $rezervasyonlar->execute();
                foreach ($rezervasyonlar as $rezervasyon) { ?>

                    <tr>
                    <td class="tablecolumn"><?php echo $rezervasyon['adsoyad']?></td>
                    <td class="tablecolumn"><?php echo $rezervasyon['telefon']?></td>
                    <td class="tablecolumn"><?php echo $rezervasyon['mail']?></td>
                    <td class="tablecolumn"><?php echo $rezervasyon['saat']?></td>
                    <td class="tablecolumn"><?php echo $rezervasyon['masa']?></td>
                    <td class="tablecolumn"><?php echo $rezervasyon['kisi_sayisi']?></td>
                    <td class="tablecolumn">
                    <?php
                        $etkinlik=$db->prepare('select * from etkinlikler where id=:id');
                        $etkinlik->execute(array('id'=>$rezervasyon['etkinlik_id']));
                        $etk=$etkinlik->fetch(PDO::FETCH_ASSOC);
                        echo $etk['baslik']??'';
                        ?>
                    </td>
                    <td class="tablecolumn">
                        <?php
                        $menuler=$db->prepare('select * from menuler where id=:id');
                        $menuler->execute(array('id'=>$rezervasyon['menu_id']));
                        $menu=$menuler->fetch(PDO::FETCH_ASSOC);
                        echo $menu['baslik']??'';
                        ?>
                    </td>
                    <td class="tablecolumn"><?php echo $rezervasyon['note']?></td>
                    <td class="tablecolumn"><?php echo $rezervasyon['ucret']?></td>
                    <td class="tablecolumn"><?php echo $rezervasyon['kapora']?></td>
                    <td class="tablecolumn">

                        <input id="alinan_kapora" data-id="<?php echo $rezervasyon['id']; ?>" type="number" value="<?php echo $rezervasyon['alinan_kapora']?>">
                    </td>
                    <td class="tablecolumn">
                        <select id="durum" data-id="<?php echo $rezervasyon['id']; ?>"  style="width: 100%;height:25px">
                            <option value="0" <?php echo $rezervasyon['durum']==0 ? 'selected' : ''; ?>>Pasif</option>
                            <option value="1" <?php echo $rezervasyon['durum']==1 ? 'selected' : ''; ?>>Aktif</option>
                        </select>


                    </td>

                       <td>
                    <a href="rezervasyon_duzenle.php?rezervasyon_id=<?php echo $rezervasyon['id']?>">
                    <button class="btn btn-success"type="submit" >Düzenle</button>
                    </a>
                    </td>
                  

                </tr>
               <?php }
                ?>
                <style>
                    iframe {
                        width: 250px !important;
                        height: 200px !important;
                    }
                </style>

                </tbody>
            </table>

        </div>
    </div>
</div>
<style>
    .tablecolumn{
        width: 200px!important;
        overflow: auto!important;
    }
</style>
<?php include 'footer.php'; ?>

<script>
    $(document).ready(function() {
        $('#alinan_kapora, #durum').change(function() {
            const id = $(this).data('id');
            const alinanKapora = $('#alinan_kapora').val();
            const durum = $('#durum').val();

            $.ajax({
                url: 'rezervasyonguncelle.php',
                type: 'POST',
                data: {
                    id: id,
                    alinan_kapora: alinanKapora,
                    durum: durum
                },
                success: function(response) {

                },
                error: function() {

                }
            });
        });
    });
</script>
