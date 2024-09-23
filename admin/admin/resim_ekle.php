<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
<script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>




        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Çoklu resim yükleme işlemleri</h2>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <p>Yüklenecek resimlerin bulunduğu klasöre giderek tamamını tek seferde seçerek yükleyebilirsiniz.</p>

                                            <form action="islem/galeri.php" method="POST" class="dropzone" >

                                            </form>

                                        </div>
                                        <a href="resim_liste.php">
                                            <button type="submit" class="btn btn-primary">Geri Dön</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>



<?php include 'footer.php';?>
