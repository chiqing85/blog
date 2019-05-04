<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Flatkit - HTML Version | Bootstrap 4 Web App Kit with AngularJS</title>
    <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- style -->
    <link rel="stylesheet" href="/static/admin/animate.css/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="/static/admin/glyphicons/glyphicons.css" type="text/css" />
    <link rel="stylesheet" href="/static/admin/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/static/admin/material-design-icons/material-design-icons.css" type="text/css" />

    <link rel="stylesheet" href="/static/admin/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <!-- build:css /static/admin/styles/app.min.css -->
    <link rel="stylesheet" href="/static/admin/styles/app.css" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="/static/admin/styles/font.css" type="text/css" />
</head>
<body>
<div class="app" id="app">
    @include('admin.layouts.aside')
    <div id="content" class="app-content box-shadow-z0" role="main">
        @include('admin.layouts.header')
        @include('admin.layouts.footer')
        <div ui-view class="app-body" id="view">
           @yield('content')
           @include('admin.layouts.error')
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="/static/admin/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
<script src="/static/admin/jquery/tether/dist/js/tether.min.js"></script>
<script src="/static/admin/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
<script src="/static/admin/jquery/underscore/underscore-min.js"></script>
<script src="/static/admin/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="/static/admin/jquery/PACE/pace.min.js"></script>
<script src="/static/layer/layer.js"></script>
<script src="/static/admin/scripts/config.lazyload.js"></script>

<script src="/static/admin/scripts/palette.js"></script>
<script src="/static/admin/scripts/ui-load.js"></script>
<script src="/static/admin/scripts/ui-jp.js"></script>
<script src="/static/admin/scripts/ui-include.js"></script>
<script src="/static/admin/scripts/ui-device.js"></script>
<script src="/static/admin/scripts/ui-form.js"></script>
<script src="/static/admin/scripts/ui-nav.js"></script>
<script src="/static/admin/scripts/ui-screenfull.js"></script>
<script src="/static/admin/scripts/ui-scroll-to.js"></script>
<script src="/static/admin/scripts/ui-toggle-class.js"></script>

<script src="/static/admin/scripts/app.js"></script>
<!-- ajax -->
<script src="/static/admin/jquery/jquery-pjax/jquery.pjax.js"></script>
<script src="/static/admin/scripts/ajax.js"></script>
<!-- editor -->
<script src="/static/editor/editormd.js"></script>
<script>
    $(document).on('click', '.aclass-open', function () {
        var oid = $(this).attr('oid');
        if($(this).text() == ' ') {
            $(this).text(' ');
            $('.pid_'+ oid).show();
        } else {
            $(this).text(' ');
            var open = $(".pid_"+oid + ' .aclass-open');
            var coid = open.attr('oid');
            if(open.text() == " ") {
                open.text(' ');
            }
            $('.pid_'+ coid).hide();
            $('.pid_'+ oid).hide();
        }
    });

    $(document).on('click', '.file-users', function () {
        // if( $("input.file-upload").is('.users') ) url = '/admin/upload/thumb';
        layer.open({
            type: 2,
            title: '<i class="fa fa-crop"></i> 用户头像',
            area: ['870px', '600px'],
            fixed: true, //涓嶅浐瀹�
            content: '/static/admin/cropper/index.html'
        });
        return false;

    })

    $(document).on('change', "input.file-upload", ()=> {
        var formData = new FormData();
        formData.append('images', $("input.file-upload")[0].files[0]);
        let url = '';
        if( $("input.file-upload").is('.config') ) url = '/admin/upload/image';
        if( $("input.file-upload").is('.article') ) {
            url = '/admin/upload/thumb';
            formData.append('size', 750);
        }
        $.ajax({
            url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            // 鍛婅瘔jQuery涓嶈鍘诲鐞嗗彂閫佺殑鏁版嵁
            processData : false,
            // 鍛婅瘔jQuery涓嶈鍘昏缃瓹ontent-Type璇锋眰澶�
            contentType : false,
            success: function (v) {
                $('input.file_img').val( v );
                $('.upload_img').show().attr('src', v);
            }
        });
    })

    function keys( e ) {
        let k = $('input.keywords');
        let kt = $('input.keywords-tag');
        if( e.keyCode == 13 ) {
            e.preventDefault();
            let t = '<span class="tag accent"><span>' + k.val() + '&nbsp;&nbsp;</span><a href="javascript:;" title="Removing tag">x</a></span>';
            if( $('span.tag.accent').length < 3) {
                let ktv = kt.val() + k.val() + ',';
                kt.val( ktv );
            } else {
                if($('ul.parsley-errors-list').length < 1) {
                    k.addClass('parsley-error');
                    let it = '<ul class="parsley-errors-list filled" id="parsley-id-4"><li class="parsley-required">关键词最多添加 3 条…</li></ul>';
                    k.parent('.form-item-content').append( it );
                }
                t = '';
            }
            $('.keywords').val('');
            $('.form-item-content.tag').append( t );
        } else {
            if( k.is('.parsley-error') ) {
                k.removeClass('parsley-error');
                k.parent('.form-item-content').find('.parsley-errors-list.filled').remove();
            }
        }
    }

    $(document).on('click', 'span.tag.accent>a', function() {
        let t = $(this).siblings('span');
        let k = $('input.keywords-tag');
        let str = k.val().replace($.trim( t.text() ) + ',', "");
        k.val( str );
       $(this).parent('span.tag.accent').remove();
       let ik = $('input.keywords');
       if(  ik.is('.parsley-error')) {
           ik.removeClass('parsley-error');
           ik.parent('.form-item-content').find('.parsley-errors-list.filled').remove();
       }
    })

    $(document).on('click', '.edit', function () {
        let data = eval( "("+ $(this).attr('data-value') +")" );
        let url = $(this).attr('data-url');
        pj( data, url)
    })
    $(document).on('change', '.change',function () {
        let data = eval( "("+ $(this).attr('data-value') +")" );
        let url = $(this).attr('data-url');
        pj(data, url);
    })

    // 局部刷新
    function pj( data, url ) {
        $.ajax({
            url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data,
            success: function ( req ) {
                if(req.code == 403 ){
                    layer.msg( req.msg, { icon: 2, time: 1000 })
                    return false;
                }
                req = JSON.parse( req );
                if( req.code == 1 ) {
                    layer.msg( req.message,{ icon: 1, time: 1500}, (index) => {
                        layer.close(index);
                        $('#view').load(req.url+ ' #view' )
                    } );
                }else if(req.code == 403 ){
                    layer.msg( req.msg, { icon: 2, time: 1000 })
                } else {
                    layer.msg( req.message, { icon: 2, time: 1000 })
                }
            }
        });
    }
    
    //
    $(document).on('click', '#ACheck', function () {
        var flage = $(this).is(':checked');
        $('.checkbox_all').each(function () {
            $(this).prop('checked', flage);
        })
    })
    $(document).on('click', '.deletec', function () {
        let all = $('input.checkbox_all');
        let data = Array();
        all.each( function() {
            if($(this).is(':checked'))  data.push( $(this).val());
        });
        pj({ id : data }, $(this).attr('data-url'))
    })
</script>
</body>
</html>
