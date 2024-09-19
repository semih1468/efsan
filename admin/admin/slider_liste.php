<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Slider Listesi</h2><?php if ($_GET && $_GET['sil']) {
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
                    <th>Açıklama</th>
                    <th>Sil</th>
                    <th>Düzenle</th>


                </tr>
                </thead>
                <tbody>
                <?php $slidercek = $db->prepare('select * from slider order by sira asc ');
                $slidercek->execute();
                foreach ($slidercek as $slider) {
                    echo '
                    <tr>
                  
                    <td><img style="width: 250px;height: 200px;" src="../../upload/slider/' . $slider['slider_resim'] . '"></td>
                    <td>' . $slider['sira'] . '</td>
                    <td>' . $slider['slider_title'] . '</td>
                    <td>' . $slider['slider_alt'] . '</td>
                    <td>
                    <a href="islem/islem.php?slider_sil=ok&slider_id=' . $slider['slider_id'] . '&slider_resim=' . $slider['slider_resim'] . '">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                       <td>
                    <a href="slider_duzenle.php?slider_id='.$slider['slider_id'].'">
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
