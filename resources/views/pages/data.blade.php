@extends('master')

@section('title')
    Select Data
@endsection

@section('pageStyle')
    <!-- JQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Page specific css -->
    <link rel="stylesheet" href="css/dropdowns-enhancement.css">
@endsection

@section('body')

    <h1 id="dataHead">
        Create chart for {{ $company->company_name }}
    </h1>

    <form id="plotform">

        <div class="form-group col-sm-7">
            <label for="transform">Data Type</label>
            <select id="transform" class="form-control">
                <option value="none">Closing Price</option>
                <option value="diff">Change Closing Price</option>
                <option value="rdiff">% Change Closing Price</option>
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
            <input type="text" id="startDate" class="form-control"
                   placeholder="Leave blank for earliest available data">
        </div>

        <div class="form-group col-sm-6">
            <label for="endDate">End Date</label>
            <input type="text" id="endDate" class="form-control" placeholder="Today">
        </div>

        <div class="btn-group btn-group-justified">
            <div class="btn-group">
                <button id="plotBtn" class="btn btn-info">
                    New Interactive Chart <i id="fa-spinner"></i>
                </button>
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

    <div id="tagDiv">
        <h3>
            Add tags
        </h3>

        <form action="/tags" method="post">
            {{ csrf_field() }}

            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" data-placeholder="Add Tags">
                        Add Tags<span class="caret"></span></button>
                    <ul class="dropdown-menu pull-top">
                        @foreach($tagsForCheckboxes as $index => $tag)
                            <li><input type="checkbox" id="{{ $tag }}" name="tags[]" class="form-check-input"
                                       value="{{ $index }}"
                                        {{ (in_array($tag, $tagsForThisCompany)) ? 'CHECKED' : '' }}><label
                                        for="{{ $tag}}">{{ $tag }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="btn-group">
                    <input type="hidden" name="ticker" value="{{ $company->ticker }}">
                    <button type="submit" class="btn btn-success" name="id" value="{{ $company->id }}">Submit
                        tags (*this will
                        reset your plot)
                    </button>
                </div>
            </div>

        </form>

    </div>


@endsection

@section('pageScript')
    <!-- JQuery UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Plotly -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <!-- local js -->
    <script src="js/dropdowns-enhancement.js"></script>
    <script src="js/data.js"></script>
@endsection