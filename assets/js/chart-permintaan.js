$(function () {
    'use strict';

    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    };

    var mode = 'index';
    var intersect = true;

    var $permintaanChart = $('#permintaan-chart');

    // Ubah data statis menjadi data yang diterima dari model
    var data = permintaanData;
    var labels = data.map(item => item.bulan);
    var values = data.map(item => item.jumlah_permintaan);

    var currentYear = new Date().getFullYear(); // Ambil tahun saat ini secara dinamis

    var permintaanChart = new Chart($permintaanChart, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total',
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                data: values // Menggunakan data dinamis dari model
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function (tooltipItem, data) {
                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                        var value = tooltipItem.yLabel;
                        return datasetLabel + ': ' + value;
                    },
                    title: function (tooltipItems, data) {
                        var title = '';
                        if (tooltipItems.length > 0) {
                            var item = tooltipItems[0];
                            title = data.labels[item.index] || '';
                        }
                        var bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                        var indexBulan = parseInt(title);
                        return bulan[indexBulan - 1] || title; // Jika index valid, tampilkan nama bulan
                    }
                }
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: true,
                labels: {
                    fontColor: 'black'
                }
            },
            title: {
                display: true,
                text: 'Grafik Permintaan Barang ' + currentYear // Gunakan tahun saat ini
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true,
                        lineWidth: 1,
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function (value) {
                            if (value >= 1000) {
                                value /= 1000
                                value += 'k'
                            }
                            return value
                        }
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        fontColor: 'black',
                        fontSize: 12,
                        fontWeight: 'bold',
                        callback: function (value, index, values) {
                            // Mengubah angka bulan menjadi nama bulan
                            var bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                            return bulan[value - 1]; // Indeks bulan dimulai dari 0
                        }
                    }
                }]
            }
        }
    });
});