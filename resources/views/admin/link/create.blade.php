@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>系统 <i class="material-icons">&#xe315;</i><a data-pjax href="{{ url('/admin/links/') }}"> 友情链接 </a><i class="material-icons">&#xe315;</i> 添加</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form" method="post" action="{{ url('admin/links/create') }}">
                    @csrf
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="form-group">
                                    <label>友链名称</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required name="link_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>友链链接</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required name="link_url">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>站长 Email</label>
                                    <div class="form-item-content">
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <div class="form-item-content">
                                        <div class="ivu-upload" style="display: inline-block; width: 58px; border-radius: 100%;">
                                            <div class="ivu-upload ivu-upload-drag">
                                                <input type="hidden" class="form-control file_img" name="logo">
                                                <input type="file" class="file-invisible file-upload article" accept="image/jpg,image/jpeg,image/png">
                                                <div style="width: 58px; height: 58px; line-height: 58px;">
                                                    <img src="" class="upload_img" style="display: none">
                                                    <i class="material-icons" style="line-height: 58px;">&#xe412;</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>排序</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" value="100" name="sorts">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>状态</label>
                                    <div class="form-item-content">
                                        <label class="ui-switch m-t-xs m-r">
                                            <input type="checkbox" checked value="1" class="has-value" name="status">
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <div class="form-item-content">
                                        <button type="submit" class="btn info">提交</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection