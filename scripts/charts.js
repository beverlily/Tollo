$(document).ready(function(){
    var canvas = document.getElementById('tester');
    // var dates = [
    // {
    //     x: ['2013-10-04','2013-10-10','2013-10-17'],
    //     y: [225,265,275],
    //     type: 'scatter'
    // }
    // ];

    // Plotly.newPlot(canvas,dates);

    function plotLogsbyExercises(exid) {
        var dates = new Array();
        var weights = new Array();

        $.ajax({
            type: "POST",
            url: "../Controllers/getlogsforcharts.php",
            data: {'id':exid},
            //dataType: "json",
            // error: function (jqxhr, xhr, status, exception) {
            //     alert(jqxhr + " & " + xhr + " & " + status + " & " + exception);
            // },
            success: function(data) {
                $.each(JSON.parse(data),function(rec){
                    dates.push(rec.date);
                    let n = parseInt(rec.weight);
                    weights.push(n);
                })
            }
        })
        
        dates.forEach(function(d) {
            console.log(d);
        });

        var x2 = dates;
        var y2 = weights;

        //var y1 = new Array();

        // y1.push(315);
        // y1.push(225);
        // y1.push(225);
        // y1.push(135);

        var x1 = ['2019-03-13','2019-03-15','2019-03-27','2019-04-07'];
        var y1 = [315,225,225,135];

        console.log(dates[0]);
        console.log(x1[0]);
        
        console.log(dates);
        console.log(x1);
        console.log(weights);
        console.log(y1);

        var logdata = {
                x: x1,
                y: y1,
                mode:'lines+markers'
        };

        var dataobj = [ logdata ];

        var layout = {
            title:'Progress Over Time'
        };

        Plotly.newPlot(canvas, dataobj, layout);

        var update = {
            width: 1000,  // or any new width
            height: 400  // " "
          };
          
        Plotly.relayout(canvas, update);

        //TESTING HOW THIS THING TAKES ARRAYS
        // var x2 = [2, 3, 4, 5];
        // var y2 =  [16, 5, 11, 9];

        // var x3 = [1, 2, 3, 4];
        // var y3 =  [12, 9, 15, 12];

        // var trace2 = {
        // x: x2,
        // y: y2,
        // mode: 'lines'
        // };

        // var trace3 = {
        // x: x3,
        // y: y3,
        // mode: 'lines+markers'
        // };

        // var data = [ trace2, trace3 ];

        // console.log(x2);
        // console.log(y2);
        // console.log(trace2);
        // console.log(data);

        //Plotly.newPlot(canvas, data, layout);

    }

    $('#exercise').change(function(){
        var exercise = this.value;
        plotLogsbyExercises(exercise);
    });

});