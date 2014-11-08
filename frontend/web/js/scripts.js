$(document).ready(function () {


    // Общее //
    ///////////
    // Скролл в начало страницы
    $('#up').on('click', function () {
        $('body,html').animate({scrollTop: 0}, 1000, 'swing');
    });
    // Скрол к форме записать на консультацию
    $('#top_zap a').on('click', function () {
        $('.bigbutton').trigger('click');
        $('body,html').animate({scrollTop: $('#make_an_appointment').position().top - 90}, 1500, 'swing');
    });


    //Высота самого большого пункта меню и изменение всех пунктов под этот размер
    var menu_item_h = $(".menu li:last").height();
    $(".menu li").height(menu_item_h - 1);

    // Вертикальное выравнвание (проверяется наличие элемента)
    v_mid($(".big_info"), ".desc");
    v_mid($(".all_otz .item"), "span");
    v_mid($("#ill_menu .item"), "span");
    v_mid($("#ill_mini .item"), ".text");
    v_mid($("#mini_info .item"), "span");
    v_mid($(".header"), ".open");


    /////////////////////////////////////////////////////////////////


    // События для главной страницы //
    //////////////////////////////////
    if ($("#imgs").length) {
        var menu_last = $("#ill_menu .item:last"); //Последний элемент
        var menu_first = $("#ill_menu .item:first"); //Первый элемент

        //Загрузка изображения в шапке
        $(".main_img").animate({
            opacity: 1
        }, 2000);

        //Исправление сдвига изображений в меню болезней
        $("#ill_menu .item").each(function () {
            $(this).find("img").css("left", $(this).width() / 2 - 32);
        });

        // Анимация изображений на главной странице
        $(window).scroll(function () {
            $("#imgs img").each(function () {
                if ($(this).offset().top + $(this).height() < $(window).scrollTop() + $(window).height()) {
                    $(this).addClass("vis").next("img").addClass("vis");
                }
            });
        });

        // Треугольники в шапке
        //Диагональ большого ромба меню болезней
        var help = menu_last.width();

        //Расстояние от левого края до крайней точки диагонали последнего элемента меню
        var off_menu = menu_last.offset().left + help - $("#tri_r").offset().left + 16;

        // Сдвиг правого белого треугольника к крайней точке меню
        $("#tri_r").css("right", off_menu * (-1) + "px");

        // Размер левого белого треугольника
        var r_bord = ( menu_first.offset().left + menu_first.width() / 2 ) / 2;

        $("#tri_l").css({
            "border": r_bord + "px solid transparent",
            "border-top": r_bord + "px solid #fff",
            "border-left": r_bord + "px solid #fff"
        });

        //Исправление отступа части треугольника в шапке
        var tri_big = r_bord + ($(".menu").offset().top + $(".menu").height()) / 2;

        $(".tri_l_big").css({
            "border": tri_big + "px solid transparent",
            "border-top": tri_big + "px solid #fff",
            "border-left": tri_big + "px solid #fff"
        });

        //Размер бордера серого треугольника
        var gray_bord = (menu_last.offset().left + help) / 2;

        $(".gray_tri").css({
            "border": gray_bord + "px solid transparent",
            "border-top": gray_bord + "px solid #fafafa",
            "border-left": gray_bord + "px solid #fafafa"
        });
    }


    /////////////////////////////////////////////////////////////////

    $('#mf2').MultiFile({
        accept:'jpg|jpeg|png|gif',
        max: 5,
        list: '#form_mf2',
        //STRING: {
        //    remove: '<img src="/img/delete.png"/>'
        //
        //},
        onFileRemove: function(element, value, master_element){
            $('#attached_file').val('');
        }
    });

    // Блок контактов //
    ////////////////////
    if ($("#main_contact").length) {

        var main_cont = $("#main_contact");


        //Прячем блок
        main_cont.hide();
        main_cont.children().css("opacity", 0);

        //Открытие и сокрытие блока контактов
        $(".bigbutton").on('click', function () {
            main_cont.slideToggle(function () {

                //Выравнивание textarea по высоте контактов
                var txtarea = $("#main_contact #consultationform-additional_info");
                //alert($(".l").offset().top + $(".l").height() - txtarea.offset().top - 24);
                if (txtarea.height() < 100) {
                    //txtarea.css("height", $(".l").offset().top + $(".l").height() - txtarea.offset().top - 24);
                }
                var del = 500;
                main_cont.children().each(function () {
                    $(this).animate({opacity: 1}, 200);
                });
            });
        });

        $("select").fancySelect();

        // Мультивыбор файлов
        $(document).on('click', '.MultiFile-remove', function () {
            $(this).parent('.MultiFile-label').remove();
            $('#attached_file').val('');
        });
        UploadFileByAjax();

        // Проверяем заполненность полей
        $('#login-form input[type=text], #login-form textarea').on('blur', function () {
            if ($(this).val() == "") {
                $(this).addClass('required')
            } else {
                $(this).removeClass('required')
            }
        });
        $('#login-form .fancy-select select').on('change', function () {
            $(this).removeClass('required')
        });

//        $('#mf').MultiFile({
//            accept:'doc|docx|xls|xlsx|zip|rar',
//            list: '#form_mf',
//            STRING: {
//                remove: '<img src="img/delete.png"/>'
//            },
//            onFileRemove: function(element, value, master_element){
//                $('#attached_file').val('');
//            },
//            onFileSelect: function(element, value, master_element){
////                var id = $(element).attr('id');
////                $('#'+id).attr('id', 'mf');
////                alert($(element).attr('id'));
////                UploadFileByAjax();
//            }
//        });

        // Консультация //
        /////////////////
        $('#consultation-submit').on('click', function () {
            if (validateFields()) {
                $.ajax({
                    type: 'post',
                    data: $('#login-form').serialize(),
                    url: $('#login-form').attr('action'),
                    dataType: 'json',
                    success: function (result) {
                        if (result.error) {

                        } else {
                            $('#attached_file').val('');
                            $('#login-form input[type=text]').val("");
                            $('#login-form textarea').val("");
                            $('#form_mf').html('');
                            $('#success').html(result.message).slideDown('slow').delay(1800).slideUp('slow');
                        }
                    }
                });
            }

            return false;
        });
        /**/
        // Контакт //
        /////////////////
        $('#contact-submit, #comment-submit').on('click', function () {
            $.ajax({
                type: 'post',
                data: $('#contact-form').serialize(),
                url: $('#contact-form').attr('action'),
                dataType: 'json',
                success: function (result) {
                    if (result.error) {

                    } else {
                        $('#contact-form input[type=text]').val("");
                        $('#contact-form textarea').val("");
                        $('#form_mf').html('');
                        $('#success').html(result.message).slideDown('slow').delay(3800).slideUp('slow');
                    }
                }
            });
            return false;
        });
//
    }


    /////////////////////////////////////////////////////////////////


    // Маленькое меню болезней //
    /////////////////////////////
    if ($("#ill_mini").length) {
        //Последний и первый пункты в маленьком меню
        var l_i = $("#ill_mini .item:last");
        var f_i = $("#ill_mini .item:first");

        //Диагональ последнего ромба
        var help = l_i.width();

        //Расстояние до левого края первого ромба
        var help2 = (f_i.offset().left) / 2;

        //Размер бордера для треугольника
        var gray_bord = (l_i.offset().left + help) / 2;
        var wl_bord = help2 + $(".mini_top_img").height() / 2 + 1;

        $(".gray_tri_2").css({
            "border": gray_bord + 8 + "px solid transparent",
            "border-top": gray_bord + 8 + "px solid #fafafa",
            "border-left": gray_bord + 8 + "px solid #fafafa"
        });

        $(".tri2").css({
            "border": wl_bord - 9 + "px solid transparent",
            "border-top": wl_bord - 9 + "px solid #fff",
            "border-left": wl_bord - 9 + "px solid #fff"
        });
        var wr_bord = ( $(document).width() - gray_bord * 2 ) / 2;

        $(".tri1").css({
            "border": wr_bord - 8 + "px solid transparent",
            "border-bottom": wr_bord - 8 + "px solid #fff",
            "border-right": wr_bord - 8 + "px solid #fff"
        });

        //Исправление отступа части треугольника в шапке
        $(".tri_l_big").css("left", $(".tri2").offset().top + wl_bord * 2 - 400);
    }


    /////////////////////////////////////////////////////////////////


    // Страница болезней //
    ///////////////////////
    if ($(".open").length) {
        $(".s_cont").hide();
        var open = $(".article .open");
        $(".section .header").on('click', function () {
            $(this).children(".open").toggleClass("o_active");
            $(this).next().slideToggle();
        });
    }


    /////////////////////////////////////////////////////////////////


    // Страница контактов //
    ////////////////////////
    if ($(".cont_map").length) {
        $(".mini_top_img").addClass("cont_helper");
        var l_i = $("#ill_mini .item:last"),
            l_i_d = Math.sqrt(2) * l_i.width(),
            tri_r = $(".cont_map .tri1"),
            f = $(".footer").offset();

        var a = $(document).width() - l_i.offset().left - l_i.width() / 2 - l_i_d,
            b = f.top - l_i.offset().top + l_i.height() / 2 - Math.sqrt(2) * l_i.width() / 2;

        var h = a + b + 34; //2 - исправление бага с transform

        tri_r.css({
            "border": h / 2 + "px solid transparent",
            "border-bottom": h / 2 + "px solid #fff",
            "border-right": h / 2 + "px solid #fff"
        });

        var cont_inf_w = (Math.sqrt(2) * (h - a) ) / 3;
        var diff = Math.sqrt(2) * cont_inf_w - cont_inf_w;
        $(".cont_inf").css({
            "width": cont_inf_w,
            "height": cont_inf_w,
            "right": a + diff / 2,
            "bottom": diff / 2
        }).animate({opacity: 1}, 2000);
    }


});

