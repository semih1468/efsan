<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
$faliyetlerimiz = $db->prepare('select * from faliyetlerimiz where id=:id');
$faliyetlerimiz->execute(array('id' => $_GET['faliyet_id']));
$faliyet = $faliyetlerimiz->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Faliyet Düzenle</h2>
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
                            <input type="file" id="last-name" name="faliyet_icon" accept="image/*"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                            Video<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="faliyet_video" accept="video/*"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                           Yatay Resmi<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="faliyet_resim" placeholder="Başlığı Yazınız" accept="image/*"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Ana Ekranda Gözüksün
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="ana_ekran" class="form-control col-md-7 col-xs-12">
                                <option value="1" <?php if ($faliyet['ana_ekran'] == 1) echo 'selected'; ?>>Gözüksün</option>
                                <option value="0" <?php if ($faliyet['ana_ekran'] == 0) echo 'selected'; ?>>Gözükmesin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Menü Baslik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="faliyet_baslik"
                                   value="<?php echo $faliyet['baslik'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sayfa Baslik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sayfa_baslik"
                                   value="<?php echo $faliyet['sayfa_baslik'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sayfa Açıklama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sayfa_aciklama"
                                   value="<?php echo $faliyet['sayfa_aciklama'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="faliyet_sira"
                                   value="<?php echo $faliyet['sira'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <input type="hidden" name="faliyet_id" value="<?php echo $_GET['faliyet_id'] ?>">
                    <input type="hidden" name="eski_resim" value="<?php echo $faliyet['resim'] ?>">

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="faliyet_duzenle" class="btn btn-success">Kaydet</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="icerikCard">
                        <h4>Faliyet İçerik</h4>
                        <div class="icerikEkle">

                            <a href="faliyeticerik_ekle.php?faliyet_id=<?php echo $_GET['faliyet_id'] ?>">
                                <button class="btn btn-success" type="submit">Ekle</button>
                            </a>

                        </div>
                    </div>
                    <div class="icerikList">
                        <?php $faliyetlericerik = $db->prepare('select * from faliyet_icerik where faliyet_id=:faliyet_id order by sira asc');
                        $faliyetlericerik->execute(array('faliyet_id' => $_GET['faliyet_id']));
                        foreach ($faliyetlericerik as $icerik) { ?>
                            <div class="item">
                                <div class="image">
                                    <img src="../../upload/faliyet/<?php echo $icerik['resim'] ?>" height="75"
                                         style="margin-right: 10px" alt="">
                                </div>
                                <div class="">
                                    <h5 style="font-weight: bold;"><?php echo $icerik['baslik'] ?></h5>
                                    <p><?php echo mb_substr($icerik['aciklama'], 0, 150) ?></p>
                                </div>
                                <div class="islem">
                                    <div class="sil">
                                        <a href="islem/islem.php?faliyeticerik_sil=ok&faliyet_id=<?php echo $_GET['faliyet_id'] ?>&faliyet_resim=<?php echo $icerik['resim'] ?>&faliyeticerik_id=<?php echo $icerik['id'] ?>">
                                            <button class="btn btn-danger" type="submit">Sil</button>
                                        </a>
                                    </div>
                                    <div class="edit">
                                        <a href="faliyeticerik_duzenle.php?faliyet_id=<?php echo $_GET['faliyet_id'] ?>&faliyeticerik_id=<?php echo $icerik['id'] ?>">
                                            <button class="btn btn-success" type="submit">Düzenle</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
<!--            <div class="row">-->
<!--                <div class="col-md-2"></div>-->
<!--                <div class="col-md-8">-->
<!--                    <div class="icerikCard">-->
<!--                        <h4>Faliyet Özellik</h4>-->
<!--                        <div class="icerikEkle">-->
<!---->
<!--                            <a href="faliyetozellik_ekle.php?faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--">-->
<!--                                <button class="btn btn-success" type="submit">Ekle</button>-->
<!--                            </a>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="icerikList">-->
<!--                        --><?php //$faliyetozellik = $db->prepare('select * from faliyet_ozellik where faliyet_id=:faliyet_id order by sira asc');
//                        $faliyetozellik->execute(array('faliyet_id' => $_GET['faliyet_id']));
//                        foreach ($faliyetozellik as $ozellik) { ?>
<!--                            <div class="item">-->
<!--                                <div class="image">-->
<!--                                    <img src="../../upload/faliyet/--><?php //echo $ozellik['resim'] ?><!--" height="75"-->
<!--                                         style="margin-right: 10px" alt="">-->
<!--                                </div>-->
<!--                                <div class="">-->
<!--                                    <h5 style="font-weight: bold;">--><?php //echo $ozellik['baslik'] ?><!--</h5>-->
<!--                                    <p>--><?php //echo mb_substr($ozellik['aciklama'], 0, 150) ?><!--</p>-->
<!--                                </div>-->
<!--                                <div class="islem">-->
<!--                                    <div class="sil">-->
<!--                                        <a href="islem/islem.php?faliyetozellik_sil=ok&faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--&faliyet_resim=--><?php //echo $ozellik['resim'] ?><!--&faliyetozellik_id=--><?php //echo $ozellik['id'] ?><!--">-->
<!--                                            <button class="btn btn-danger" type="submit">Sil</button>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                    <div class="edit">-->
<!--                                        <a href="faliyetozellik_duzenle.php?faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--&faliyetozellik_id=--><?php //echo $ozellik['id'] ?><!--">-->
<!--                                            <button class="btn btn-success" type="submit">Düzenle</button>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col-md-2"></div>-->
<!--                <div class="col-md-8">-->
<!--                    <div class="icerikCard">-->
<!--                        <h4>Faliyet Nasıl Çalışır</h4>-->
<!--                        <div class="icerikEkle">-->
<!---->
<!--                            <a href="faliyetnasil_ekle.php?faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--">-->
<!--                                <button class="btn btn-success" type="submit">Ekle</button>-->
<!--                            </a>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="icerikList">-->
<!--                        --><?php //$faliyetnasilcalisir = $db->prepare('select * from faliyet_nasil_calisir where faliyet_id=:faliyet_id order by sira asc');
//                        $faliyetnasilcalisir->execute(array('faliyet_id' => $_GET['faliyet_id']));
//                        foreach ($faliyetnasilcalisir as $nasilcalisir) { ?>
<!--                            <div class="item">-->
<!--                                <div class="image">-->
<!--                                    <img src="../../upload/faliyet/--><?php //echo $nasilcalisir['resim'] ?><!--" height="75"-->
<!--                                         style="margin-right: 10px" alt="">-->
<!--                                </div>-->
<!--                                <div class="">-->
<!--                                    <h5 style="font-weight: bold;">--><?php //echo $nasilcalisir['baslik'] ?><!--</h5>-->
<!---->
<!--                                </div>-->
<!--                                <div class="islem">-->
<!--                                    <div class="sil">-->
<!--                                        <a href="islem/islem.php?faliyetnasil_sil=ok&faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--&faliyet_resim=--><?php //echo $nasilcalisir['resim'] ?><!--&selfId=--><?php //echo $nasilcalisir['id'] ?><!--">-->
<!--                                            <button class="btn btn-danger" type="submit">Sil</button>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                    <div class="edit">-->
<!--                                        <a href="faliyetnasil_duzenle.php?faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--&faliyetnasil_id=--><?php //echo $nasilcalisir['id'] ?><!--">-->
<!--                                            <button class="btn btn-success" type="submit">Düzenle</button>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col-md-2"></div>-->
<!--                <div class="col-md-8">-->
<!--                    <div class="icerikCard">-->
<!--                        <h4>Faliyet S.S.S</h4>-->
<!--                        <div class="icerikEkle">-->
<!---->
<!--                            <a href="faliyetsss_ekle.php?faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--">-->
<!--                                <button class="btn btn-success" type="submit">Ekle</button>-->
<!--                            </a>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="icerikList">-->
<!--                        --><?php //$faliyetsss = $db->prepare('select * from faliyet_sss where faliyet_id=:faliyet_id order by sira asc');
//                        $faliyetsss->execute(array('faliyet_id' => $_GET['faliyet_id']));
//                        foreach ($faliyetsss as $sss) { ?>
<!--                            <div class="item">-->
<!---->
<!--                                <div class="">-->
<!--                                    <h5 style="font-weight: bold;">--><?php //echo $sss['baslik'] ?><!--</h5>-->
<!--                                    <p>--><?php //echo mb_substr($sss['aciklama'], 0, 150) ?><!--</p>-->
<!--                                </div>-->
<!--                                <div class="islem">-->
<!--                                    <div class="sil">-->
<!--                                        <a href="islem/islem.php?faliyetsss_sil=ok&faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--&selfId=--><?php //echo $sss['id'] ?><!--">-->
<!--                                            <button class="btn btn-danger" type="submit">Sil</button>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                    <div class="edit">-->
<!--                                        <a href="faliyetsss_duzenle.php?faliyet_id=--><?php //echo $_GET['faliyet_id'] ?><!--&faliyetsss_id=--><?php //echo $sss['id'] ?><!--">-->
<!--                                            <button class="btn btn-success" type="submit">Düzenle</button>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->
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
