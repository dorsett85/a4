$(document).ready(function() {

    // Plotly chart
    $('#plotBtn').click(function(e) {
        event.preventDefault();

        var plotDiv = document.getElementById('plotDiv');

        // Create Quandle url query based on user input
        var urlStart = 'https://www.quandl.com/api/v3/datasets/';
        var quandlCode = $('#quandlCode').attr('value');
        var column = 'column_index[]=4&';
        var transform = 'transform=' + $('#transform').attr('value') + '&';
        var startDate = 'start_date=' + $('#startDate').attr('value') + '&';
        var endDate = 'end_date=' + $('#endDate').attr('value') + '&';
        var collapse = 'collapse=' + $('#collapse').attr('value') + '&';
        var apiKey = 'api_key=ZNUBmiZ3d-zMyLGBxyUt';


        var quandlUrl =  urlStart + quandlCode + '/data.csv?' + transform + column + startDate + endDate + collapse + apiKey;
        console.log(quandlUrl);

        Plotly.d3.csv(quandlUrl, function(rows){
            var trace = {
                type: 'scatter',                    // set the chart type
                mode: 'lines',                      // connect points with lines
                x: rows.map(function(row){          // set the x-data
                    return row['Date'];
                }),
                y: rows.map(function(row){          // set the x-data
                    return row['Close'];
                }),
                line: {                             // set the width of the line.
                    width: 1
                },
            };

            var layout = {
                title: $('#company').attr('value'),
                yaxis: {title: "Closing Price"},       // set the y axis title
                xaxis: {
                    showgrid: false,                  // remove the x-axis grid lines
                    tickformat: "%B, %Y"              // customize the date format to "month, day"
                },
                margin: {                           // update the left, bottom, right, top margin
                    l: 40, b: 40, r: 40, t: 40
                }
            };

            Plotly.plot(plotDiv, [trace], layout, {showLink: false});
        });
    })

});

