@extends('master')

@section('title')
    Select Data
@endsection

@section('body')

    <h3>
        Select data for {{ $company['company'] }}
    </h3>

    <button id="plotData" class="btn btn-success">Plot Data</button>

    <div id="plotDiv" style="width:90%;height:250px;"></div>
    <input type="hidden" id="{{ $company['ticker'] }}">
@endsection

@section('pageScript')
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="js/data.js"></script>
@endsection