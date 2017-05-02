@extends('master')

@section('title')
    Select Data
@endsection

@section('body')

    <h1 id="dataHead">
        Select data for {{ $company['company'] }}
    </h1>

    <form id="plotform">

        <div class="form-group">
            <label for="transform"></label>
            <select id="transform" class="form-control">
                <option value="none">Closing Price</option>
                <option value="diff" selected>Change in Closing Price</option>
                <option value="rdiff">Percent Change in Closing Price</option>
                <option value="cumul">Cumulative Closing Price</option>
            </select>
        </div>

        <div class="form-group">
            <label for="startDate">Start Date</label>
            <input type="date" name="startDate" id="startDate" class="form-control" value="">
        </div>

        <div class="form-group">
            <label for="endDate">End Date</label>
            <input type="date" name="endDate" id="endDate" class="form-control" value="">
        </div>

        <div class="form-check">
            <label class="form-check">
                <input type="radio" name="collapse" class=custom-control-input" value="daily" checked>
                Daily
            </label>
        </div>

        <div class="form-check">
            <label class="form-check">
                <input type="radio" name="collapse" class=custom-control-input" value="weekly">
                Weekly
            </label>
        </div>

        <div class="form-check">
            <label class="form-check">
                <input type="radio" name="collapse" class=custom-control-input" value="monthly">
                Monthly
            </label>
        </div>

        <div class="form-check">
            <label class="form-check">
                <input type="radio" name="collapse" class=custom-control-input" value="quarterly">
                Quarterly
            </label>
        </div>

        <div class="form-check">
            <label class="form-check">
                <input type="radio" name="collapse" class=custom-control-input" value="annual">
                Annual
            </label>
        </div>

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