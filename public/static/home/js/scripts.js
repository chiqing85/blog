$(window).on("load", function() {
    var b = $(".preloader");
    var a = $(".lines-grid");
    b.find(".spinner").fadeOut(function() {
        b.fadeOut();
        a.addClass("loaded")
    })
});
$(function() {
    var f = $(window).width();
    var b = $(window).height();
    $(".typed-title").typed({
        stringsElement: $(".typing-title"),
        backDelay: 5000,
        typeSpeed: 0,
        loop: true
    });
    $(".header").on("click", ".menu-btn", function() {
        if ($(".header").hasClass("opened")) {
            $(".header").removeClass("opened")
        } else {
            $(".header").addClass("opened")
        }
    });
    if ($("#home-card").length) {
        $(".top-menu").on("click", "a", function() {
            var j = $(".lines-grid");
            var i = $(this).attr("href");
            var h = $(".card-inner");
            var g = $(i);
            var l = $(".top-menu li");
            var k = $(this).closest("li");
            var u = $(this).attr('data-url');
            if (!k.hasClass("active") & $("#home-card").length) {
                l.removeClass("active");
                j.removeClass("loaded");
                k.addClass("active");
                setTimeout(function() {
                    j.addClass("loaded");
                    $(h).removeClass("active");
                    $(g).addClass("active")
                    if( u ) card( u );
                    $('.lines-grid .row .col .lines').width( 0 );
                }, 1000)
            }
            return false
        })
    }

    $(document).on('click', 'a.contents', function() {
        var j = $(".lines-grid");
        var h = $(".card-inner");
        var l = $(".top-menu li");
        var k = $(this).closest("li");
        var u = $(this).attr('data-url');
        if (!k.hasClass("active") & $("#home-card").length) {
            l.removeClass("active");
            j.removeClass("loaded");
            k.addClass("active");
            setTimeout(function() {
                j.addClass("loaded");
                $(h).removeClass("active");
                if( u ) {
                    $('#card').load(u + ' .card-container',function () {
                        view();
                    }).addClass('active');
                };
            }, 1000)
        }

        return false

    })
    if ($("#video-bg").length) {
        var c = $("#video-bg").YTPlayer()
    }
    var a = $(".grid-items");
    a.imagesLoaded(function() {
        a.multipleFilterMasonry({
            itemSelector: ".grid-item",
            filtersGroupSelector: ".filter-button-group",
            percentPosition: true,
            gutter: 0
        })
    });
    $(".filter-button-group").on("change", 'input[type="radio"]', function() {
        if ($(this).is(":checked")) {
            $(".f_btn").removeClass("active");
            $(this).closest(".f_btn").addClass("active")
        }
        $(".has-popup-image").magnificPopup({
            type: "image",
            closeOnContentClick: true,
            mainClass: "popup-box",
            image: {
                verticalFit: true
            }
        });
        $(".has-popup-video").magnificPopup({
            disableOn: 700,
            type: "iframe",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            disableOn: 0,
            mainClass: "popup-box"
        });
        $(".has-popup-music").magnificPopup({
            disableOn: 700,
            type: "iframe",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            disableOn: 0,
            mainClass: "popup-box"
        });
        $(".has-popup-media").magnificPopup({
            type: "inline",
            overflowY: "auto",
            closeBtnInside: true,
            mainClass: "popup-box-inline"
        })
    });
    $(".has-popup-image").magnificPopup({
        type: "image",
        closeOnContentClick: true,
        mainClass: "popup-box",
        image: {
            verticalFit: true
        }
    });
    $(".has-popup-video").magnificPopup({
        disableOn: 700,
        type: "iframe",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        disableOn: 0,
        mainClass: "popup-box"
    });
    $(".has-popup-music").magnificPopup({
        disableOn: 700,
        type: "iframe",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        disableOn: 0,
        mainClass: "popup-box"
    });
    $(".has-popup-media").magnificPopup({
        type: "inline",
        overflowY: "auto",
        closeBtnInside: true,
        mainClass: "popup-box-inline",
        callbacks: {
            open: function() {
                $(".popup-box-inline .popup-box").slimScroll({
                    height: b + "px"
                })
            }
        }
    });
    $("#cform").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true
            },
            message: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            hiddenRecaptcha: {
                required: function() {
                    if (grecaptcha.getResponse() == "") {
                        return true
                    } else {
                        return false
                    }
                }
            }
        },
        success: "valid",
        submitHandler: function() {
            $.ajax({
                url: "mailer/feedback.php",
                type: "post",
                dataType: "json",
                data: "name=" + $("#cform").find('input[name="name"]').val() + "&email=" + $("#cform").find('input[name="email"]').val() + "&message=" + $("#cform").find('textarea[name="message"]').val(),
                beforeSend: function() {},
                complete: function() {},
                success: function(g) {
                    $("#cform").fadeOut();
                    $(".alert-success").delay(1000).fadeIn()
                }
            })
        }
    });
    $("#comment_form").validate({
        rules: {
            name: {
                required: true
            },
            message: {
                required: true
            }
        },
        success: "valid",
        submitHandler: function() {}
    });
    if ($("#map").length) {
        initMap()
    }
    if (($(".blogs-content").height() > $(".blogs-sidebar").height()) && (f > 1023)) {
        $(".blogs-sidebar").css({
            "min-height": $(".blogs-content").height()
        })
    }
    if (($(".blogs-content").height() < $(".blogs-sidebar").height()) && (f > 1023)) {
        $(".blogs-content").css({
            "min-height": $(".blogs-sidebar").height()
        })
    }
    $(window).resize(function() {
        var g = $(window).width();
        if (($(".blogs-content").height() > $(".blogs-sidebar").height()) && (g > 1023)) {
            $(".blogs-sidebar").css({
                "min-height": $(".blogs-content").height()
            })
        }
        if (($(".blogs-content").height() < $(".blogs-sidebar").height()) && (g > 1023)) {
            $(".blogs-content").css({
                "min-height": $(".blogs-sidebar").height()
            })
        }
    });
    $(".top-menu").on("click", "a", function() {
        if (!$("#home-card").length) {
            location.href = "/" + $(this).attr("href")
        }
        return false
    });
    var e = location.hash;
    var d = $(e);
    if (e.indexOf("#") == 0 && e.indexOf("-card") != -1 && d.length) {
        $(".top-menu li").removeClass("active");
        $('.top-menu a[href="' + e + '"]').parent().addClass("active");
        $(".lines-grid").removeClass("loaded");
        $(".card-inner").removeClass("active");
        $(e).addClass("active")
    }
    function view() {
        if($('#testeditormdview')) {
            editormd.markdownToHTML("testeditormdview",
                {
                    htmlDecode: "style,script,iframe", //可以过滤标签解码
                    emoji: true,
                    taskList: true,
                    tex: true,               // 默认不解析
                    flowChart: true,         // 默认不解析
                    sequenceDiagram: true, // 默认不解析
                    codeFold: true
                });
        }
        return false
    }
    function  card ( url ) {
        $('#card').load(url + ' .card-container').addClass('active');
    }
    $(document).on('click', '.article_button', function () {
        let form = $('#cform');
        if( ! $( 'textarea').val())
        {
            $( 'textarea').addClass('error');
            return false;
        }
        $.ajax({
            url: form.attr('data-action'),
            data:  form.serialize(),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function ( req ) {
                console.log( req );
            }

        } )
    })
    $(document).on("input propertychange",".error",function(){
        if( $( 'textarea').val()) {
            $( 'textarea').removeClass('error');
        }
    });

    $(document).on('click', '.commentshare', function () {
        let id = $(this).attr('data-id');
        let username = $(this).closest('.resume-item').find('.name').text();
        let html = '<input type="hidden" name="cid" value="' + id + '" class="comentsharecid">';
        if( $('input').is('.comentsharecid')) {
            $('.comentsharecid').remove();
        }
        $('#cform>.align-right').append( html );
        $('textarea[name=contents]').val('@' +  username + ' ').focus();
    })

    $(document).on('click', 'a.page-link', function () {
        $('#card').load( $(this).attr('href') + ' .card-container').addClass('active');
        return false
    })
});