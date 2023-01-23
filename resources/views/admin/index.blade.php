@extends('admin/layouts/main')
@section('admin/container')
   {{-- {{dd($date_diff)}} --}}

   <div class="container-fluid" id="statsWrapper">
      <div class="container-fluid px-0 mb-5 pt-3 pb-5">
         <div class="mb-5 d-flex">
            <h2 class="display-4 flex-grow-1">Statistik</h2>
            <div class="d-flex align-items-start">
               <span id="date" class="me-2"></span>
               <span id="time"></span>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-6 mb-3">
               <div class="card border-0 shadow-sm">
                  <div class="card-body">
                     <div class="mb-4 border-bottom mx-3 d-flex">
                        <h4 class="flex-grow-1">Tiket berdasarkan status</h4>
                        <div class="d-flex align-items-center">
                           <form action="/admin/dashboard" name="status_date" class="d-flex">
                              @if (request('category_start') && request('category_end'))
                                 <input type="hidden" name="category_start" value="{{ request('category_start') }}">
                                 <input type="hidden" name="category_end" value="{{ request('category_end') }}">
                              @endif
                              @if (request('user_div_start') && request('user_div_end'))
                                 <input type="hidden" name="user_div_start" value="{{ request('user_div_start') }}">
                                 <input type="hidden" name="user_div_end" value="{{ request('user_div_end') }}">
                              @endif
                              @if (request('ticket_div_start') && request('ticket_div_end'))
                                 <input type="hidden" name="ticket_div_start" value="{{ request('ticket_div_start') }}">
                                 <input type="hidden" name="ticket_div_end" value="{{ request('ticket_div_end') }}">
                              @endif
                              @if (request('closed_start') && request('closed_end'))
                                 <input type="hidden" name="closed_start" value="{{ request('closed_start') }}">
                                 <input type="hidden" name="closed_end" value="{{ request('closed_end') }}">
                              @endif

                              <input type="date" id="status_start" name="status_start" class="form-custom-control"
                                 value="{{ request('status_start') !== null ? request('status_start') : \Carbon\Carbon::parse('30 days ago')->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                              <span class="mx-2" style="margin-bottom: .5rem;">sampai</span>
                              <input type="date" id="status_end" name="status_end" class="form-custom-control"
                                 value="{{ request('status_end') !== null ? request('status_end') : \Carbon\Carbon::today()->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                           </form>
                        </div>
                     </div>
                     {{-- chart container --}}
                     <div class="chart-container mx-3 ">
                        <canvas id="statusChart"></canvas>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-lg-6 mb-3">
               <div class="card border-0 shadow-sm">
                  <div class="card-body">
                     <div class="mb-4 border-bottom mx-3 d-flex">
                        <h4 class="flex-grow-1">Tiket berdasarkan kategori</h4>
                        <div class="d-flex align-items-center">
                           <form action="/admin/dashboard" class="d-flex">
                              @if (request('status_start') && request('status_end'))
                                 <input type="hidden" name="status_start" value="{{ request('status_start') }}">
                                 <input type="hidden" name="status_end" value="{{ request('status_end') }}">
                              @endif
                              @if (request('user_div_start') && request('user_div_end'))
                                 <input type="hidden" name="user_div_start" value="{{ request('user_div_start') }}">
                                 <input type="hidden" name="user_div_end" value="{{ request('user_div_end') }}">
                              @endif
                              @if (request('ticket_div_start') && request('ticket_div_end'))
                                 <input type="hidden" name="ticket_div_start" value="{{ request('ticket_div_start') }}">
                                 <input type="hidden" name="ticket_div_end" value="{{ request('ticket_div_end') }}">
                              @endif
                              @if (request('closed_start') && request('closed_end'))
                                 <input type="hidden" name="closed_start" value="{{ request('closed_start') }}">
                                 <input type="hidden" name="closed_end" value="{{ request('closed_end') }}">
                              @endif

                              <input type="date" id="category_start" name="category_start" class="form-custom-control"
                                 value="{{ request('category_start') !== null ? request('category_start') : \Carbon\Carbon::parse('30 days ago')->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                              <span class="mx-2" style="margin-bottom: .5rem;">sampai</span>
                              <input type="date" id="category_end" name="category_end" class="form-custom-control"
                                 value="{{ request('category_end') !== null ? request('category_end') : \Carbon\Carbon::today()->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                           </form>
                        </div>

                     </div>
                     {{-- chart container --}}
                     <div class="chart-container mx-3">
                        <canvas id="categoryChart"></canvas>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-lg-6 mb-3">
               <div class="card border-0 shadow-sm">
                  <div class="card-body">
                     <div class="mb-4 border-bottom mx-3 d-flex">
                        <h4 class="flex-grow-1">Pengguna berdasarkan divisi</h4>
                        <div class="d-flex align-items-center">
                           <form action="/admin/dashboard" class="d-flex">
                              @if (request('status_start') && request('status_end'))
                                 <input type="hidden" name="status_start" value="{{ request('status_start') }}">
                                 <input type="hidden" name="status_end" value="{{ request('status_end') }}">
                              @endif
                              @if (request('category_start') && request('category_end'))
                                 <input type="hidden" name="category_start" value="{{ request('category_start') }}">
                                 <input type="hidden" name="category_end" value="{{ request('category_end') }}">
                              @endif
                              @if (request('ticket_div_start') && request('ticket_div_end'))
                                 <input type="hidden" name="ticket_div_start"
                                    value="{{ request('ticket_div_start') }}">
                                 <input type="hidden" name="ticket_div_end" value="{{ request('ticket_div_end') }}">
                              @endif
                              @if (request('closed_start') && request('closed_end'))
                                 <input type="hidden" name="closed_start" value="{{ request('closed_start') }}">
                                 <input type="hidden" name="closed_end" value="{{ request('closed_end') }}">
                              @endif

                              <input type="date" id="user_div_start" name="user_div_start"
                                 class="form-custom-control"
                                 value="{{ request('user_div_start') !== null ? request('user_div_start') : \Carbon\Carbon::parse('30 days ago')->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                              <span class="mx-2" style="margin-bottom: .5rem;">sampai</span>
                              <input type="date" id="user_div_end" name="user_div_end" class="form-custom-control"
                                 value="{{ request('user_div_end') !== null ? request('user_div_end') : \Carbon\Carbon::today()->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                           </form>
                        </div>
                     </div>
                     {{-- chart container --}}
                     <div class="chart-container mx-3 h-100">
                        <canvas id="userDepartementChart"></canvas>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-lg-6 mb-3">
               <div class="card border-0 shadow-sm">
                  <div class="card-body">
                     <div class="mb-4 border-bottom mx-3 d-flex">
                        <h4 class="flex-grow-1">Tiket berdasarkan divisi</h4>
                        <div class="d-flex align-items-center">
                           <form action="/admin/dashboard" class="d-flex">
                              @if (request('status_start') && request('status_end'))
                                 <input type="hidden" name="status_start" value="{{ request('status_start') }}">
                                 <input type="hidden" name="status_end" value="{{ request('status_end') }}">
                              @endif
                              @if (request('category_start') && request('category_end'))
                                 <input type="hidden" name="category_start" value="{{ request('category_start') }}">
                                 <input type="hidden" name="category_end" value="{{ request('category_end') }}">
                              @endif
                              @if (request('user_div_start') && request('user_div_end'))
                                 <input type="hidden" name="user_div_start" value="{{ request('user_div_start') }}">
                                 <input type="hidden" name="user_div_end" value="{{ request('user_div_end') }}">
                              @endif
                              @if (request('closed_start') && request('closed_end'))
                                 <input type="hidden" name="closed_start" value="{{ request('closed_start') }}">
                                 <input type="hidden" name="closed_end" value="{{ request('closed_end') }}">
                              @endif

                              <input type="date" id="ticket_div_start" name="ticket_div_start"
                                 class="form-custom-control"
                                 value="{{ request('ticket_div_start') !== null ? request('ticket_div_start') : \Carbon\Carbon::parse('30 days ago')->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                              <span class="mx-2" style="margin-bottom: .5rem;">sampai</span>
                              <input type="date" id="ticket_div_end" name="ticket_div_end"
                                 class="form-custom-control"
                                 value="{{ request('ticket_div_end') !== null ? request('ticket_div_end') : \Carbon\Carbon::today()->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                           </form>
                        </div>
                     </div>
                     {{-- chart container --}}
                     <div class="chart-container mx-3 h-100">
                        <canvas id="departementChart"></canvas>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-lg-12 mb-3 h-100">
               <div class="card border-0 shadow-sm">
                  <div class="card-body">
                     <div class="mb-4 border-bottom mx-3 d-flex">
                        <h4 class="flex-grow-1">Tiket selesai dalam {{ $date_diff }} hari terakhir</h4>
                        <div class="d-flex align-items-center">
                           <form action="/admin/dashboard" class="d-flex">
                              @if (request('status_start') && request('status_end'))
                                 <input type="hidden" name="status_start" value="{{ request('status_start') }}">
                                 <input type="hidden" name="status_end" value="{{ request('status_end') }}">
                              @endif
                              @if (request('category_start') && request('category_end'))
                                 <input type="hidden" name="category_start" value="{{ request('category_start') }}">
                                 <input type="hidden" name="category_end" value="{{ request('category_end') }}">
                              @endif
                              @if (request('user_div_start') && request('user_div_end'))
                                 <input type="hidden" name="user_div_start" value="{{ request('user_div_start') }}">
                                 <input type="hidden" name="user_div_end" value="{{ request('user_div_end') }}">
                              @endif
                              @if (request('ticket_div_start') && request('ticket_div_end'))
                                 <input type="hidden" name="ticket_div_start"
                                    value="{{ request('ticket_div_start') }}">
                                 <input type="hidden" name="ticket_div_end" value="{{ request('ticket_div_end') }}">
                              @endif

                              <input type="date" id="closed_start" name="closed_start" class="form-custom-control"
                                 value="{{ request('closed_start') !== null ? request('closed_start') : \Carbon\Carbon::parse('30 days ago')->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                              <span class="mx-2" style="margin-bottom: .5rem;">sampai</span>
                              <input type="date" id="closed_end" name="closed_end" class="form-custom-control"
                                 value="{{ request('closed_end') !== null ? request('closed_end') : \Carbon\Carbon::today()->format('Y-m-d') }}"
                                 onchange="javascript:this.form.submit();">
                           </form>
                        </div>
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
   <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
      integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
   </script>

   {{-- jQuery cdn --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

   {{-- Chart.js CDN --}}
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   {{-- Chart Script --}}
   <script>
      const statusData = {
         labels: ['Diproses', 'Selesai'],
         datasets: [{
            // label: 'My First dataset',
            backgroundColor: ['#9DC6FF', '#4993FA'],
            borderColor: '#FFFFFF',
            data: [{{ $count_open }}, {{ $count_closed }}],
         }]
      };

      const statusConfig = {
         type: 'bar',
         data: statusData,
         options: {
            maintainAspectRatio: false,
            barThickness: 35,
            indexAxis: 'y',
            base: 0,
            scales: {
               x: {
                  ticks: {
                     beginAtZero: true,
                     stepSize: 1,
                  },
               },
            },
            plugins: {
               legend: {
                  display: false,
                  position: 'right'
               }
            }
         },
      };

      const closedData = {
         labels: [
            @foreach ($date_count as $d)
               '{{ $d['date'] }}',
            @endforeach
         ],
         datasets: [{
            label: 'Tiket selesai',
            backgroundColor: ['#9DC6FF'],
            borderColor: '#FFFFFF',
            data: [
               @foreach ($date_count as $d)
                  {{ $d['value'] . ', ' }}
               @endforeach
            ]
         }],
      };

      const closedConfig = {
         type: 'bar',
         data: closedData,
         options: {
            base: 0,
            maintainAspectRatio: false,
            scales: {
               y: {
                  ticks: {
                     beginAtZero: true,
                     stepSize: 1,
                  },
               },
            },
            plugins: {
               legend: {
                  display: false,
               },
            },
         },
      };

      const categoryData = {
         labels: ['Komputer', 'Perangkat lunak', 'Jaringan'],
         datasets: [{
            // label: 'My First dataset',
            backgroundColor: ['#9DC6FF', '#4993FA', '#3A75C7'],
            borderColor: '#FFFFFF',
            data: [{{ $count_computer }}, {{ $count_software }}, {{ $count_network }}],
         }]
      };

      const categoryConfig = {
         type: 'bar',
         data: categoryData,
         options: {
            maintainAspectRatio: false,
            responsive: true,
            barThickness: 35,
            indexAxis: 'y',
            base: 0,
            scales: {
               x: {
                  ticks: {
                     beginAtZero: true,
                     stepSize: 1,
                  },
               },
            },
            plugins: {
               legend: {
                  display: false,
               }
            }
         },
      };

      const departementData = {
         labels: [
            @foreach ($departements as $d)
               '{{ $d->name }}',
            @endforeach
         ],
         datasets: [{
            backgroundColor: ['#A6FFDA', '#70FFC4', '#46E8D2', '#36D1E3', '#22B1F3', '#4892FA', '#176EE8',
               '#2E4BF0', '#2F25C2'
            ],
            borderColor: '#FFFFFF',
            data: [
               <?php
               foreach ($departements as $i => $d) {
                  $count[$i] = 0;
                  foreach ($user as $j => $u) {
                     if ($u->departement_id == $d->id) {
                           $ticket_count = $tickets->where('user_id', $u->id)->count();
                           $count[$i] += $ticket_count;
                     }
                  }
                  echo $count[$i] . ', ';
               }
               ?>
            ],
         }]
      };

      const departementConfig = {
         type: 'bar',
         data: departementData,
         options: {
            responsive: true,
            scales: {
               y: {
                  ticks: {
                     beginAtZero: true,
                     stepSize: 1,
                  },
               },
            },
            plugins: {
               legend: {
                  display: false,
               },
            },
         },
      };

      const userDepartementData = {
         labels: [
            @foreach ($departements as $d)
               '{{ $d->name }}',
            @endforeach
         ],
         datasets: [{
            backgroundColor: ['#A6FFDA', '#70FFC4', '#46E8D2', '#36D1E3', '#22B1F3', '#4892FA', '#176EE8',
               '#2E4BF0', '#2F25C2'
            ],
            borderColor: '#FFFFFF',
            data: [
               @foreach ($departements as $i => $d)
                  {{ $user_departement->where('departement_id', $d->id)->count() }},
               @endforeach
            ],
         }]
      };

      const userDepartementConfig = {
         type: 'bar',
         data: userDepartementData,
         options: {
            responsive: true,
            indexAxis: 'x',
            base: 0,
            scales: {
               y: {
                  ticks: {
                     beginAtZero: true,
                     stepSize: 1,
                  },
               },
            },
            plugins: {
               legend: {
                  display: false,
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
      const departementChart = new Chart(document.getElementById('departementChart'), departementConfig);
      const userDepartementChart = new Chart(document.getElementById('userDepartementChart'), userDepartementConfig);
   </script>

   {{-- live date script --}}
   <script>
      $('document').ready(function() {
         var interval = setInterval(function() {
            var date = new Date();
            var d = date.getDate();
            var day = (d < 10) ? "0" + d : d;
            var m = date.getMonth() + 1;
            var month = (m < 10) ? "0" + m : m;
            var year = date.getFullYear();
            $('#date').html(day + '/' + month + '/' + year);
            var h = date.getHours();
            var hour = (h < 10) ? "0" + h : h;
            var m = date.getMinutes();
            var minute = (m < 10) ? "0" + m : m;
            var s = date.getSeconds();
            var second = (s < 10) ? "0" + s : s;
            var milisecond = date.getMilliseconds();
            $('#time').html(hour + ':' + minute + ':' + second);
         }, 100);
      });
   </script>
@endsection
