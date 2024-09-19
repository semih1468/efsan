<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Anasayfa 4 Listesi</h2><?php if ($_GET && $_GET['sil']) {
                echo '<h2 style="color:green;" >&nbsp;Successfully Deleted. </h2>';
            } ?>
            <?php if ($_GET && $_GET['ok']) {
                echo '<h2 style="color:green;" >&nbsp;Successfully updated.</h2>';
            } ?>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                   cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Resim</th>
                    <th>Sıra</th>
                    <th>Başlık</th>
                    <th>Sil</th>
                    <th>Düzenle</th>


                </tr>
                </thead>
                <tbody>
                <?php $dortlucek = $db->prepare('select * from anasayfadortlu order by sira asc ');
                $dortlucek->execute();
                foreach ($dortlucek as $dort) {
                    echo '
                    <tr>
                  
                    <td><img style="width: 250px;height: 200px;" src="../../upload/anasayfadortlu/' . $dort['resim'] . '"></td>
                    <td>' . $dort['sira'] . '</td>
                    <td>' . $dort['baslik'] . '</td>
                   
                    <td>
                    <a href="islem/islem.php?anasayfadortlu_sil=ok&dortlu_id=' . $dort['id'] . '&dortlu_resim=' . $dort['resim'] . '">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                       <td>
                    <a href="anasayfadortlu_duzenle.php?dortlu_id='.$dort['id'].'">
                    <button class="btn btn-success"type="submit" >Düzenle</button>
                    </a>
                    </td>
                  

                </tr> ';
                }
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

<?php include 'footer.php'; ?>
