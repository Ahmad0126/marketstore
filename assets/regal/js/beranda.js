var webTransaksiMetricsSatackedData;
$.ajax({
    url: base_url+"home/laporan_transaksi",
    async: true,
    dataType: 'json',
    type: 'get',
}).done(function (data) {
    webTransaksiMetricsSatackedData = data;
    if ($("#web-transaksi-metrics-satacked").length) {
        var barChartCanvas = $("#web-transaksi-metrics-satacked").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var ctx = document.getElementById("web-transaksi-metrics-satacked");
        ctx.height = 88;
        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            height: '200',
            data: webTransaksiMetricsSatackedData,
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.2,
                        stacked: true,
                        gridLines: {
                            display: true, //this will remove only the label
                            drawBorder: false,
                            color: "#e5e9f2",
                        },
                    }],
                    yAxes: [{
                        stacked: true,
                        display: false,
                        gridLines: {
                            display: false, //this will remove only the label
                            drawBorder: false
                        },
                    }]
                },
                legend: {
                    display: false,
                    position: "bottom"
                },
                legendCallback: function (chart) {
                    console.log(chart);
                    var text = [];
                    var jumlah = 0;
                    text.push('<div class="row">');
                    for (var i = 0; i < chart.data.datasets.length; i++) {
                        for (var a = 0; a < chart.data.datasets[i].data.length; a++) {
                            jumlah += chart.data.datasets[i].data[a];
                        }
                        text.push('<div class="col-lg-4"><div class="row"><div class="col-sm-12"><h5 class="font-weight-bold text-dark mb-1">' + jumlah.toLocaleString() + ' transaksi</h5></div></div><div class="row align-items-center"><div class="col-2"><span class="legend-label" style="background-color:' + chart.data.datasets[i].backgroundColor[i] + '"></span></div><div class="col-9 pl-0"><p class="text-muted m-0 ml-1">' + chart.data.datasets[i].label + '</p></div></div>');
                        text.push('</div>');
                        jumlah = 0;
                    }
                    text.push('</div>');
                    return text.join("");
                },
                elements: {
                    point: {
                        radius: 0
                    }
                }
            }
        });
        document.getElementById('chart-legends').innerHTML = barChart.generateLegend();
    }
});
