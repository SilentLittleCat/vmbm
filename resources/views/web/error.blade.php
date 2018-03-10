@extends('web.layout')

@section('header')

@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 20px;" id="buy-btn">
            <div class="logo col-sm-6 col-sm-offset-3">
                <div class="logo col-sm-6 col-sm-offset-3" align="center">
                    @if(isset($type) && $type == 'success')
                        <i class="fa fa-check-circle" style="font-size: 10em; color: #3fa55e;"></i>
                    @else
                        <i class="fa fa-times-circle" style="font-size: 10em; color: #a52e32;"></i>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="logo col-sm-6 col-sm-offset-3">
                <div style="text-align: center; margin-top: 20px; margin-bottom: 20px"><b>{{ isset($info) ? $info : '' }}</b></div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">

    </script>
@endsection