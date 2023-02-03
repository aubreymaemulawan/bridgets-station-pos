@extends('layouts.app')
@section('title','Sales Report')

@section('modal')
    <!-- Error Modal -->
    <div id="error-modal" role="dialog" aria-labelledby="error-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="p-6 text-center">
                <svg aria-hidden="true" class="text-red-500 fill-current mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                    <h3 id="error-label" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- / Error Modal -->

    <!-- Success Modal -->
    <div id="success-modal" role="dialog" aria-labelledby="success-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="text-emerald-500 fill-current mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                    <h3 id="success-label" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- / Success Modal -->
@endsection

@section('admin_content')
<main>
    <div class="py-6 px-4 bg-gray-900">
        <div class="block p-6 rounded-lg shadow-lg bg-white">
            <h1 class="text-xl">
                <b>Sales Report</b>
            </h1>
            <p class="pb-3">Generate Sales Report</p>
            <form>
                <div class="form-group grid grid-cols-3 gap-2 "> 
                    <div class="datepicker relative form-floating" data-mdb-toggle-button="false">
                    <label for="floatingInput" class="text-gray-700 text-sm">Starting Date</label>
                        <input value="0"  id="start_date" name="start_date" type="date" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"/>
                        <button class="datepicker-toggle-button" data-mdb-toggle="datepicker">
                            <i class="fas fa-calendar datepicker-toggle-icon"></i>
                        </button>
                    </div>
                    <div class="datepicker relative form-floating mb-3 " data-mdb-toggle-button="false">
                        <label for="floatingInput" class="text-gray-700 text-sm">Ending Date</label>
                        <input value="0" id="end_date" name="end_date" type="date" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"/>
                        <button class="datepicker-toggle-button" data-mdb-toggle="datepicker">
                            <i class="fas fa-calendar datepicker-toggle-icon"></i>
                        </button>
                    </div>
                    <div>
                        <button onclick="GenerateData()" type="button" class=" w-full px-6 mt-5 py-4 bg-emerald-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-emerald-700 hover:shadow-lg focus:bg-emerald-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-emerald-800 active:shadow-lg transition duration-150 ease-in-out">
                            Generate Data
                        </button>
                    </div>

                    
                </div>
                
            </form>
            <div id="download">
                    <button onclick="GeneratePDF()" class="rounded-full bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                        PDF
                    </button>
                    <button onclick="GenerateIMG()" class="rounded-full bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded">
                        IMG
                    </button>
                </div>
        </div>
    </div>
</main>

