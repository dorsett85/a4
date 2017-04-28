@extends('master')

@section('title')
    Select Data
@endsection

@section('body')

    <div>
        What type of data would you like from {{ $company['company'] }}?
    </div>
    <button id="plotData" class="btn btn-success">Plot Data</button>

    <div id="tester" style="width:90%;height:250px;"></div>
    <input type="hidden" id="{{ $company['ticker'] }}">
@endsection

@section('pageScript')
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
@endsection