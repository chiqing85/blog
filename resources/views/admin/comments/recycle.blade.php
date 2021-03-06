@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>留言管理<i class="material-icons">&#xe315;</i> <a data-pjax href="{{ url('/admin/comments/') }}"> 留言列表 </a><i class="material-icons">&#xe315;</i> 评论回收</h3>
            </div>
            <div class="row p-a">
                <div class="add col-sm-5">
                    <a data-url="{{ url('/admin/comments/rledel') }}" class="btn btn-icon btn-social btn-social-colored btn-danger deletec">
                        <i class="fa fa-trash-o"></i>
                        <i class="create_i">删除</i>
                    </a>
                    <a data-pjax href="{{ url('/admin/comments/empty') }}" class="btn btn-icon btn-social btn-social-colored warn">
                        <i class="fa fa-flask"></i>
                        <i class="create_i">清空</i>
                    </a>
                </div>
                <div class="col-sm-4"> </div>
                <div class="col-sm-3">
                    <div class="pull-right">
                        <a data-pjax href="{{ url('/admin/comments/') }}">
                            <i class="fa fa-reply"></i>
                            &nbsp;返回
                        </a>
                    </span>
                    </div>
                </div>
            </div>
            <table class="table table-bordered m-0">
                <thead>
                <tr>
                    <th width="35">
                        <label class="md-check active">
                            <input type="checkbox" class="has-value" id="ACheck">
                            <i class="blue"></i>
                        </label>
                    </th>
                    <th> ID </th>
                    <th>文章</th>
                    <th>评论内容</th>
                    <th>昵称</th>
                    <th>邮箱</th>
                    <th>IP</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @if( empty($comment) )
                    <td colspan="9" class="text-center">
                        没有查询到相关信息
                    </td>
                @else
                    @foreach($comment as $key => $v)
                        @if( $key%2 == 0)
                            <tr>
                        @else
                            <tr class="footable-odd">
                                @endif
                                <td>
                                    <label class="md-check active">
                                        <input type="checkbox" class="has-value checkbox_all" value="{{ $v->id }}" name="id[]">
                                        <i class="blue"></i>
                                    </label>
                                </td>
                                <td> {{ $v->id }}</td>
                                <td>{{ $v->article->title }}</td>
                                <td> {{ $v->contents }}</td>
                                <td>{{  $v->name ? $v->name : 'NULL' }} </td>
                                <td>
                                    {{ $v->email }}
                                </td>
                                <td> {{ $v->ip }}</td>
                                <td>{{ $v->created_at }}</td>
                                <td data-value="1">
                                    <a data-pjax href="{{ url("admin/comments/rledel/$v->id") }}" class="btn btn-danger btn-icon btn-social btn-sm action-delete"><i class="fa fa-trash-o"></i><i class="create_i"> 删除 </i></a>
                                    <a data-pjax href="{{ url("admin/comments/rleupd/$v->id") }}" class="btn btn-icon btn-social btn-sm white"><i class="fa fa-share"></i><i class="create_i"> 恢复 </i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                </tbody>
                <tfoot class="hide-if-no-paging">
                <tr>
                    <td colspan="10" class="text-center">
                        {{ $comment->links() }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection