$(document).ready(function() {

    // Plotly chart
    $('#plotData').click(function() {
        var plotDiv = document.getElementById('plotDiv');

        // Create Quandle url query based on user input
        var quandlCode = $('input').attr('id');
        var quandlUrl = 'https://www.quandl.com/api/v3/datasets/' + quandlCode + '/data.csv?column_index[]=4&api_key=ZNUBmiZ3d-zMyLGBxyUt';

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
                yaxis: {title: ""},       // set the y axis title
                xaxis: {
                    showgrid: false,                  // remove the x-axis grid lines
                    tickformat: "%B, %Y"              // customize the date format to "month, day"
                },
                margin: {                           // update the left, bottom, right, top margin
                    l: 40, b: 40, r: 40, t: 20
                }
            };

            Plotly.plot(plotDiv, [trace], layout, {showLink: false});
        });
    })

});

