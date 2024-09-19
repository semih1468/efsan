<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Program Özellikler Sayfa Listesi</h2><?php if ($_GET&&$_GET['sil']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';}?>
            <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Program Özellikler Başlık</th>
                    <th>Program Özellikler İçerik</th>
                    <th>Program Özellikler Sıra</th>
                    <th>Program Özellikler Boyut</th>
                    <th>Sil</th>
                    <th>Düzenle</th>

                </tr>
                </thead>
                <tbody>
                <?php $program_ozellikcek=$db->query('select * from ozellikler',PDO::FETCH_ASSOC);
                foreach ($program_ozellikcek as $program_ozellik){echo'
                    <tr>
                    <td><p>'.substr($program_ozellik['ozellik_baslik'],0,50).'</p></td>
                    <td ><div style="width: 200px;height:50px;overflow: hidden;">'.strip_tags($program_ozellik['ozellik_icerik']).'</div></td>
                    <td><p>'.substr(strip_tags($program_ozellik['sira']),0,100).'</p></td>
                    <td><p>'.substr(strip_tags($program_ozellik['ozellik_boyut']),0,100).'</p></td>
                    <td>
                    <a href="islem/islem.php?program_ozellik_sil=ok&ozellik_id='.$program_ozellik['ozellik_id'].'">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                    <td>
                    <a href="programozellik_duzenle.php?program_ozellik_id='.$program_ozellik['ozellik_id'].'">
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

<?php include 'footer.php';?>
