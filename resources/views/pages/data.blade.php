@extends('master')

@section('title')
    Select Data
@endsection

@section('pageStyle')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@endsection

@section('body')

    <h1 id="dataHead">
        Select data for {{ $company->company_name }}
    </h1>

    <form id="plotform">

        <div class="form-group col-sm-7">
            <label for="transform">Data Type</label>
            <select id="transform" class="form-control">
                <option value="none">Closing Price</option>
                <option value="diff">Change, Closing Price</option>
                <option value="rdiff">% Change, Closing Price</option>
                <option value="cumul">Cumulative, Closing Price</option>
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
            <input type="text" id="startDate" class="form-control"
                   placeholder="Leave blank for earliest available data">
        </div>

        <div class="form-group col-sm-6">
            <label for="endDate">End Date</label>
            <input type="text" id="endDate" class="form-control" placeholder="Today">
        </div>

        <div class="btn-group btn-group-justified">
            <div class="btn-group">
                <button id="plotBtn" class="btn btn-info">New Chart/Add Layer</button>
            </div>
            <div class="btn-group">
                <button id="resetBtn" class="btn btn-danger">Start Over</button>
            </div>
        </div>


        <input type="hidden" id="company" value="{{ $company->company_name }}">
        <input type="hidden" id="quandlCode" value="{{ $quandlCode }}">

    </form>

    <div id="plotDiv">
        <!-- Plotly chart will go here on button click -->
    </div>

    <h3 id="tagsHeader">
        Add tags
    </h3>

    <form action="/tags" method="post">
        {{ csrf_field() }}

        <div class="flexCenter">
            <div class="">
                @foreach($tagsForCheckboxes as $index => $tag)
                    @if($index < 8)
                        <div id="leftCheckboxes" class="form-check">
                            <label for="{{ $tag }}" class="form-check-label">
                                <input type="checkbox" name="tags[]" class="form-check-input" value="{{ $index }}"
                                        {{ (in_array($tag, $tagsForThisCompany)) ? 'CHECKED' : '' }}>
                                {{ $tag }}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="">
                @foreach($tagsForCheckboxes as $index => $tag)
                    @if($index >= 8)
                        <div id="rightCheckboxes" class="form-check">
                            <label for="{{ $tag }}" class="form-check-label">
                                <input type="checkbox" name="tags[]" class="form-check-input" value="{{ $index }}"
                                        {{ in_array($tag, $tagsForThisCompany) ? 'CHECKED' : '' }}>
                                {{ $tag }}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="flexCenter">
            <input type="hidden" name="ticker" value="{{ $company->ticker }}">
            <button type="submit" class="btn btn-success col-sm-6" name="id" value="{{ $company->id }}">Submit
                tags (*this will
                reset your plot)
            </button>
        </div>


    </form>

@endsection

@section('pageScript')
    <!-- JQuery UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>

    <!-- Plotly -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <!-- Page specific js -->
    <script src="js/data.js"></script>
@endsection