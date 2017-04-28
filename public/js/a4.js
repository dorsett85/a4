$(document).ready(function() {

    // Set active navigation li
    var activeTab = $("#sidebar ul li a[href='" + window.location.pathname + "']").parent();
    activeTab.addClass('active');

    // Toggle company description
    $('.infoButton').click(function(e) {
        event.preventDefault();
        $(this).parent().siblings('.shortDescription').toggle('slow');
    })

    // Plotly chart
    $('#plotData').click(function() {
        TESTER = document.getElementById('tester');



        var quandlUrl = 'https://www.quandl.com/api/v3/datasets/GOOG/NASDAQ_AEGN/data.csv?column_index[]=4&api_key=ZNUBmiZ3d-zMyLGBxyUt';

        // https://raw.githubusercontent.com/plotly/datasets/master/wind_speed_laurel_nebraska.csv

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

            Plotly.plot(document.getElementById('tester'), [trace], layout, {showLink: false});
        });
    })

})