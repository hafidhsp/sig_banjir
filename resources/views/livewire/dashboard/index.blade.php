<div>
    <div class="content-wrapper">
        <div class="row d-none">
            <div class="col-xl-12 grid-margin stretch-card" >
                <div class="w-100 flex-grow">
                    <div class="col-md-12 grid-margin stretch-card" >
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Data Banjir</p>
                                {{-- <p class="text-muted">25% more traffic than previous week</p> --}}
                                <div class="row mb-3">
                                    <div class="col-md-7">
                                        <div class="d-flex justify-content-between traffic-status">
                                            <div class="item">
                                                <p class="mb-">Curah Hujan</p>
                                                <h5 class="font-weight-bold mb-0">93,956</h5>
                                                <div class="color-border" style="color:#008FFB; "></div>
                                            </div>
                                            <div class="item">
                                                <p class="mb-">Dataran</p>
                                                <h5 class="font-weight-bold mb-0">58,605</h5>
                                                <div class="color-border" style="color:#00E396; "></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <ul class="nav nav-pills nav-pills-custom justify-content-md-end"
                                            id="pills-tab-custom" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-home-tab-custom" data-toggle="pill"
                                                    href="#pills-health" role="tab" aria-controls="pills-home"
                                                    aria-selected="true">
                                                    Hari
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-profile-tab-custom" data-toggle="pill"
                                                    href="#pills-career" role="tab" aria-controls="pills-profile"
                                                    aria-selected="false">
                                                    Minggu
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-contact-tab-custom" data-toggle="pill"
                                                    href="#pills-music" role="tab" aria-controls="pills-contact"
                                                    aria-selected="false">
                                                    Bulan
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="chartbanjir"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none">
            <div class="col-xl-12 grid-margin stretch-card" >
                <div class="w-100 flex-grow">
                    <div class="col-md-12 grid-margin stretch-card" >
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Data Korban</p>
                                <div id="chartkorban"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row end -->


    </div>
</div>


    @push('scripts')
<script>

    document.addEventListener("DOMContentLoaded", function () {
    var options = {
        chart: {
            type: 'line',
            height: '100%',
            width: '100%'
        },
        series: [
            {
            name: 'sales',
            data: [30,40,35,50,49,60,70,91,125]
            },
            {
            name: 'Revenue',
            data: [20, 30, 25, 40, 35, 50, 65, 80, 100]
            }
        ],
        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        },
        colors: ['#008FFB', '#00E396'],
    }
    var chart = new ApexCharts(document.querySelector("#chartbanjir"), options);

    chart.render();

    var options1 = {
        chart: {
            type: 'bar',
            height: '100%',
            width: '100%'
        },
        series: [
            {
            name: 'sales',
            data: [30,40,35,50,49,60,70,91,125]
            },
            {
            name: 'Revenue',
            data: [20, 30, 25, 40, 35, 50, 65, 80, 100]
            }
        ],
        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        },
        colors: ['#008FFB', '#00E396'],
    }
    var chart1 = new ApexCharts(document.querySelector("#chartkorban"), options1);

    chart1.render();

    });
</script>
@endpush

</div>
