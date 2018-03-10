@extends('admin.layout')

@section('header')
    <style type="text/css">
        .sg-centered {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                @if(isset($errors) && !$errors->isEmpty())
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            &times;
                        </button>
                        @foreach($errors->keys() as $key)
                            {{ $errors->first($key) }}
                        @endforeach
                    </div>
                @endif

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>更新客户密码</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"> <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" role="form" method="POST" action="{{ U('Client/updatePassword') }}">
                            {{ csrf_field() }}

                            <input class="form-control" type="hidden" name="id" value="{{ $item->id }}">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-offset-2 control-label">密码</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="password" value="" placeholder="请输入新的客户密码" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(function() {

        });
    </script>
@endsection