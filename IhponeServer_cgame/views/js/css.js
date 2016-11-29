$(function () {
    var data = [12,11,10,10,10,11,10,15,16,15,15,15,15,15,15,15,14,14,15,14,13,13,11,11,11,10,10,8,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,8,8,8,8,8,7,8,8,8,7,8,8,9,9,9,9,9,9,9,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,9,8,8,10,10,10,10,10,9,9,9,9,9,9,12,13,13,13,14,14,12,12,11,15,14,16,16,15,15,14,12,13,16,15,14,13,15,15,14,15,17,17,17,18,18,18,18,20,21,21,20,20,20,20,18,18,18,16,16,16,16,15,13,14,14,13,12,12,13,15,15,15,14,16,16,15,16,16,17,16,15,15,15];

    var masterChart,
        detailChart;

    $(document).ready(function() {


        // create the master chart
        function createMaster() {
            masterChart = $('#master-container').highcharts({
                chart: {
                    reflow: false,
                    borderWidth: 0,
                    backgroundColor: null,
                    marginLeft: 50,
                    marginRight: 20,
                    zoomType: 'x',
                    events: {

                        // listen to the selection event on the master chart to update the
                        // extremes of the detail chart
                        selection: function(event) {
                            var extremesObject = event.xAxis[0],
                                min = extremesObject.min,
                                max = extremesObject.max,
                                detailData = [],
                                xAxis = this.xAxis[0];

                            // reverse engineer the last part of the data
                            jQuery.each(this.series[0].data, function(i, point) {
                                if (point.x > min && point.x < max) {
                                    detailData.push({
                                        x: point.x,
                                        y: point.y
                                    });
                                }
                            });

                            // move the plot bands to reflect the new detail span
                            xAxis.removePlotBand('mask-before');
                            xAxis.addPlotBand({
                                id: 'mask-before',
                                from: Date.UTC(2016, 1, 13),
                                to: min,
                                color: 'rgba(0, 0, 0, 0.2)'
                            });

                            xAxis.removePlotBand('mask-after');
                            xAxis.addPlotBand({
                                id: 'mask-after',
                                from: max,
                                to: Date.UTC(2016, 1,22),
                                color: 'rgba(0, 0, 0, 0.2)'
                            });


                            detailChart.series[0].setData(detailData);

                            return false;
                        }
                    }
                },
                title: {
                    text: null
                },
                xAxis: {
                    type: 'datetime',
                    showLastTickLabel: true,
                    maxZoom: 300*1000, // fourteen days
                    plotBands: [{
                        id: 'mask-before',
                        from: Date.UTC(2016, 1, 13),
                        to: Date.UTC(2016, 1,22),
                        color: 'rgba(0, 0, 0, 0.2)'
                    }],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    gridLineWidth: 0,
                    labels: {
                        enabled: false
                    },
                    title: {
                        text: null
                    },
                    min: 0.6,
                    showFirstLabel: false
                },
                tooltip: {
                    formatter: function() {
                        return false;
                    }
                },
                legend: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        fillColor: {
                            linearGradient: [0, 0, 0, 70],
                            stops: [
                                [0, '#4572A7'],
                                [1, 'rgba(0,0,0,0)']
                            ]
                        },
                        lineWidth: 1,
                        marker: {
                            enabled: false
                        },
                        shadow: false,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        enableMouseTracking: false
                    }
                },

                series: [{
                    type: 'area',
                    name: 'USD to EUR',
                    pointInterval: 300 * 1000,
                    pointStart: Date.UTC(2016, 1,13),
                    data: data
                }],

                exporting: {
                    enabled: false
                }

            }, function(masterChart) {
                createDetail(masterChart)
            })
                .highcharts(); // return chart instance
        }

        // create the detail chart
        function createDetail(masterChart) {

            // prepare the detail chart
            var detailData = [],
                detailStart = Date.UTC(2016, 1, 1);

            jQuery.each(masterChart.series[0].data, function(i, point) {
                if (point.x >= detailStart) {
                    detailData.push(point.y);
                }
            });

            // create a detail chart referenced by a global variable
            detailChart = $('#detail-container').highcharts({
                chart: {
                    marginBottom: 120,
                    reflow: false,
                    marginLeft: 50,
                    marginRight: 20,
                    style: {
                        position: 'absolute'
                    }
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Historical USD to EUR Exchange Rate'
                },
                subtitle: {
                    text: 'Select an area by dragging across the lower chart'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: null
                    },
                    maxZoom: 0.1
                },
                tooltip: {
                    formatter: function() {
                        var point = this.points[0];
                        var nS=this.x/1000;
                        var cc=new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
                        return cc+":"+this.y;
                    },
                    shared: true
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        marker: {
                            enabled: false,
                            states: {
                                hover: {
                                    enabled: true,
                                    radius: 3
                                }
                            }
                        }
                    }
                },
                series: [{
                    name: 'USD to EUR',
                    pointStart: detailStart,
                    pointInterval: 300 * 1000,
                    data: detailData
                }],

                exporting: {
                    enabled: false
                }

            }).highcharts(); // return chart
        }

        // make the container smaller and add a second container for the master chart
        var $container = $('#container')
            .css('position', 'relative');

        var $detailContainer = $('<div id="detail-container">')
            .appendTo($container);

        var $masterContainer = $('<div id="master-container">')
            .css({ position: 'absolute', top: 300, height: 80, width: '100%' })
            .appendTo($container);

        // create master and in its callback, create the detail chart
        createMaster();
    });

});				