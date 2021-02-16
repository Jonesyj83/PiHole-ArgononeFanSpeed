var fanspeedlabels = [], fanspeed = [], temp = [];

function updateFanSpeedData() {


    function formatDate(itemdate) {
        return moment(itemdate).format("MMM Do HH:mm");
    }

    $.ajax({
        url: 'api.php?getFanSpeed24hrs&PHP',
        dataType: 'json'
    }).done(function (results) {

        results.forEach(function (packet) {
            // console.log(speedlabels.indexOf(formatDate(packet.start_time)));
            if (fanspeedlabels.indexOf(formatDate(packet.start_time)) === -1) {
                fanspeedlabels.push(formatDate(packet.start_time));
                fanspeed.push(parseFloat(packet.fanspeed));
                temp.push(parseFloat(packet.temp));

            }

        });
        fanspeedChart.update();
        fanspeeddata = results;
    });
}


setInterval(function () {
    // console.log('updateFanSpeedData');
    updateFanSpeedData();
}, 6000);


var fanspeedChartctx = document.getElementById("fanspeedChart");
var newfanspeed = fanspeed + "%";
var fanspeedChart = new Chart(fanspeedChartctx, {
    type: 'line',
    data: {
        labels: fanspeedlabels,
        datasets: [{
            label: 'FanSpeed',
            data: fanspeed,
            backgroundColor: 'rgb(60, 141, 188)',
            fill: false,
            borderColor: 'rgb(60, 141, 188)',
            borderWidth: 1,
            cubicInterpolationMode: 'monotone',
            yAxisID: "y-axis-1"
        },
            {
                label: 'Temp',
                data: temp,
                backgroundColor: 'rgba(255, 99, 132, 1)',
                fill: false,
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1,
                yAxisID: "y-axis-1"
            }

        ]
    },
    options: {
        hover: {
            animationDuration: 0 // duration of animations when hovering an item
        },
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                display: true,
                position: "left",
                id: "y-axis-1",
                ticks : {
                    min: 0,
                    max: 100
                }
            },
                {
                    type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                    display: true,
                    position: "right",
                    id: "y-axis-2",
                    ticks : {
                        min: 0,
                        max: 100
                    }
                }
            ],
            xAxes: [
                {
                    // type :'time',
                    display: true,
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        //autoSkip: true,
                        //maxTicksLimit: 10,
                        maxRotation: 0,
                        minRotation: 0
                    }
                }
            ]
        },
        tooltips: {
            enabled: true,
            mode: "x-axis",
            intersect: false,
            callbacks: {
                label: function(t, d) {
                    var xLabel = d.datasets[t.datasetIndex].label;
                    var yLabel = t.yLabel;
                    if(t.datasetIndex === 0) {
                        return 'Fan Speed: ' + yLabel.toFixed(0) + '%';
                    }
                    else if (t.datasetIndex === 1) {
                        return 'CPU Temp: ' + yLabel.toFixed(0) + '°C';
                    }
                }
            }
        }
//	plugins: {
//	   zoom: {
//		zoom: {
//		   enabled: true,
//		   drag: dragOptions,
//		   mode: 'x',
//		   speed: 0.05
	 // 	}
	 //  }
	//}
    }
});
updateFanSpeedData();
