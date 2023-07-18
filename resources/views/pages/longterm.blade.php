@extends('layouts.app')

@section('headTitle', 'longterm')
@section('pageName', 'longterm')

@section('content')
    <target-page></target-page>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('niceadmin/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
@endsection
