<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Referans Listesi</h2><?php if ($_GET&&$_GET['sil']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';}?>
            <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Referans Resim</th>
                    <th>Referans Baslik</th>
                    <th>Referans Sıra</th>

                    <th>Sil</th>
                    <th>Düzenle</th>


                </tr>
                </thead>
                <tbody>
                <?php $referanscek=$db->query('select * from referans',PDO::FETCH_ASSOC);
                foreach ($referanscek as $referans){echo'
                    <tr>
                  
                    <td><img style="width: 150px;height: 150px;" src="../../upload/referans/'.$referans['referans_resim'].'"></td>
                    <td>'.$referans['referans_baslik'].'</td>
                    <td>'.$referans['referans_sira'].'</td>
              
                    <td>
                    <a href="islem/islem.php?referans_sil=ok&referans_id='.$referans['referans_id'].'&referans_resim='.$referans['referans_resim'].'">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                       <td>
                    <a href="referans_duzenle.php?referans_id='.$referans['referans_id'].'">
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
