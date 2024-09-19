<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Hizmet Sayfa Listesi</h2><?php if ($_GET&&$_GET['sil']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';}?>
           <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Hizmet Başlık</th>
                    <th>Hizmet İçerik</th>
                    <th>Hizmet Sol Başlık</th>
                    <th>Hizmet Sıra</th>
                    <th>Sil</th>
                    <th>Düzenle</th>

                </tr>
                </thead>
                <tbody>
                <?php $hizmetcek=$db->query('select * from hizmet',PDO::FETCH_ASSOC);
                foreach ($hizmetcek as $hizmet){echo'
                    <tr>
                    <td><p>'.substr($hizmet['hizmet_baslik'],0,50).'</p></td>
                    <td><p>'.substr(strip_tags($hizmet['hizmet_icerik']),0,50).'..</p></td>
                    <td><p>'.substr(strip_tags($hizmet['hizmet_title']),0,50).'..</p></td>
                    <td><p>'.substr(strip_tags($hizmet['hizmet_unvan']),0,100).'</p></td>
                    <td>
                    <a href="islem/islem.php?hizmet_sil=ok&hizmet_id='.$hizmet['hizmet_id'].'&hizmet_resim='.$hizmet['hizmet_resim'].'">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                    <td>
                    <a href="hizmet_duzenle.php?hizmet_id='.$hizmet['hizmet_id'].'">
                    <button class="btn btn-success" type="submit" >Düzenlle</button>
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
