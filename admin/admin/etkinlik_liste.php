<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Etkinlik Liste</h2><?php if ($_GET&&$_GET['sil']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';}?>
            <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Sıra</th>
                    <th>Durum</th>
                    <th>Sil</th>
                    <th>Düzenle</th>

                </tr>
                </thead>
                <tbody>
                <?php $etkinlikler=$db->query('select * from etkinlikler',PDO::FETCH_ASSOC);
                foreach ($etkinlikler as $etkinlik){echo'
                    <tr>
             
                    <td><p>'.strip_tags($etkinlik['baslik']).' -- '.strip_tags($etkinlik['tarih']).' </p></td>
                    <td><p>'.strip_tags($etkinlik['sira']).'</p></td>
                    <td><p>'.strip_tags($etkinlik['durum']).'</p></td>
             
             
                   <td>
                    <a href="islem/islem.php?etkinlik_sil=ok&etkinlik_id='.$etkinlik['id'].'">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                    <td>
                    <a href="etkinlik_duzenle.php?etkinlik_id='.$etkinlik['id'].'">
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
