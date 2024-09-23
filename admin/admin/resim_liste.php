<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Resim  Listesi</h2><?php if ($_GET['sil']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';}?>
            <h2>Resim Listesi</h2><?php if ($_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Resim Başlık</th>
              ,
                    <th>Sil</th>


                </tr>
                </thead>
                <tbody>
                <?php $resimcek=$db->query('select * from resim',PDO::FETCH_ASSOC);
                foreach ($resimcek as $resim){echo'
                    <tr>
                    <td><img style="width: 200px;height: 150px;" src="../../upload/resim/'.$resim['resim_baslik'].'"></td>';
                    echo'
                    <td>
                    <a href="islem/islem.php?resim_sil=ok&resim_id='.$resim['resim_id'].'&resim_baslik='.$resim['resim_baslik'].'">
                    <button class="btn btn-danger"type="submit" >Sil</button>
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
