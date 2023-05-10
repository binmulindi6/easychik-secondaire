@extends('layouts.admin')

@section('content')
    
          <!-- cards -->
      <div class="w-full px-6 py-0.6 mx-auto">
            <!-- row 1 -->
        @if (Auth::user()->isAdmin() || Auth::user()->isDirecteur())
          <div class="flex flex-wrap -mx-3">
            <!-- card3 -->
                <a href="{{route("classes.index")}}" class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                  <div class="relative flex flex-col min-w-0 break-words bg-white hover:bg-slate-200 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                      <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                          <div>
                            <p class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Classes</p>
                            <h5 class="mb-2 font-bold dark:text-white">{{$classes}}</h5>
                          </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                          <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                            <i class="fa fa-solid fa-chalkboard text-size-lg relative top-3.5 text-white"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>


              <!-- card1 -->
              <a href="{{route("employers.index")}}" class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white hover:bg-slate-200 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                      <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                          <p class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Employers</p>
                          <h5 class="mb-2 font-bold dark:text-white">{{$employers}}</h5>
                          <!--p class="mb-0 dark:text-white dark:opacity-60">
                            <span class="font-bold leading-normal text-size-sm text-emerald-500">+55%</span>
                            since yesterday
                          </p-->
                        </div>
                      </div>
                      <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                          <i class="fa fa-solid fa-user text-size-lg relative top-3.5 text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               </a>
    
              <!-- card2 -->
              <a href="{{route("eleves.index")}}" class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white hover:bg-slate-200 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                      <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                          <p class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Eleves</p>
                          <h5 class="mb-2 font-bold dark:text-white">{{$eleves}}</h5>

                        </div>
                      </div>
                      <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                          <i class="fa fa-solid fa-user text-size-lg relative top-3.5 text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               </a>
    
    
              <!-- card4 -->
              <a href="{{route("users.index")}}" class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white hover:bg-slate-200 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                      <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                          <p class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Utilisateurs</p>
                          <h5 class="mb-2 font-bold dark:text-white">{{$users}}</h5>
                        </div>
                      </div>
                      <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                          <i class="fa fa-solid fa-user text-size-lg relative top-3.5 text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </a>
          </div>
        @else
          @if (isset($trimestre))
          <div class="flex flex-auto gap-5">
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Annee Scolaire en cours:</span>
                <span class="font-bold text-2xl"> {{$annee->nom}} </span>
            </div>
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Trimestre en cours:</span>
                <span class="font-bold text-2xl"> {{$trimestre->nom}} </span>
            </div>
            <div class="bg-white rounded-5 p-5 shadow-2xl flex flex-col gap-1">
                <span class="font-base text-sm text-slate-500 uppercase">Periode en cours:</span>
                <span class="font-bold text-2xl"> {{$periode->nom}} </span>
            </div>
        </div>
          @endif

        @endif
    
            <!-- cards row 2 -->
            <div class="flex flex-wrap mt-6 -mx-3">
              <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                  <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                        <h6 class="capitalize dark:text-white">Frequentations des Eleves</h6>
                        <p class="mb-0 leading-normal dark:text-white dark:opacity-60 text-size-sm">
                        <i class="fa fa-arrow-up text-emerald-500"></i>
                        <span class="font-semibold">240% plus</span> en 2022-2023
                        </p>
                  </div>
                  <div class="flex-auto p-4">
                    <div>
                      <canvas id="chart-line" height="300"></canvas>
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
                  <!-- slide 3 -->
                  <div slide class="absolute w-full h-full transition-all duration-500">
                    <img class="object-cover h-full" src="{{asset('storage/students.jpg')}}" alt="carousel image" />
                    <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                      <div class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                        <i class="top-0.75 text-size-xxs relative text-slate-700 ni ni-trophy"></i>
                      </div>
                      <h5 class="mb-1 text-white">Use SAS</h5>
                      <p class="mb-0 dark:text-white dark:opacity-60">
                      <p class="dark:opacity-80 font-semibold">School Administation System,
                        The Solution for your School
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>

    <script defer >
      
      //   if(document.querySelector("#chart-line")){
      // var ctx1 = document.getElementById("chart-line").getContext("2d");
    
      // var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
    
      // gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
      // gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
      // gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
      // new Chart(ctx1, {
      //   type: "line",
      //   data: {
      //     labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      //     datasets: [{
      //       label: "Eleves",
      //       tension: 0.4,
      //       borderWidth: 0,
      //       pointRadius: 0,
      //       borderColor: "#5e72e4",
      //       backgroundColor: gradientStroke1,
      //       borderWidth: 3,
      //       fill: true,
      //       data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
      //       maxBarThickness: 6
    
      //     }],
      //   },
      //   options: {
      //     responsive: true,
      //     maintainAspectRatio: false,
      //     plugins: {
      //       legend: {
      //         display: false,
      //       }
      //     },
      //     interaction: {
      //       intersect: false,
      //       mode: 'index',
      //     },
      //     scales: {
      //       y: {
      //         grid: {
      //           drawBorder: false,
      //           display: true,
      //           drawOnChartArea: true,
      //           drawTicks: false,
      //           borderDash: [5, 5]
      //         },
      //         ticks: {
      //           display: true,
      //           padding: 10,
      //           color: '#fbfbfb',
      //           font: {
      //             size: 11,
      //             family: "Open Sans",
      //             style: 'normal',
      //             lineHeight: 2
      //           },
      //         }
      //       },
      //       x: {
      //         grid: {
      //           drawBorder: false,
      //           display: false,
      //           drawOnChartArea: false,
      //           drawTicks: false,
      //           borderDash: [5, 5]
      //         },
      //         ticks: {
      //           display: true,
      //           color: '#ccc',
      //           padding: 20,
      //           font: {
      //             size: 11,
      //             family: "Open Sans",
      //             style: 'normal',
      //             lineHeight: 2
      //           },
      //         }
      //       },
      //     },
      //   },
      // });
      // }
    </script>
    
@endsection



