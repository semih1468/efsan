<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>İletisim Liste</h2><?php if ($_GET&&$_GET['sil']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';}?>
            <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Telefon</th>
                    <th>Mail</th>
                    <th>Not</th>

                </tr>
                </thead>
                <tbody>
                <?php $iletisimcek=$db->query('select * from iletisim',PDO::FETCH_ASSOC);
                foreach ($iletisimcek as $iletisim){echo'
                    <tr>
             
                    <td><p>'.strip_tags($iletisim['ad']).'</p></td>
                    <td><p>'.strip_tags($iletisim['soyad']).'</p></td>
                    <td><p>'.strip_tags($iletisim['tel']).'</p></td>
                    <td><p>'.strip_tags($iletisim['mail']).'</p></td>
                    <td><p>'.strip_tags($iletisim['note']).'</p></td>
               
                 
                  

                </tr> ';
                }
                ?>


                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include 'footer.php';?>
