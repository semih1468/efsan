

$(function () {
    var base_url = $('.base_url').val();
    particlesJS.load('particles-js', base_url + 'dist/assests/js/particlesjs-config.json', function () {
        //console.log('callback - particles.js config loaded');
    });

    $(function () {
        $(document).scroll(function () {
          var $nav = $("header");
          $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
      });

    $('.openmenubtn').click(function () {
        if ($(this).hasClass('opened')) {
            $(this).removeClass('opened');
            $(this).find('i').removeClass('ri-close-line');
            $(this).find('i').addClass('ri-menu-line');
            $('.navul').removeClass('show');
        } else {
            $(this).addClass('opened');
            $(this).find('i').removeClass('ri-menu-line');
            $(this).find('i').addClass('ri-close-line');
            $('.navul').addClass('show');
        }
    })

    $('.owlmainsec').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 11000,
        items: 1,
        smartSpeed: 700,
    });

    $('.owl-partners').owlCarousel({
        loop: true,
        nav: false,
        center: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 3,
                stagePadding:50,
                margin: 30,
            },
            768: {
                items: 5,
                margin: 40,
            },
            1000: {
                items: 7,
                margin: 60,
            }
        },
        smartSpeed: 700,
    });


    $('.etkinlikowlrightbtn').click(function () {
        $('.etkinlikowl').trigger('next.owl.carousel', [700]);
    })
    $('.etkinlikowlleftbtn').click(function () {
        $('.etkinlikowl').trigger('prev.owl.carousel', [700]);
    });
    $('.nexteventdatebtn:nth-child(1)').addClass('active');


    $('.nexteventdatebtn').click(function () {
        var title = $(this).attr('data-title');
        var date = $(this).attr('data-date');
        var image = $(this).attr('data-image');
        var text = $(this).attr('data-text');
        var link = $(this).attr('data-link');
        $('.nexteventdatebtn').removeClass('active');
        $(this).addClass('active');

        $('.nexteventname').html(title);
        $('.nexteventdate').html(date);
        $('.nexteventimg').attr('src', image);
        $('.rezervasyonbtn').attr('href', link);
        $('.nexteventtext').html(text);


        autoplaynth = $(this).index();
    });

    var autoplaynth = 0;
    var eventdatebtnlen = $(".nexteventsdates").find(".nexteventdatebtn").length
    var autoplay = function () {
        $('.nexteventdatebtn.active').next('.nexteventdatebtn').trigger('click');
        autoplaynth++;
        if (autoplaynth > eventdatebtnlen) {
            $('.nexteventdatebtn:first-child').trigger('click');
            autoplaynth = 0;
        }
    };
    timer = setInterval(autoplay, 5000);
    $('.nexteventcont').hover(
        function () {
            clearInterval(timer)
        },
        function () {
            timer = setInterval(autoplay, 5000);
        }
    );

    $('.eventgalleryowl').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        },
        smartSpeed: 700,
    });

    setTimeout(function () {
        $('model-viewer').addClass('visible');
    }, 1000);

    var divs = $(".masabutton");
    var i = 0;
    var loop = window.setInterval(function () {
        $(divs[i]).addClass('visible');
        i++;
        if (i == divs.length)
            clearInterval(loop);
    }, 25);


    $('.masabutton').click(function () {
        var etkinlikid = $('.etkinlikid').val();


        var masano = $(this).attr('data-masano');
        var masaid = $(this).data('masaid');
        var masakonum = $(this).data('masakonum');
        var kisisayisi = $('.kisisayisimodalinput').val();
        $('.modalmasano').html(masano);
        $('.modalmasakisisayisi').html(kisisayisi);
        $('.rezervasyonformmodal').addClass('modalopen');
        $('.rezervasyonformmodal').removeClass('modalclose');
        $('body,html').css('overflow','hidden');

        $('.menudetail').addClass('d-none');
        $('.toplamfiyat').empty();
        $('.kaporafiyat').empty();
        $('.bankabilgileri').removeClass('show');
        $('.rezervasyonsubmit').removeClass('show');

        $('.masano').val(masaid);


        var masamenuler = JSON.parse($('.' + masakonum).val());
        $('.menuselect').empty();
        $(".menuselect").append('<option value="-1">Menü Seçiniz</option>');
        $.each(masamenuler, function (index, menu) {
            $(".menuselect").append('<option data-price="' + menu.value + '" value="' + menu.id + '">' + menu.name + '</option>');
        });

    });


    $(document).on('change', '.menuselect', function () {
        $('.menudetailcont').empty();
        var menuid = $(this).val();
        var kisisayisi = $('.kisisayisimodalinput').val();
        $('.bankabilgileri').addClass('show');
        if (menuid != -1) {
            $('.rezervasyonsummary').removeClass('d-none');
            var price = $(this).find(':selected').data('price');
            $('.kisibasifiyat').html('Kişi Başı Ortalama: ' + price + '₺');
            $.ajax({
                url: base_url + 'home/getmenu/' + menuid,
                type: "POST",
                data: { menuid: menuid },
                success: function (response) {
                    $('.menudetail').removeClass('d-none');
                    $('.menudetailcont').html(response);
                }
            });
            $('.toplamfiyat').html(kisisayisi + ' kişi için ortalama fiyat: <span>' + (price * kisisayisi) + '₺</span>')
            $('.kaporafiyat').html('24 saat içinde <span>' + ((price * kisisayisi) / 2) + '₺</span> kapora göndermeniz gerekmektedir!');
            $('.rezervasyonsubmit').addClass('show');

            $('.toplamfiyatform').val(price * kisisayisi);
            $('.kaporafiyatform').val((price * kisisayisi) / 2);
        } else {
            $('.menudetail').addClass('d-none');
            $('.rezervasyonsummary').addClass('d-none');
        }


    })

    $('.rezervasyonformmodalbg, .modalclosebutton').click(function () {
        $('.rezervasyonformmodal').addClass('modalclose');
        $('.rezervasyonsummary').addClass('d-none');
        $('.rezervasyonformmodal').removeClass('modalopen');
        $('body,html').removeAttr('style');
    })


    $('.checkboxgroup span').click(function () {
        var checktype = $(this).data('type');

        $('.sozlesmemodal.' + checktype).addClass('show');
    });

    $('.sozlesmemodalbg,.sozlesmemodalclosebutton').click(function () {
        $('.sozlesmemodal').removeClass('show');
    });

    $('.sozlesmebtn').click(function () {
        var sozlesmebtn = $(this).data('sozlesmebtn');

        $('#' + sozlesmebtn).trigger('click');
        $(this).closest('.sozlesmemodal').removeClass('show');
    });



    $('.telinput').mask("(999) 999-9999");


    $('.rezervasyonsubmit').on('click', function () {
        // Form verilerini al
        var etkinlikId = $('input[name="etkinlikid"]').val();
        var masaKisiSayisi = $('input[name="kisisayisi"]').val();
        var masaNo = $('input[name="masano"]').val();
        var menuSecimi = $('.menuselect').val();
        var adSoyad = $('input[name="name"]').val();
        var telefon = $('input[name="phone"]').val();
        var email = $('input[name="email"]').val();
        var fiyat = $('input[name="toplamfiyat"]').val();
        var kapora = $('input[name="kaporafiyat"]').val();
        var not = $('textarea[name="not"]').val();
        var gelisSaati = $('input[name="arrival"]').val();
        var rezervasyonSozlesmesi = $('#rezervasyonsozlesmesi').is(':checked');
        var kvkkFormu = $('#kvkkformu').is(':checked');


        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (adSoyad != '') {
            if (telefon != '') {
                if (emailRegex.test(email)) {
                    if (menuSecimi != '') {
                        if (gelisSaati != '') {
                            if (rezervasyonSozlesmesi) {
                                if (kvkkFormu) {


                                    $.ajax({
                                        url: base_url + 'rezervasyonform',
                                        type: 'POST',
                                        data: {
                                            rezervasyon_name: adSoyad,
                                            rezervasyon_phone: telefon,
                                            rezervasyon_email: email,
                                            rezervasyon_menu: menuSecimi,
                                            rezervasyon_arrival: gelisSaati,
                                            rezervasyon_etkinlik: etkinlikId,
                                            rezervasyon_kisisayisi: masaKisiSayisi,
                                            rezervasyon_masano: masaNo,
                                            rezervasyon_not: not,
                                            rezervasyon_fiyat: fiyat,
                                            rezervasyon_kapora: kapora,
                                            rezervasyon_onay: "1",
                                        },
                                        success: function (data) {
                                            $('.rezervasyonsubmit').addClass('disabled');
                                            if(data == "1"){
                                                Swal.fire({
                                                    title: "Teşekkürler",
                                                    text: "Rezervasyonunuz ile ilgili en kısa zamanda bilgilendirileceksiniz!",
                                                    icon: "success"
                                                });
                                                setTimeout(function () {
                                                    window.location.href = base_url;
                                                }, 5000);
                                            }else{
                                                Swal.fire({
                                                    title: "İşlem gerçekleştirilemedi.",
                                                    text: "Seçtiğiniz masa dolu. Lütfen başka masa seçin.",
                                                    icon: "error"
                                                });
                                            }

                                            /**/
                                        }
                                    })


                                } else {
                                    Swal.fire({
                                        title: "Hata",
                                        text: "Lütfen KVKK formunu onaylayınız!",
                                        icon: "error"
                                    });
                                    return;
                                }
                            } else {
                                Swal.fire({
                                    title: "Hata",
                                    text: "Lütfen rezervasyon sözleşmesini onaylayınız!",
                                    icon: "error"
                                });
                                return;
                            }
                        } else {
                            Swal.fire({
                                title: "Hata",
                                text: "Lütfen geliş saatinizi belirtiniz!",
                                icon: "error"
                            });
                            return;
                        }
                    } else {
                        Swal.fire({
                            title: "Hata",
                            text: "Lütfen menü seçiniz!",
                            icon: "error"
                        });
                        return;
                    }
                } else {
                    Swal.fire({
                        title: "Hata",
                        text: "Lütfen e-posta adresinizi giriniz!",
                        icon: "error"
                    });
                    return;
                }
            } else {
                Swal.fire({
                    title: "Hata",
                    text: "Lütfen telefon numaranızı giriniz!",
                    icon: "error"
                });
                return;
            }
        } else {
            Swal.fire({
                title: "Hata",
                text: "Lütfen ad soyad kısmını doldurunuz!",
                icon: "error"
            });
            return;
        }

    });
})