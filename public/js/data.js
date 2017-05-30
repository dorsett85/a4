$(document).ready(function () {

    // Add Plotly chart
    $('#plotBtn').click(function (e) {
        event.preventDefault();

        // Start spinner icon while chart loads
        $('#fa-spinner').addClass('fa fa-spinner fa-spin');

        // Get div to place chart inside
        var plotDiv = document.getElementById('plotDiv');

        // Create Quandle url query based on user input
        var urlStart = 'https://www.quandl.com/api/v3/datasets/';
        var quandlCode = $('#quandlCode').val();
        var column = 'column_index[]=4&';
        var transform = 'transform=' + $('#transform').val() + '&';
        var collapse = 'collapse=' + $('#collapse').val() + '&';
        var apiKey = 'api_key=ZNUBmiZ3d-zMyLGBxyUt';

        // Full Quandl API url call
        var quandlUrl = urlStart + quandlCode + '/data.csv?' + column + transform + collapse + apiKey;

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
                title: $('#company').val(),
                yaxis: {
                    title: $('#transform option:selected').text()
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

            // Show tags after chart loads
            $('#tagDiv').show();

            // Stop spinner after chart loads
            $('#fa-spinner').removeClass('fa fa-spinner fa-spin');
        });

    });


});

