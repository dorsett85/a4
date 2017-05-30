$(document).ready(function () {

    // Show warning on 'Add to Favorites' click
    $('.alertFade').hide();
    $('.landingFavorite').click(function (e) {
        event.preventDefault();
        $(this).siblings('.alertFade').fadeIn().delay(2000).fadeOut(1000);
    });

    // Show random Plotly chart
    $('#landingChartButton').click(function() {

        // Start spinner icon while chart loads
        $('#fa-spinner').addClass('fa fa-spinner fa-spin');

        $.get('/random', function (data) {

            // Get ajax call data
            var company = data.randomCompany['name'];
            var quandl_code = data.randomCompany['quandl_code'];

            // Get div to place chart inside
            var plotDiv = document.getElementById('plotDiv');

            // Create Quandle url
            var urlStart = 'https://www.quandl.com/api/v3/datasets/';
            var quandlCode = quandl_code;
            var column = 'column_index[]=4&';
            var apiKey = 'api_key=ZNUBmiZ3d-zMyLGBxyUt';

            // Full Quandl API url call
            var quandlUrl = urlStart + quandlCode + '/data.csv?' + column + apiKey;

            console.log(quandlUrl);

            // Plot data
            Plotly.d3.csv(quandlUrl, function (rows) {
                var trace = {
                    type: 'scatter',                    // set the chart type
                    mode: 'lines',                      // connect points with lines
                    x: rows.map(function (row) {          // set the x-data
                        return row['Date'];
                    }),
                    y: rows.map(function (row) {          // set the x-data
                        return row['Close'];
                    }),
                    line: {                             // set the width of the line.
                        width: 1
                    }
                };

                var layout = {
                    title: company,
                    yaxis: {
                        title: 'Closing Price'
                    },       // set the y axis title
                    xaxis: {
                        showgrid: false,                  // remove the x-axis grid lines
                        tickformat: "%b %Y"              // customize the date format to "month, day"
                    },
                    margin: {                           // update the left, bottom, right, top margin
                        l: 60, b: 60, r: 60, t: 60
                    }
                };

                Plotly.newPlot(plotDiv, [trace], layout, {showLink: false});

                // Stop spinner after chart loads
                $('#fa-spinner').removeClass('fa fa-spinner fa-spin');

            });
        });
    });


});

