$(document).ready(function() {

    var date = new Date();
    var plotDiv = document.getElementById('plotDiv');

    $( "#plotform" ).validate();

    $( "#startDate, #endDate" ).datepicker({
        maxDate: 0,
        buttonText: "Choose",
        changeYear: true,
        yearRange: "1955:" + date.getFullYear(),
        onClose: function() {
            $( this ).valid();
        }
    });

    // Plotly chart
    $('#plotBtn').click(function(e) {
        event.preventDefault();

        // Create Quandle url query based on user input
        var urlStart = 'https://www.quandl.com/api/v3/datasets/';
        var quandlCode = $('#quandlCode').val();
        var column = 'column_index[]=4&';
        var transform = 'transform=' + $('#transform').val() + '&';
        var startDate = 'start_date=' + $('#startDate').val() + '&';
        var endDate = 'end_date=' + $('#endDate').val() + '&';
        var collapse = 'collapse=' + $('#collapse').val() + '&';
        var apiKey = 'api_key=ZNUBmiZ3d-zMyLGBxyUt';

        // Full Quandl API url call
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
                name: $('#transform option:selected').text(),
                line: {                             // set the width of the line.
                    width: 1
                },
            };

            var layout = {
                title: $('#company').val(),
                yaxis: {title: $('#transform option:selected').text()},       // set the y axis title
                xaxis: {
                    showgrid: false,                  // remove the x-axis grid lines
                    tickformat: "%B, %Y"              // customize the date format to "month, day"
                },
                margin: {                           // update the left, bottom, right, top margin
                    l: 60, b: 60, r: 60, t: 60
                }
            };

            Plotly.plot(plotDiv, [trace], layout, {showLink: false});
        });
    });

    //Plotly reset
    $('#resetBtn').click(function(e) {
        event.preventDefault();

        Plotly.purge(plotDiv);
    });


});

