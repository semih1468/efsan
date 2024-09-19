<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>ozellik Listesi</h2><?php if ($_GET&&$_GET['sil']) {
                echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';
            } ?>
            <?php if ($_GET&&$_GET['ok']) {
                echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';
            } ?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                   cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Özellik Başlık</th>
                    <th>Özellik İçerik</th>
                    <th>Özellik Sıra</th>
                    <th>Özellik Resim</th>
                    <th>Sil</th>
                    <th>Düzenle</th>



                </tr>
                </thead>
                <tbody>
                <?php $ozellikcek = $db->query('select * from ozellik', PDO::FETCH_ASSOC);
                foreach ($ozellikcek as $ozellik) {
                    echo '
                    <tr>
                 <td>'.$ozellik['ozellik_baslik'].'</td>
                 <td><div style="width: 300px;overflow: hidden">'.strip_tags($ozellik['ozellik_icerik']).'</div></td>
                 <td>'.$ozellik['ozellik_sira'].'</td>
                 <td><img src="../../upload/ozellik/'.$ozellik['ozellik_resim'].'"  class="img-fluid" alt=""></td>
                    <td>
                    <a href="islem/islem.php?ozellik_sil=ok&ozellik_id=' . $ozellik['ozellik_id'] . '&ozellik_resim=' . $ozellik['ozellik_resim'] . '">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td> 
                    <td>
                    <a href="ozellik_duzenle.php?ozellik_id=' . $ozellik['ozellik_id'] . '">
                    <button class="btn btn-success" type="submit" >Düzenle</button>
                    </a>
                    </td> 
                     
                </tr> ';
                }
                ?>


                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
