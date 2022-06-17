@extends('admin/layouts/main')
@section('admin/container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid px-0 pt-5">
        <div class="row">
            {{-- <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-4 border-bottom mx-3">
                            <h4>Total Tickets</h4>
                        </div>
                        <h1>{{count($tickets)}}</h1>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-4 border-bottom mx-3">
                            <h4>Tickets by Status</h4>
                        </div>
                        {{-- chart container --}}
                        <div class="chart-container mx-3 ">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-4 border-bottom mx-3">
                            <h4>Tickets by Category</h4>
                        </div>
                        {{-- chart container --}}
                        <div class="chart-container mx-3">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3 h-100">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-4 border-bottom mx-3">
                            <h4>Tickets Closed in Last 10 Days</h4>
                        </div>
                        {{-- chart container --}}
                        <div class="chart-container mx-3" id="closed-chart-container">
                            <canvas id="closedChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- masonry CDN --}}
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
  

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Chart Script --}}
<script>
    const statusData = {
      labels: ['Open', 'Closed'],
      datasets: [{
        // label: 'My First dataset',
        backgroundColor: ['#FFC0D3', '#FF5C8D'],
        borderColor: '#FFFFFF',
        data: [{{$count_open}}, {{$count_closed}}],
      }]
    };

    const statusConfig = {
      type: 'pie',
      data: statusData,
      options: {
          maintainAspectRatio: false,
          plugins: {
              legend: {
                  display: true,
                  position: 'right'
              }
          }
      },
    };

    const closedData = {
        labels: [
            <?php
            foreach (range(0,9) as $d) {
                echo "'".$days[$d]."', ";
            }
            ?>
        ],
        datasets: [{
            label: 'Ticket Closed',
            backgroundColor: ['#FFC0D3'],
            borderColor: '#FFFFFF',
            data: [
                <?php
                foreach (range(0,9) as $c) {
                    echo $count_closed_tendays[$c].", ";
                }
                ?>
            ]
        }],
    };

    const closedConfig = {
        type: 'bar',
        data: closedData,
        options: {
            scales: {
                yAxes: {
                    ticks: {
                        stepSize: 1,
                        beginAtZero: true,
                    }  
                },
            },
            maintainAspectRatio:false,
        },
    };

    const categoryData = {
      labels: ['Uncategorized', 'Computer', 'Software', 'Network'],
      datasets: [{
        // label: 'My First dataset',
        backgroundColor: ['#FF9BB9', '#EBFF9B', '#9BFFE1', '#AF9BFF'],
        borderColor: '#FFFFFF',
        data: [{{$count_uncategorized}}, {{$count_computer}}, {{$count_software}}, {{$count_network}}],
      }]
    };

    const categoryConfig = {
      type: 'pie',
      data: categoryData,
      options: {
          maintainAspectRatio: false,
          plugins: {
              legend: {
                  display: true,
                  position: 'right'
              }
          }
      },
    };
  </script>

  {{-- Chart Render --}}
  <script>
    const statusChart = new Chart(document.getElementById('statusChart'), statusConfig);
    const categoryChart = new Chart(document.getElementById('categoryChart'), categoryConfig);
    const closedChart = new Chart(document.getElementById('closedChart'), closedConfig);
  </script>
  
@endsection