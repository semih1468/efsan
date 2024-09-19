<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
$urunbul = $db->prepare('select * from urunlerimiz where id=:id');
$urunbul->execute(array('id' => $_GET['urun_id']));
$urun = $urunbul->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ürün Düzenle</h2>
                <?php if ($_GET && $_GET['duzenle']) {
                    echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';
                } ?>
                <?php if ($_GET && $_GET['sil']) {
                    echo '<h2 style="color:green;" >&nbsp;Başarı ile Silinmiştir. </h2>';
                } ?>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br/>
                <form method="post" data-parsley-validate class="form-horizontal form-label-left"
                      action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                            Menü Icon<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="urun_icon"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                            Ana Resmi<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="urun_resim_kare"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                           Yatay Resmi<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="urun_resim" placeholder="Başlığı Yazınız"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Menü Baslik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="urun_baslik"
                                   value="<?php echo $urun['baslik'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sayfa Baslik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sayfa_baslik"
                                   value="<?php echo $urun['sayfa_baslik'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sayfa Açıklama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sayfa_aciklama"
                                   value="<?php echo $urun['sayfa_aciklama'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="urun_sira"
                                   value="<?php echo $urun['sira'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <input type="hidden" name="urun_id" value="<?php echo $_GET['urun_id'] ?>">
                    <input type="hidden" name="eski_resim" value="<?php echo $urun['resim'] ?>">

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="urun_duzenle" class="btn btn-success">Kaydet</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="icerikCard">
                        <h4>Ürün İçerik</h4>
                        <div class="icerikEkle">

                            <a href="urunicerik_ekle.php?urun_id=<?php echo $_GET['urun_id'] ?>">
                                <button class="btn btn-success" type="submit">Ekle</button>
                            </a>

                        </div>
                    </div>
                    <div class="icerikList">
                        <?php $urunlericerik = $db->prepare('select * from urun_icerik where urun_id=:urun_id order by sira asc');
                        $urunlericerik->execute(array('urun_id' => $_GET['urun_id']));
                        foreach ($urunlericerik as $icerik) { ?>
                            <div class="item">
                                <div class="image">
                                    <img src="../../upload/urun/<?php echo $icerik['resim'] ?>" height="75"
                                         style="margin-right: 10px" alt="">
                                </div>
                                <div class="">
                                    <h5 style="font-weight: bold;"><?php echo $icerik['baslik'] ?></h5>
                                    <p><?php echo mb_substr($icerik['aciklama'], 0, 150) ?></p>
                                </div>
                                <div class="islem">
                                    <div class="sil">
                                        <a href="islem/islem.php?urunicerik_sil=ok&urun_id=<?php echo $_GET['urun_id'] ?>&urun_resim=<?php echo $icerik['resim'] ?>&urunicerik_id=<?php echo $icerik['id'] ?>">
                                            <button class="btn btn-danger" type="submit">Sil</button>
                                        </a>
                                    </div>
                                    <div class="edit">
                                        <a href="urunicerik_duzenle.php?urun_id=<?php echo $_GET['urun_id'] ?>&urunicerik_id=<?php echo $icerik['id'] ?>">
                                            <button class="btn btn-success" type="submit">Düzenle</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="icerikCard">
                        <h4>Ürün Özellik</h4>
                        <div class="icerikEkle">

                            <a href="urunozellik_ekle.php?urun_id=<?php echo $_GET['urun_id'] ?>">
                                <button class="btn btn-success" type="submit">Ekle</button>
                            </a>

                        </div>
                    </div>
                    <div class="icerikList">
                        <?php $urunozellik = $db->prepare('select * from urun_ozellik where urun_id=:urun_id order by sira asc');
                        $urunozellik->execute(array('urun_id' => $_GET['urun_id']));
                        foreach ($urunozellik as $ozellik) { ?>
                            <div class="item">
                                <div class="image">
                                    <img src="../../upload/urun/<?php echo $ozellik['resim'] ?>" height="75"
                                         style="margin-right: 10px" alt="">
                                </div>
                                <div class="">
                                    <h5 style="font-weight: bold;"><?php echo $ozellik['baslik'] ?></h5>
                                    <p><?php echo mb_substr($ozellik['aciklama'], 0, 150) ?></p>
                                </div>
                                <div class="islem">
                                    <div class="sil">
                                        <a href="islem/islem.php?urunozellik_sil=ok&urun_id=<?php echo $_GET['urun_id'] ?>&urun_resim=<?php echo $ozellik['resim'] ?>&urunozellik_id=<?php echo $ozellik['id'] ?>">
                                            <button class="btn btn-danger" type="submit">Sil</button>
                                        </a>
                                    </div>
                                    <div class="edit">
                                        <a href="urunozellik_duzenle.php?urun_id=<?php echo $_GET['urun_id'] ?>&urunozellik_id=<?php echo $ozellik['id'] ?>">
                                            <button class="btn btn-success" type="submit">Düzenle</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="icerikCard">
                        <h4>Ürün Nasıl Çalışır</h4>
                        <div class="icerikEkle">

                            <a href="urunnasil_ekle.php?urun_id=<?php echo $_GET['urun_id'] ?>">
                                <button class="btn btn-success" type="submit">Ekle</button>
                            </a>

                        </div>
                    </div>
                    <div class="icerikList">
                        <?php $urunnasilcalisir = $db->prepare('select * from urun_nasil_calisir where urun_id=:urun_id order by sira asc');
                        $urunnasilcalisir->execute(array('urun_id' => $_GET['urun_id']));
                        foreach ($urunnasilcalisir as $nasilcalisir) { ?>
                            <div class="item">
                                <div class="image">
                                    <img src="../../upload/urun/<?php echo $nasilcalisir['resim'] ?>" height="75"
                                         style="margin-right: 10px" alt="">
                                </div>
                                <div class="">
                                    <h5 style="font-weight: bold;"><?php echo $nasilcalisir['baslik'] ?></h5>

                                </div>
                                <div class="islem">
                                    <div class="sil">
                                        <a href="islem/islem.php?urunnasil_sil=ok&urun_id=<?php echo $_GET['urun_id'] ?>&urun_resim=<?php echo $nasilcalisir['resim'] ?>&selfId=<?php echo $nasilcalisir['id'] ?>">
                                            <button class="btn btn-danger" type="submit">Sil</button>
                                        </a>
                                    </div>
                                    <div class="edit">
                                        <a href="urunnasil_duzenle.php?urun_id=<?php echo $_GET['urun_id'] ?>&urunnasil_id=<?php echo $nasilcalisir['id'] ?>">
                                            <button class="btn btn-success" type="submit">Düzenle</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="icerikCard">
                        <h4>Ürün S.S.S</h4>
                        <div class="icerikEkle">

                            <a href="urunsss_ekle.php?urun_id=<?php echo $_GET['urun_id'] ?>">
                                <button class="btn btn-success" type="submit">Ekle</button>
                            </a>

                        </div>
                    </div>
                    <div class="icerikList">
                        <?php $urunsss = $db->prepare('select * from urun_sss where urun_id=:urun_id order by sira asc');
                        $urunsss->execute(array('urun_id' => $_GET['urun_id']));
                        foreach ($urunsss as $sss) { ?>
                            <div class="item">

                                <div class="">
                                    <h5 style="font-weight: bold;"><?php echo $sss['baslik'] ?></h5>
                                    <p><?php echo mb_substr($sss['aciklama'], 0, 150) ?></p>
                                </div>
                                <div class="islem">
                                    <div class="sil">
                                        <a href="islem/islem.php?urunsss_sil=ok&urun_id=<?php echo $_GET['urun_id'] ?>&selfId=<?php echo $sss['id'] ?>">
                                            <button class="btn btn-danger" type="submit">Sil</button>
                                        </a>
                                    </div>
                                    <div class="edit">
                                        <a href="urunsss_duzenle.php?urun_id=<?php echo $_GET['urun_id'] ?>&urunsss_id=<?php echo $sss['id'] ?>">
                                            <button class="btn btn-success" type="submit">Düzenle</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .icerikList .item {
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .icerikCard {
        display: flex;
        justify-content: space-between;
    }

    .islem {
        display: flex;
    }
</style>
<?php include 'footer.php'; ?>