<main id="data" class="bg-white">
    <div class="py-6 px-4 bg-white ">
        <div class="block p-6 bg-white">
            <h1 class="text-xl">
                <b>Bridget's Station</b>
            </h1>
            <p>Sales Report</p>
            <p class="text-sm"><b>Starting Date:</b> <span id="stdate">  </span> | <b>Ending Date:</b> <span id="eddate" > </span></p>
            
        </div>
        <div class="flex flex-col bg-white px-3">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="pb-2 pt-5 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left"> </th>
                                @foreach($branch as $br)
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left border"> {{strtoupper($br->branch_name)}}</th>
                                @endforeach
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left border"> Total </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="gross" class="border-b">
                            </tr>
                            <tr id="discounts" class="bg-white border border-b">
                            </tr>
                            <tr id="net_sales" class="bg-gray-300 border border-b">
                            </tr>
                            <tr id="sales_tax" class="bg-white border-b">
                            </tr>
                            <tr id="gross_receipts" class="bg-slate-300 border border-b">
                            </tr>
                            <tr id="less_paid_outs" class="bg-white border-b">
                            </tr>
                            <tr id="cash_to_account" class="bg-green-400 border border-b">
                            </tr>
                        </tbody>
                    </table>
                </div>
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
        $('#sidebar-salesReport').addClass('text-white')
        $(document).ready(function (e) {
            $('#data').hide();
            $('#download').hide();
        })

        function GenerateData(){
            $('#data').hide();
            $('#download').hide();
            $('#gross').html('');
            $('#discounts').html('');
            $('#sales_tax').html('');
            $('#net_sales').html('');
            $('#gross_receipts').html('');
            $('#less_paid_outs').html('');
            $('#cash_to_account').html('');
            if($('#start_date').val() == 0 || $('#end_date').val() == 0 || $('#start_date').val() > $('#end_date').val()){
                document.getElementById('error-label').innerHTML='Oops! Invalid Input.';
                $('#error-modal').fadeIn().delay(1000).fadeOut();
                
            }else{
            var start = $('#start_date').val()+' 00:00:00';
            var end = $('#end_date').val()+' 23:59:59';
            var gross_total = 0;
            var discount_total = 0;
            var sales_tax_total = 0;
            var net_sales_total = 0;
            var gross_receipts_total = 0;
            var less_paid_outs_total = 0;
            var cash_to_account_total = 0;
            $('#stdate').html(moment(start).format('MMMM Do YYYY'));
            $('#eddate').html(moment(end).format('MMMM Do YYYY'));


            Controller.Post('/api/sales/generate', { 'start': start, 'end': end,}).done(function(result) {

                // DISCOUNTS
                $('#gross').append('<td class="px-6 py-4 border whitespace-nowrap text-sm font-medium text-gray-900">Gross Sales</td>');
                $.each(result, function( index, data ) {
                    gross_total += data.data.gross;
                    $('#gross').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+data.data.gross+'</td>');
                })
                $('#gross').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+gross_total+'</td>');
            
                // DISCOUNTS
                $('#discounts').append('<td class="px-6 py-4 border whitespace-nowrap text-sm font-medium text-gray-900">Less Discounts & Comps</td>');
                $.each(result, function( index, data ) {
                    discount_total += data.data.discount;
                    $('#discounts').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+data.data.discount+'</td>');
                })
                $('#discounts').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+discount_total+'</td>');

                // SALES TAX
                $('#sales_tax').append('<td class="px-6 py-4 border whitespace-nowrap text-sm font-medium text-gray-900">Sales Tax</td>');
                $.each(result, function( index, data ) {
                    sales_tax_total += data.data.sales_tax;
                    $('#sales_tax').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+data.data.sales_tax+'</td>');
                })
                $('#sales_tax').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+sales_tax_total+'</td>');

                // NET SALES
                $('#net_sales').append('<td class="px-6 py-4 border whitespace-nowrap text-sm font-medium text-gray-900">Net Sales</td>');
                $.each(result, function( index, data ) {
                    net_sales_total += data.data.net_sales;
                    $('#net_sales').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+data.data.net_sales+'</td>');
                })
                $('#net_sales').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+net_sales_total+'</td>');

                // GROSS RECEIPTS
                $('#gross_receipts').append('<td class="px-6 py-4 border whitespace-nowrap text-sm font-medium text-gray-900">Gross Receipts</td>');
                $.each(result, function( index, data ) {
                    gross_receipts_total += data.data.gross_receipts;
                    $('#gross_receipts').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+data.data.gross_receipts+'</td>');
                })
                $('#gross_receipts').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+gross_receipts_total+'</td>');

                // LESS PAID OUTS
                $('#less_paid_outs').append('<td class="px-6 py-4 border whitespace-nowrap text-sm font-medium text-gray-900">Less Paid Outs</td>');
                $.each(result, function( index, data ) {
                    less_paid_outs_total += data.data.less_paid_outs;
                    $('#less_paid_outs').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+data.data.less_paid_outs+'</td>');
                })
                $('#less_paid_outs').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+less_paid_outs_total+'</td>');

                // CASH IN ACCOUNT
                $('#cash_to_account').append('<td class="px-6 py-4 border whitespace-nowrap text-sm font-medium text-gray-900">CASH TO ACCOUNT</td>');
                $.each(result, function( index, data ) {
                    cash_to_account_total += data.data.cash_to_account;
                    $('#cash_to_account').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+data.data.cash_to_account+'</td>');
                })
                $('#cash_to_account').append('<td class="text-sm border text-gray-900 font-light px-6 py-4 whitespace-nowrap"> ₱'+cash_to_account_total+'</td>');
            
            $('#download').show();
            $('#data').show();
            })}
        
        }

        // Date for filename
        var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;

        // Generate PDF
        function GeneratePDF(){
            // Document Resizing
            var HTML_Width = $("#data").width();
            var HTML_Height = $("#data").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
            // HTML2Canvas
            html2canvas($("#data")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("BridgetsStation-Sales-"+today+".pdf");
                document.getElementById("success-label").innerHTML= "Data Report has been successfully downloaded!";
                $('#success-modal').fadeIn().delay(5000).fadeOut();
            });
        }

        // Generate IMG
        function GenerateIMG(){
            html2canvas(document.querySelector("#data")).then(canvas => {
                a = document.createElement('a'); 
                document.body.appendChild(a); 
                a.download = "BridgetsStation-Sales-"+today+".png";
                a.href =  canvas.toDataURL();
                a.click();
                document.getElementById("success-label").innerHTML= "Data Report has been successfully downloaded!";
                $('#success-modal').fadeIn().delay(5000).fadeOut();
            });
        }

    </script>
@endsection