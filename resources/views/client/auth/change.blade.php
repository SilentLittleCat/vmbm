@extends('admin.layout')

@section('content')
<div class="container" style="margin-top: 50px">
    <div class="row">
        @if(isset($sg_status) && $sg_status == 'success')
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">
                    &times;
                </button>
                {{ isset($sg_info) ? $sg_info : '操作成功' }}
            </div>
        @elseif(isset($sg_status) && $sg_status == 'fail')
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">
                    &times;
                </button>
                {{ isset($sg_info) ? $sg_info : '操作失败' }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">修改密码</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('client/changePassword') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">新密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required minlength="6">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>修改密码
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
