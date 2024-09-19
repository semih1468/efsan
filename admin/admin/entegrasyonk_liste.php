<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Kategori Listesi</h2><?php if ($_GET&&$_GET['sil']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';}?>
            <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>

                    <th>Baslik</th>
                    <th>Sıra</th>
                    <th>Sil</th>
                    <th>Düzenle</th>


                </tr>
                </thead>
                <tbody>
                <?php $kategoricek=$db->query('select * from entegrasyon_kategori',PDO::FETCH_ASSOC);
                foreach ($kategoricek as $kategori){echo'
                    <tr>
                     
                    <td>'.$kategori['baslik'].'</td>
                    <td>'.$kategori['sira'].'</td>
              
                    <td>
                    <a href="islem/islem.php?entegrasyonkategori_sil=ok&entegrasyonk_id='.$kategori['id'].'">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                    <td>
                    <a href="entegrasyonk_duzenle.php?entegrasyonkategori_id='.$kategori['id'].'">
                    <button class="btn btn-success"type="submit" >Düzenle</button>
                    </a>
                    </td>
                  

                </tr> ';
                }
                ?>
                <style>
                    iframe{
                        width: 250px !important;
                        height: 200px !important;
                    }
                </style>

                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include 'footer.php';?>
