<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Faliyetlerimiz Listesi</h2><?php if ($_GET&&$_GET['sil']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';}?>
            <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th> Resim</th>
                    <th> Baslik</th>
                    <th> Sıra</th>

                    <th>Sil</th>
                    <th>Düzenle</th>


                </tr>
                </thead>
                <tbody>
                <?php $faliyetlerimiz=$db->query('select * from faliyetlerimiz',PDO::FETCH_ASSOC);
                foreach ($faliyetlerimiz as $faliyet){echo'
                    <tr>
                  
                    <td><img style="width: 150px;height: 150px;" src="../../upload/faliyet/'.$faliyet['resim'].'"></td>
                    <td>'.$faliyet['baslik'].'</td>
                    <td>'.$faliyet['sira'].'</td>
              
                    <td>
                    <a href="islem/islem.php?faliyet_sil=ok&faliyet_id='.$faliyet['id'].'&faliyet_resim='.$faliyet['resim'].'">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                       <td>
                    <a href="faliyetlerimiz_duzenle.php?faliyet_id='.$faliyet['id'].'">
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
