@extends('master')

@section('title')
    Select Data
@endsection

@section('pageStyle')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('body')

    <h1 id="dataHead">
        Select data for {{ $company['company'] }}
    </h1>

    <form id="plotform">

        <div class="form-group col-sm-7">
            <label for="transform">Data Type</label>
            <select id="transform" class="form-control">
                <option value="none">Closing Price</option>
                <option value="diff">Change in Closing Price</option>
                <option value="rdiff">Percent Change in Closing Price</option>
                <option value="cumul">Cumulative Closing Price</option>
            </select>
        </div>

        <div class="form-group col-sm-5">
            <label for="collapse">Interval</label>
            <select id="collapse" class="form-control">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="annual">Annual</option>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label for="startDate">Start Date</label>
            <input type="text" id="startDate" class="form-control" placeholder="Earliest available data">
        </div>

        <div class="form-group col-sm-6">
            <label for="endDate">End Date</label>
            <input type="text" id="endDate" class="form-control" placeholder="Today">
        </div>

        <button id="plotBtn" class="btn btn-success">Plot Data</button>

        <input type="hidden" id="company" value="{{ $company['company'] }}">
        <input type="hidden" id="quandlCode" value="{{ $company['quandlCode'] }}">

    </form>

    <div id="plotDiv"></div>

@endsection

@section('pageScript')
    <!-- JQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>

    <!-- Plotly -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <!-- Page specific js -->
    <script src="js/data.js"></script>
@endsection