function validateFields() {
    var valid = true;
    $('#login-form input[type=text]').each(function () {
        if ($(this).val() == "") {
            $(this).addClass('required')
            valid = false;
        }
    });
    if ($('#login-form textarea').val() == "") {
        valid = false;
    }
//    $('#login-form .fancy-select select').on('change', function () {
//        $(this).addClass('required');
//        var trigger  = $(this).next('.trigger');
//        if ($(trigger).html() == "---") {
//            $(trigger).addClass('required');
//        }
//        valid = false;
//    });
    return valid;
}

function v_mid(parent, children) {
    if (parent.length && children.length) {
        parent.each(function () {
            var cur_ch = $(this).find(children);
            cur_ch.css("margin-top", parent.height() / 2 - cur_ch.height() / 2);
        });
    }
}

function UploadFileByAjax() {
    $('#mf').fileupload({
        dataType: 'json',
//        acceptFileTypes: /^application\/(msword|vnd.openxmlformats|vnd.openxmlformats-officedocument.spreadsheetml.sheet|vnd.ms-excel|zip|x-rar-compressed|pdf)$/i,
        add: function (e, data) {
            console.log('ADD: ' + data.result + ' ' + data.textStatus + ' ' + data.jqXHR);

            var uploadErrors = [];
            var acceptFileTypes = /^application\/(msword|vnd.openxmlformats|vnd.openxmlformats-officedocument.spreadsheetml.sheet|vnd.ms-excel|zip|x-rar-compressed|pdf)$/i;
            if (data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                uploadErrors.push('Разрешенный к добавлению файлы с расширением: .doc, .docx, .xls, .xlsx, .pdf, .zip, .rar');
            }
//            if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
//                uploadErrors.push('Filesize is too big');
//            }
            if (uploadErrors.length > 0) {
                alert(uploadErrors.join("\n"));
            } else {

                $('#form_mf').html('<div class="MultiFile-label"><a class="MultiFile-remove" href="#mf_wrap"><img src="img/delete.png"></a> <span class="MultiFile-title" title="File selected: ' + data.originalFiles[0]['name'] + '">' + data.originalFiles[0]['name'] + '</span></div>');

                data.submit();
            }
        },
        done: function (e, data) {
            console.log('done: ' + data.result.attach + ' ' + data.textStatus + ' ' + data.jqXHR + ' ');
            $('#attached_file').val('');
            $('#attached_file').val(data.result.attach);
        },
        fail: function (e, data) {
            console.log('FAIL: ' + data.errorThrown + ' ' + data.textStatus + ' ' + data.jqXHR.abort() + ' ');
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10) / 100;
            if (progress > 0.3) {
                $('#form_mf .MultiFile-label').css(
                    'opacity',
                    progress
                );
            }

        }
    });
}