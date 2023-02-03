@extends('layouts.app')
@section('title','Dashboard')

@section('admin_content')
    <main>
        <div class="pt-6 px-4 bg-gray-900">
            <!--  -->
            <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold ">₱ {{number_format((double)$old_total, 2, '.', '');}}</span>
                            <h3 class="text-base font-normal text-gray-500">Sales <span class="bg-green-400 text-xs font-normal text-white font-bold py-1 px-2 rounded-full">
                            THIS YEAR
                        </span></h3>
                        </div>
                        <!-- <div class="flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                            12.5%
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div> -->
                    </div>
                    <div id="main-chart"></div>
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold  mb-2">Latest Transactions</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of latest transactions</span>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="/sales-report" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                        </div>
                    </div>
                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow overflow-hidden sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Transaction
                                            </th>
                                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date & Time
                                            </th>
                                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                        @foreach($invoice as $key=>$in)
                                        @if($key>=7)
                                        @else
                                        <tr>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal ">
                                                Cashier <span class="font-semibold">{{$in->user->name}}</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                            <?php
                                                $date = new DateTime($in->created_at);
                                                $result = $date->format('F j, Y h:m a');
                                            ?>    
                                            {{$result}}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold ">
                                            ₱ {{$in->total}}
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                        <span class="text-2xl sm:text-3xl leading-none font-bold ">₱ {{ number_format((double)$revenue, 2, '.', '');}}</span>
                        <h3 class="text-base font-normal text-gray-500">Total Revenue</h3>
                        <span class="bg-green-400 text-xs font-normal text-white font-bold py-1 px-2 rounded-full">
                            THIS MONTH
                        </span>
                        </div>
                        <!-- <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        </div> -->
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                        <span class="text-2xl sm:text-3xl leading-none font-bold ">{{$dishes}}</span>
                        <h3 class="text-base font-normal text-gray-500">Total Dishes Ordered</h3>
                        <span class="bg-green-400 text-xs font-normal text-white font-bold py-1 px-2 rounded-full">
                            THIS MONTH
                        </span>
                        </div>
                        <!-- <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        </div> -->
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                        <span class="text-2xl sm:text-3xl leading-none font-bold ">{{$customers}}</span>
                        <h3 class="text-base font-normal text-gray-500">Total Customers Served</h3>
                        <span class="bg-green-400 text-xs font-normal text-white font-bold py-1 px-2 rounded-full">
                            THIS MONTH
                        </span>
                        </div>
                        <!-- <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- MOST ORDERED -->
            <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 mb-4">
                <div class="bg-white shadow rounded-lg mb-4 my-4 p-4 sm:p-6 h-full">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold leading-none ">Most Ordered</h3>
                        <!-- <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                        View all
                        </a> -->
                    </div>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($sales as $key=>$sl)
                            @if($key>=5)
                            @else
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($sl->menu->photo_path==null)
                                            <img class="h-8 w-8 rounded-full" src="{{ asset('storage/default2.png') }}" alt="menu-profile">
                                        @else
                                            <?php
                                                $str = $sl->menu->photo_path;
                                                $str = ltrim($str, 'public/');
                                            ?>
                                            <img class="h-8 w-8 rounded-full" src="{{ asset('../storage/'.$str) }}" alt="menu-profile">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium  truncate">
                                          {{$sl->menu->menu_name}}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                        <a href="/cdn-cgi/l/email-protection" >
                                            {{$sl->menu->branch->branch_name}}
                                        </a>
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold ">
                                    ₱ {{$sl->menu->price}}
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 ">
                <div class="bg-white shadow rounded-lg mb-4 my-4 p-4 sm:p-6 xl:p-8 ">
                    <h3 class="text-xl leading-none font-bold  mb-10">Inventory</h3>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Product Name</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Total Items</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Number of Items</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($inventory as $key=>$inv)
                            @if($key>=5)
                            @else
                            <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{$inv->product_name}}</th>
                                <td class="border-t-0 px-4 align-middle text-xs font-medium  whitespace-nowrap p-4">{{$inv->quantity}}</td>
                                <td class="border-t-0 px-4 align-middle text-xs font-medium  whitespace-nowrap p-4">{{$inv->remaining}}</td>
                                <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                    <span class="mr-2 text-xs font-medium">
                                        {{$inv->remaining}}
                                    </span>
                                    <div class="relative w-full">
                                        <div class="w-full bg-gray-200 rounded-sm h-2">
                                            <div class="bg-cyan-600 h-2 rounded-sm" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>     
@endsection

@section('scripts')
    <script>
        // Sidebar
        $('[id^="sidebar-"]').removeClass('text-white')
        $('#sidebar-dashboard').addClass('text-white')

        // Apex Chart Initialize
        var options = {
            series: [{
                name: '',
                data: [],
            }],
            chart: {
                type: 'area',
                height: 450,
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return parseInt(val);
                },
            },
            stroke: {
                curve: 'smooth'
            },
            subtitle: {
                text: 'Water Level Movements',
                align: 'left'
            },
            labels: [],
            xaxis: {
                type: 'datetime',
            },
            yaxis: {
                opposite: true,
            },
            legend: {
                horizontalAlign: 'left'
            },
        }
        var chart = new ApexCharts(document.querySelector("#main-chart"), options);

        // Chart
        chart.render();
        chart.updateSeries([{
            name: 'Revenue',
            data: @json($val)
        }])
        chart.updateOptions({
            labels: @json($dt),
        })
    </script>
@endsection