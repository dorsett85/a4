@extends('master')

@section('title')
    Select Data
@endsection

@section('pageStyle')
    <!-- Page specific css -->
    <link rel="stylesheet" href="/css/dropdowns-enhancement.css">
@endsection

@section('body')

    <h1 id="dataHead">
        Create Chart for {{ $company->company_name }}
    </h1>

    <form id="plotform">

        <div class="form-group col-sm-6">
            <label for="transform">Data Type</label>
            <select id="transform" class="form-control">
                <option value="none">Closing Price</option>
                <option value="diff">Change Closing Price</option>
                <option value="rdiff">% Change Closing Price</option>
                <option value="cumul">Cumulative Closing Price</option>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label for="collapse">Interval</label>
            <select id="collapse" class="form-control">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="annual">Annual</option>
            </select>
        </div>

        <div class="text-center">
            <button id="plotBtn" class="btn btn-primary">
                Create Interactive Chart <i class="fa fa-line-chart" aria-hidden="true"></i> <i id="fa-spinner"></i>
            </button>
        </div>

        <input type="hidden" id="company" value="{{ $company->company_name }}">
        <input type="hidden" id="quandlCode" value="{{ $quandlCode }}">

    </form>

    <div id="plotDiv">
        <!-- Plotly chart will go here on button click -->
    </div>

    <div id="tagDiv">
        <h3>
            Add/Remove Tags
        </h3>

        <form action="/tags" method="post">
            {{ csrf_field() }}

            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"
                            data-placeholder="Add/Remove Tags">
                        Add/Remove Tags <i class="fa fa-tags" aria-hidden="true"></i>
                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu pull-top">
                        @foreach($tagsForCheckboxes as $index => $tag)
                            <li><input type="checkbox" id="{{ (($tag == 'bo derek') ? 'boDerek' : $tag) }}"
                                       name="tags[]" class="form-check-input"
                                       value="{{ $index }}"
                                        {{ (in_array($tag, $tagsForThisCompany)) ? 'CHECKED' : '' }}><label
                                        for="{{ (($tag == 'bo derek') ? 'boDerek' : $tag) }}">{{ $tag }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="btn-group">
                    <input type="hidden" name="ticker" value="{{ $company->ticker }}">
                    <button type="submit" class="btn btn-success" name="id" value="{{ $company->id }}">
                        Submit Tags (*this will reset your plot) <i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>


@endsection

@section('pageScript')
    <!-- Plotly -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <!-- local js -->
    <script src="/js/dropdowns-enhancement.js"></script>
    <script src="/js/data.js"></script>
@endsection