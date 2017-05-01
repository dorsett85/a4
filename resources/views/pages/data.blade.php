@extends('master')

@section('title')
    Select Data
@endsection

@section('body')

    <h1 id="dataHead">
        Select data for {{ $company['company'] }}
    </h1>

    <form id="plotform">

        <input type="date" id="startDate">
        <input type="date" id="endDate">

        <input type="radio" name="collapse" value="none">
        <input type="radio" name="collapse" value="daily">
        <input type="radio" name="collapse" value="weekly">
        <input type="radio" name="collapse" value="monthly">
        <input type="radio" name="collapse" value="quarterly">
        <input type="radio" name="collapse" value="annual">






        <select>
            <option>Closing Price</option>
            <option>Percent Change Closing Price</option>
        </select>

        <button id="plotBtn" class="btn btn-success">Plot Data</button>

        <input type="hidden" id="company" value="{{ $company['company'] }}">
        <input type="hidden" id="quandlCode" value="{{ $company['quandlCode'] }}">

    </form>

    <div id="plotDiv"></div>

@endsection

@section('pageScript')
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="js/data.js"></script>
@endsection