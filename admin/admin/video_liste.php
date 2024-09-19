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
                    <th>Link</th>
                    <th>Sil</th>
                    <th>Düzenle</th>


                </tr>
                </thead>
                <tbody>
                <?php $videocek = $db->prepare('select * from video order by sira');
                $videocek->execute();
                foreach ($videocek as $video) {
                    echo '
                    <tr>
                  
                    <td><img style="width: 250px;height: 200px;" src="../../upload/video/' . $video['video_resim'] . '"></td>
                    <td>' . $video['video_url'] . '</td>
     
                    <td>
                    <a href="islem/islem.php?video_sil=ok&video_id=' . $video['video_id'] . '&video_resim=' . $video['video_resim'] . '">
                    <button class="btn btn-danger"type="submit" >Sil</button>
                    </a>
                    </td>
                    <td>
                    <a href="video_duzenle.php?video_id='.$video['video_id'].'">
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
