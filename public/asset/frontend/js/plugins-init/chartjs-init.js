(function ($) {

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    /* "use strict" */


    /* function draw() {

    } */


    var dzSparkLine = function () {
        let draw = Chart.controllers.line.__super__.draw; //draw shadow

        var screenWidth = $(window).width();

        var barChart1 = function () {
            if (jQuery('#barChart_1').length > 0) {
                const barChart_1 = document.getElementById("barChart_1").getContext('2d');
                // document.getElementById('')
                // var nomor_skk_this_year = JSON.parse('{!! json_encode($nomor_skk_this_year) !!}');
                //
                // const all_skk = {{json_encode($all_skk)}};
                // const all_skk = @JSON($all_skk);

                // const all_skk = document.getElementById("all_skk").value;
                // console.log(nomor_skk_this_year);


                barChart_1.height = 100;

                const myChart = new Chart(barChart_1, {
                    type: 'bar',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: _xdata,
                        // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                        datasets: [{
                            label: "Persentase Tersedia",
                            data: _ydata,
                            // dataPoints: dataPoints,
                            borderColor: 'rgba(30, 167, 197, 1)',
                            borderWidth: "0",
                            backgroundColor: 'rgba(30, 167, 197, 1)'
                        }],
                    },
                    options: {
                        legend: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 100,
                                    maxTicksLimit: 10,
                                    // padding: 10,
                                    callback: function (value, index, values) {
                                        return number_format(value) + ' %';
                                    }
                                }
                            }],
                            xAxes: [{
                                // Change here
                                barPercentage: 0.5
                            }]
                        }
                    },
                    // tooltips: {
                    // 	callbacks: {
                    // 		label: function (tooltipItem, chart) {
                    // 			var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    // 			return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' %';
                    // 		}
                    // 	}
                    // }
                });

                const persentase_ai = document.getElementById('persentase_ai');
                persentase_ai.addEventListener('click', function_persentase_ai)

                function function_persentase_ai() {
                    $.ajax({
                        url: "/getPersentaseAI",
                        type: "POST",
                        success: function (response) {
                            // console.log(response);
                            myChart.data.datasets[0].data = response;
                            myChart.data.datasets[0].label = "Persentase Tersedia";
                            myChart.options.scales.yAxes[0].ticks = {
                                min: 0,
                                max: 100,
                                maxTicksLimit: 10,
                                // padding: 10,
                                callback: function (value, index, values) {
                                    return number_format(value) + ' %';
                                }
                            }
                            myChart.update();
                        }
                    })
                }

                const nominal_ai = document.getElementById('nominal_ai');
                nominal_ai.addEventListener('click', function_nominal_ai)

                function function_nominal_ai() {
                    $.ajax({
                        url: "/getNominalAI",
                        type: "POST",
                        success: function (response) {
                            // console.log(response);
							var highest_array = Math.max(...response);
							// console.log(highest_array);
                            myChart.data.datasets[0].data = response;
                            myChart.data.datasets[0].label = "SKK Sisa";
                            myChart.options.scales.yAxes[0].ticks = {
                                min: 0,
                                max: highest_array,
                                maxTicksLimit: 100000000,
                                // padding: 10,
                                callback: function (value, index, values) {
                                    return 'Rp. ' + number_format(value);
                                }
                            }
                            myChart.update();
                        }
                    })
                }
            }
        }

        var barChart2 = function () {
            if (jQuery('#barChart_2').length > 0) {

                //gradient bar chart
                const barChart_2 = document.getElementById("barChart_2").getContext('2d');
                //generate gradient
                // const barChart_2gradientStroke = barChart_2.createLinearGradient(0, 0, 0, 250);
                // barChart_2gradientStroke.addColorStop(0, "rgba(11, 42, 151, 1)");
                // barChart_2gradientStroke.addColorStop(1, "rgba(11, 42, 151, 0.5)");

                barChart_2.height = 100;

                const myChart2 = new Chart(barChart_2, {
                    type: 'bar',
                    data: {
                        defaultFontFamily: 'Poppins',
                        // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                        labels: _vdata,
                        datasets: [{
                            label: "Persentase Tersedia",
                            data: _udata,
                            borderColor: 'rgba(30, 167, 197, 1)',
                            borderWidth: "0",
                            backgroundColor: 'rgba(30, 167, 197, 1)'
                        }]
                    },
                    options: {
                        legend: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 100,
                                    maxTicksLimit: 10,
                                    // padding: 10,
                                    callback: function (value, index, values) {
                                        return number_format(value) + ' %';
                                    }
                                }
                            }],
                            xAxes: [{
                                // Change here
                                barPercentage: 0.5
                            }]
                        },
                    },
                    // tooltips: {
                    // 	callbacks: {
                    // 		label: function (tooltipItem, chart) {
                    // 			var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    // 			return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' %';
                    // 		}
                    // 	}
                    // }
                });

				const persentase_ao = document.getElementById('persentase_ao');
                persentase_ao.addEventListener('click', function_persentase_ao)

                function function_persentase_ao() {
                    $.ajax({
                        url: "/getPersentaseAO",
                        type: "POST",
                        success: function (response) {
                            // console.log(response);
                            myChart2.data.datasets[0].data = response;
                            myChart2.data.datasets[0].label = "Persentase Tersedia";
                            myChart2.options.scales.yAxes[0].ticks = {
                                min: 0,
                                max: 100,
                                maxTicksLimit: 10,
                                // padding: 10,
                                callback: function (value, index, values) {
                                    return number_format(value) + ' %';
                                }
                            }
                            myChart2.update();
                        }
                    })
                }

				const nominal_ao = document.getElementById('nominal_ao');
                nominal_ao.addEventListener('click', function_nominal_ao)

                function function_nominal_ao() {
                    $.ajax({
                        url: "/getNominalAO",
                        type: "POST",
                        success: function (response) {
                            // console.log(response);
							var highest_array = Math.max(...response);
							// console.log(highest_array);
                            myChart2.data.datasets[0].data = response;
							myChart2.data.datasets[0].label = "SKK Sisa";
                            myChart2.options.scales.yAxes[0].ticks = {
                                min: 0,
                                max: highest_array,
                                maxTicksLimit: 100000000,
                                // padding: 10,
                                callback: function (value, index, values) {
                                    return 'Rp. ' + number_format(value);
                                }
                            }
                            myChart2.update();
                        }
                    })
                }
            }
        }

        var barChart3 = function () {
            //stalked bar chart
            if (jQuery('#barChart_3').length > 0) {
                const barChart_3 = document.getElementById("barChart_3").getContext('2d');
                //generate gradient
                const barChart_3gradientStroke = barChart_3.createLinearGradient(50, 100, 50, 50);
                barChart_3gradientStroke.addColorStop(0, "rgba(11, 42, 151, 1)");
                barChart_3gradientStroke.addColorStop(1, "rgba(11, 42, 151, 0.5)");

                const barChart_3gradientStroke2 = barChart_3.createLinearGradient(50, 100, 50, 50);
                barChart_3gradientStroke2.addColorStop(0, "rgba(39, 188, 72, 1)");
                barChart_3gradientStroke2.addColorStop(1, "rgba(39, 188, 72, 1)");

                const barChart_3gradientStroke3 = barChart_3.createLinearGradient(50, 100, 50, 50);
                barChart_3gradientStroke3.addColorStop(0, "rgba(139, 199, 64, 1)");
                barChart_3gradientStroke3.addColorStop(1, "rgba(139, 199, 64, 1)");

                barChart_3.height = 100;

                let barChartData = {
                    defaultFontFamily: 'Poppins',
                    labels: ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Red',
                        backgroundColor: barChart_3gradientStroke,
                        hoverBackgroundColor: barChart_3gradientStroke,
                        data: [
                            '12',
                            '12',
                            '12',
                            '12',
                            '12',
                            '12',
                            '12'
                        ]
                    }, {
                        label: 'Green',
                        backgroundColor: barChart_3gradientStroke2,
                        hoverBackgroundColor: barChart_3gradientStroke2,
                        data: [
                            '12',
                            '12',
                            '12',
                            '12',
                            '12',
                            '12',
                            '12'
                        ]
                    }, {
                        label: 'Blue',
                        backgroundColor: barChart_3gradientStroke3,
                        hoverBackgroundColor: barChart_3gradientStroke3,
                        data: [
                            '12',
                            '12',
                            '12',
                            '12',
                            '12',
                            '12',
                            '12'
                        ]
                    }]

                };

                new Chart(barChart_3, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: false
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        responsive: true,
                        scales: {
                            xAxes: [{
                                stacked: true,
                            }],
                            yAxes: [{
                                stacked: true
                            }]
                        }
                    }
                });


            }
        }
        var lineChart1 = function () {


            if (jQuery('#lineChart_1').length > 0) {


                //basic line chart
                const lineChart_1 = document.getElementById("lineChart_1").getContext('2d');

                Chart.controllers.line = Chart.controllers.line.extend({
                    draw: function () {
                        draw.apply(this, arguments);
                        let nk = this.chart.chart.ctx;
                        let _stroke = nk.stroke;
                        nk.stroke = function () {
                            nk.save();
                            nk.shadowColor = 'rgba(255, 0, 0, .2)';
                            nk.shadowBlur = 10;
                            nk.shadowOffsetX = 0;
                            nk.shadowOffsetY = 10;
                            _stroke.apply(this, arguments)
                            nk.restore();
                        }
                    }
                });

                lineChart_1.height = 100;

                new Chart(lineChart_1, {
                    type: 'line',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: ["Jan", "Febr", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [{
                            label: "My First dataset",
                            data: [25, 20, 60, 41, 66, 45, 80],
                            borderColor: 'rgba(11, 42, 151, 1)',
                            borderWidth: "2",
                            backgroundColor: 'transparent',
                            pointBackgroundColor: 'rgba(11, 42, 151, 1)'
                        }]
                    },
                    options: {
                        legend: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 20,
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    padding: 5
                                }
                            }]
                        }
                    }
                });

            }
        }

        /* var draw = function(){

        } */

        var lineChart2 = function () {
            //gradient line chart
            if (jQuery('#lineChart_2').length > 0) {

                const lineChart_2 = document.getElementById("lineChart_2").getContext('2d');
                //generate gradient
                const lineChart_2gradientStroke = lineChart_2.createLinearGradient(500, 0, 100, 0);
                lineChart_2gradientStroke.addColorStop(0, "rgba(11, 42, 151, 1)");
                lineChart_2gradientStroke.addColorStop(1, "rgba(11, 42, 151, 0.5)");

                //Chart.controllers.line.draw = function(){ };

                Chart.controllers.line = Chart.controllers.line.extend({
                    draw: function () {
                        draw.apply(this, arguments);
                        let nk = this.chart.chart.ctx;
                        let _stroke = nk.stroke;
                        nk.stroke = function () {
                            nk.save();
                            nk.shadowColor = 'rgba(0, 0, 128, .2)';
                            nk.shadowBlur = 10;
                            nk.shadowOffsetX = 0;
                            nk.shadowOffsetY = 10;
                            _stroke.apply(this, arguments)
                            nk.restore();
                        }
                    }

                });


                lineChart_2.height = 100;

                new Chart(lineChart_2, {
                    type: 'line',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [{
                            label: "My First dataset",
                            data: [25, 20, 60, 41, 66, 45, 80],
                            borderColor: lineChart_2gradientStroke,
                            borderWidth: "2",
                            backgroundColor: 'transparent',
                            pointBackgroundColor: 'rgba(11, 42, 151, 0.5)'
                        }]
                    },
                    options: {
                        legend: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 20,
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    padding: 5
                                }
                            }]
                        }
                    }
                });
            }
        }
        var lineChart3 = function () {
            //dual line chart
            if (jQuery('#lineChart_3').length > 0) {
                const lineChart_3 = document.getElementById("lineChart_3").getContext('2d');
                //generate gradient
                const lineChart_3gradientStroke1 = lineChart_3.createLinearGradient(500, 0, 100, 0);
                lineChart_3gradientStroke1.addColorStop(0, "rgba(11, 42, 151, 1)");
                lineChart_3gradientStroke1.addColorStop(1, "rgba(11, 42, 151, 0.5)");

                const lineChart_3gradientStroke2 = lineChart_3.createLinearGradient(500, 0, 100, 0);
                lineChart_3gradientStroke2.addColorStop(0, "rgba(255, 188, 17, 1)");
                lineChart_3gradientStroke2.addColorStop(1, "rgba(255, 188, 17, 1)");

                Chart.controllers.line = Chart.controllers.line.extend({
                    draw: function () {
                        draw.apply(this, arguments);
                        let nk = this.chart.chart.ctx;
                        let _stroke = nk.stroke;
                        nk.stroke = function () {
                            nk.save();
                            nk.shadowColor = 'rgba(0, 0, 0, 0)';
                            nk.shadowBlur = 10;
                            nk.shadowOffsetX = 0;
                            nk.shadowOffsetY = 10;
                            _stroke.apply(this, arguments)
                            nk.restore();
                        }
                    }
                });

                lineChart_3.height = 100;

                new Chart(lineChart_3, {
                    type: 'line',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [{
                            label: "My First dataset",
                            data: [25, 20, 60, 41, 66, 45, 80],
                            borderColor: lineChart_3gradientStroke1,
                            borderWidth: "2",
                            backgroundColor: 'transparent',
                            pointBackgroundColor: 'rgba(11, 42, 151, 0.5)'
                        }, {
                            label: "My First dataset",
                            data: [5, 20, 15, 41, 35, 65, 80],
                            borderColor: lineChart_3gradientStroke2,
                            borderWidth: "2",
                            backgroundColor: 'transparent',
                            pointBackgroundColor: 'rgba(254, 176, 25, 1)'
                        }]
                    },
                    options: {
                        legend: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 20,
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    padding: 5
                                }
                            }]
                        }
                    }
                });
            }
        }
        var lineChart03 = function () {
            //dual line chart
            if (jQuery('#lineChart_3Kk').length > 0) {
                const lineChart_3Kk = document.getElementById("lineChart_3Kk").getContext('2d');
                //generate gradient

                Chart.controllers.line = Chart.controllers.line.extend({
                    draw: function () {
                        draw.apply(this, arguments);
                        let nk = this.chart.chart.ctx;
                        let _stroke = nk.stroke;
                        nk.stroke = function () {
                            nk.save();
                            nk.shadowColor = 'rgba(0, 0, 0, 0)';
                            nk.shadowBlur = 10;
                            nk.shadowOffsetX = 0;
                            nk.shadowOffsetY = 10;
                            _stroke.apply(this, arguments)
                            nk.restore();
                        }
                    }
                });

                lineChart_3Kk.height = 100;

                new Chart(lineChart_3Kk, {
                    type: 'line',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [{
                            label: "My First dataset",
                            data: [90, 60, 80, 50, 60, 55, 80],
                            borderColor: 'rgba(58,122,254,1)',
                            borderWidth: "3",
                            backgroundColor: 'rgba(0,0,0,0)',
                            pointBackgroundColor: 'rgba(0, 0, 0, 0)'
                        }]
                    },
                    options: {
                        legend: false,
                        elements: {
                            point: {
                                radius: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 20,
                                    padding: 10
                                },
                                borderWidth: 3,
                                display: false,
                                lineTension: 0.4,
                            }],
                            xAxes: [{
                                ticks: {
                                    padding: 5
                                },

                            }]
                        }
                    }
                });
            }

        }
        var areaChart1 = function () {
            //basic area chart
            if (jQuery('#areaChart_1').length > 0) {
                const areaChart_1 = document.getElementById("areaChart_1").getContext('2d');

                areaChart_1.height = 100;

                new Chart(areaChart_1, {
                    type: 'line',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [{
                            label: "My First dataset",
                            data: [25, 20, 60, 41, 66, 45, 80],
                            borderColor: 'rgba(0, 0, 1128, .3)',
                            borderWidth: "1",
                            backgroundColor: 'rgba(11, 42, 151, .5)',
                            pointBackgroundColor: 'rgba(0, 0, 1128, .3)'
                        }]
                    },
                    options: {
                        legend: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 20,
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    padding: 5
                                }
                            }]
                        }
                    }
                });
            }
        }
        var areaChart2 = function () {
            //gradient area chart
            if (jQuery('#areaChart_2').length > 0) {
                const areaChart_2 = document.getElementById("areaChart_2").getContext('2d');
                //generate gradient
                const areaChart_2gradientStroke = areaChart_2.createLinearGradient(0, 1, 0, 500);
                areaChart_2gradientStroke.addColorStop(0, "rgba(139, 199, 64, 0.2)");
                areaChart_2gradientStroke.addColorStop(1, "rgba(139, 199, 64, 0)");

                areaChart_2.height = 100;

                new Chart(areaChart_2, {
                    type: 'line',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [{
                            label: "My First dataset",
                            data: [25, 20, 60, 41, 66, 45, 80],
                            borderColor: "#FF2E2E",
                            borderWidth: "4",
                            backgroundColor: areaChart_2gradientStroke
                        }]
                    },
                    options: {
                        legend: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 20,
                                    padding: 5
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    padding: 5
                                }
                            }]
                        }
                    }
                });
            }
        }

        var areaChart3 = function () {
            //gradient area chart
            if (jQuery('#areaChart_3').length > 0) {
                const areaChart_3 = document.getElementById("areaChart_3").getContext('2d');

                areaChart_3.height = 100;

                new Chart(areaChart_3, {
                    type: 'line',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [{
                                label: "My First dataset",
                                data: [25, 20, 60, 41, 66, 45, 80],
                                borderColor: 'rgb(11, 42, 151)',
                                borderWidth: "1",
                                backgroundColor: 'rgba(11, 42, 151, .5)'
                            },
                            {
                                label: "My First dataset",
                                data: [5, 25, 20, 41, 36, 75, 70],
                                borderColor: 'rgb(255, 188, 17)',
                                borderWidth: "1",
                                backgroundColor: 'rgba(255, 188, 17, .5)'
                            }
                        ]
                    },
                    options: {
                        legend: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                    min: 0,
                                    stepSize: 20,
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    padding: 5
                                }
                            }]
                        }
                    }
                });
            }
        }

        var radarChart = function () {
            if (jQuery('#radar_chart').length > 0) {
                //radar chart
                const radar_chart = document.getElementById("radar_chart").getContext('2d');

                const radar_chartgradientStroke1 = radar_chart.createLinearGradient(500, 0, 100, 0);
                radar_chartgradientStroke1.addColorStop(0, "rgba(54, 185, 216, .5)");
                radar_chartgradientStroke1.addColorStop(1, "rgba(75, 255, 162, .5)");

                const radar_chartgradientStroke2 = radar_chart.createLinearGradient(500, 0, 100, 0);
                radar_chartgradientStroke2.addColorStop(0, "rgba(68, 0, 235, .5");
                radar_chartgradientStroke2.addColorStop(1, "rgba(68, 236, 245, .5");

                // radar_chart.height = 100;
                new Chart(radar_chart, {
                    type: 'radar',
                    data: {
                        defaultFontFamily: 'Poppins',
                        labels: [
                            ["Eating", "Dinner"],
                            ["Drinking", "Water"], "Sleeping", ["Designing", "Graphics"], "Coding", "Cycling", "Running"
                        ],
                        datasets: [{
                                label: "My First dataset",
                                data: [65, 59, 66, 45, 56, 55, 40],
                                borderColor: '#f21780',
                                borderWidth: "1",
                                backgroundColor: radar_chartgradientStroke2
                            },
                            {
                                label: "My Second dataset",
                                data: [28, 12, 40, 19, 63, 27, 87],
                                borderColor: '#f21780',
                                borderWidth: "1",
                                backgroundColor: radar_chartgradientStroke1
                            }
                        ]
                    },
                    options: {
                        legend: false,
                        maintainAspectRatio: false,
                        scale: {
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        }
        var pieChart = function () {
            //pie chart
            if (jQuery('#pie_chart').length > 0) {
                //pie chart
                const pie_chart = document.getElementById("pie_chart").getContext('2d');
                // pie_chart.height = 100;
                new Chart(pie_chart, {
                    type: 'pie',
                    data: {
                        defaultFontFamily: 'Poppins',
                        datasets: [{
                            data: [45, 25, 20, 10],
                            borderWidth: 0,
                            backgroundColor: [
                                "rgba(11, 42, 151, .9)",
                                "rgba(11, 42, 151, .7)",
                                "rgba(11, 42, 151, .5)",
                                "rgba(0,0,0,0.07)"
                            ],
                            hoverBackgroundColor: [
                                "rgba(11, 42, 151, .9)",
                                "rgba(11, 42, 151, .7)",
                                "rgba(11, 42, 151, .5)",
                                "rgba(0,0,0,0.07)"
                            ]

                        }],
                        labels: [
                            "one",
                            "two",
                            "three",
                            "four"
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: false,
                        maintainAspectRatio: false
                    }
                });
            }
        }
        var doughnutChart = function () {
            if (jQuery('#doughnut_chart').length > 0) {
                //doughut chart
                const doughnut_chart = document.getElementById("doughnut_chart").getContext('2d');
                // doughnut_chart.height = 100;
                new Chart(doughnut_chart, {
                    type: 'doughnut',
                    data: {
                        weight: 5,
                        defaultFontFamily: 'Poppins',
                        datasets: [{
                            data: [45, 25, 20],
                            borderWidth: 3,
                            borderColor: "rgba(255,255,255,1)",
                            backgroundColor: [
                                "rgba(11, 42, 151, 1)",
                                "rgba(39, 188, 72, 1)",
                                "rgba(139, 199, 64, 1)"
                            ],
                            hoverBackgroundColor: [
                                "rgba(11, 42, 151, 0.9)",
                                "rgba(39, 188, 72, .9)",
                                "rgba(139, 199, 64, .9)"
                            ]

                        }],
                        // labels: [
                        //     "green",
                        //     "green",
                        //     "green",
                        //     "green"
                        // ]
                    },
                    options: {
                        weight: 1,
                        cutoutPercentage: 70,
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        }
        var polarChart = function () {
            if (jQuery('#polar_chart').length > 0) {
                //polar chart
                const polar_chart = document.getElementById("polar_chart").getContext('2d');
                // polar_chart.height = 100;
                new Chart(polar_chart, {
                    type: 'polarArea',
                    data: {
                        defaultFontFamily: 'Poppins',
                        datasets: [{
                            data: [15, 18, 9, 6, 19],
                            borderWidth: 0,
                            backgroundColor: [
                                "rgba(11, 42, 151, 1)",
                                "rgba(39, 188, 72, 1)",
                                "rgba(139, 199, 64, 1)",
                                "rgba(255, 46, 46, 1)",
                                "rgba(255, 188, 17, 1)"
                            ]

                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

            }
        }



        /* Function ============ */
        return {
            init: function () {},


            load: function () {
                barChart1();
                barChart2();
                barChart3();
                lineChart1();
                lineChart2();
                lineChart3();
                lineChart03();
                areaChart1();
                areaChart2();
                areaChart3();
                radarChart();
                pieChart();
                doughnutChart();
                polarChart();
            },

            resize: function () {
                barChart1();
                barChart2();
                barChart3();
                lineChart1();
                lineChart2();
                lineChart3();
                lineChart03();
                areaChart1();
                areaChart2();
                areaChart3();
                radarChart();
                pieChart();
                doughnutChart();
                polarChart();
            }
        }

    }();

    jQuery(document).ready(function () {});

    jQuery(window).on('load', function () {
        dzSparkLine.load();
    });

    jQuery(window).on('resize', function () {
        //dzSparkLine.resize();
        setTimeout(function () {
            dzSparkLine.resize();
        }, 1000);
    });

})(jQuery);
