<!DOCTYPE html>
<html lang="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<head>

    <head>
        <title>Part Time Report - {{ $employee }}</title>
        <style>

            .allownce-line{
                text-align: center;
                display: flex;
                justify-content: end;
                align-items: center;
            }
            .allownce-line span{
                border-left: 3px solid green;
                height: 42px;
                border-bottom: 3px solid green;
                width: 50%;
            }
            .deduction-line{
                text-align: center;
                display: flex;
                justify-content: start;
                align-items: center;
            }
            .deduction-line span{
                border-right: 3px solid green;
                height: 42px;
                border-bottom: 3px solid green;
                width: 50%;
            }
            body {
                font-family: Arial, Helvetica, sans-serif;

            }

            @page {
                margin: 10px 10px 10px 10px !important;
                padding: 10px1 0px 10px 10px !important;
            }

            table {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: separate;
                width: 100%;
            }

            table th {
                border: 1px solid #000;
                padding: 2px
            }

            table th {
                text-align: center;
                background-color: #F7F9F9;
                color: black;
            }

            table td {
                text-align: center;
                padding-bottom: 5px;
                padding: 8px;
                border-collapse: collapse;
            }

            .column {
                float: left;
                width: 50%;
                padding: 10px;
            }

            .row:after {
                content: "";
                display: table;
                clear: both;
            }
        </style>

    </head>

<body id="element-to-print">


    <div style="padding:5mm; margin: bottom 25px;">
        <div class="row">
            <div class="column" style="width:20%">
                <img src="/storage/company/{{ $image }}" height="70" width="160" />

            </div>
            <div class="column" style="width:70%">
                <p style="font-size:18px;text-align:center"><b>{{ $company }}</b></p>
            </div>
        </div>
    </div>



    <div style="color: white;background-color: #03415F;" class="row">
        <div class="column" style="padding:4px;width: 100%">
            <p style="text-align: center; font-size:18px;color: #fff;margin:0;padding:5;"><b>Slip Report</b>
            </p>
        </div>
    </div>


    <br>


    <div class="row" style="background: #03415F; ma">
        <div class="column" style="padding:0; width:20%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">Employee :</p>
        </div>
        <div class="column" style="padding:0;margin-left:3px; width:33%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $employee }} -
                {{ $employee_id }}</p>
        </div>



        <div class="column" style="padding:0; width:10%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">date :</p>
        </div>

        <div class="column" style="padding:0;margin-left:3px; width:14%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $date }}</p>
        </div>

        
    </div>

    <div class="row" style="background: #03415F; ma">
        <div class="column" style="padding:0; width:20%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">Department :</p>
        </div>
        <div class="column" style="padding:0;margin-left:3px; width:33%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $department }} -
                {{ $position }}</p>
        </div>
        <div class="column" style="padding:0; width:20%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">salary :{{ $salary }} </p>
        </div>
        {{-- <div class="column" style="padding:0;margin-left:3px; width:33%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $salary }} -</p>
        </div> --}}


    </div>



    <br>

    <div class="tables row">
        <div class="p-3 allownce-table col-md-6 col-12">
            <h2 class="text-center">العلاوات</h2>
            <table class="allownce">
                <tr>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">نوع العلاوة</th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">المبلغ</th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">التاريخ</th>
                </tr>
                @php($totalAllownce=0)
                @foreach ($allownce as $item)
                @php($totalAllownce+=$item->amount)
                    <tr>
                        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                            @if($item->type ===1) {{'العمل الاضافي بالايام العاديه'}}
                                        @elseif($item->type ===2){{"مكافأت"}}
                                        @elseif($item->type ===3){{"بدل مواصلات"}}
                                        @elseif($item->type ===4){{"العمل الاضافي ايام العطل"}}
                                        @else {{'other'}}
                                    @endif
                                </td>
                        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->amount}}</td>
                        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->date}}</td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%"></th>
                        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">{{$totalAllownce}}</th>
                        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">المجموع</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="p-3 deduction-table col-md-6 col-12">
            <h2 class="text-center">الخصومات</h2>
            <table class="deduction">        
            <tr>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">نوع الخصم</th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">المبلغ</th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">التاريخ</th>
            </tr>
            @php($totalDeduction=0)
            @foreach ($deduction as $item)
            @php($totalDeduction+=$item->amount)
                <tr>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                        @if($item->type ===1) {{'lateness'}}
                        @elseif($item->type ===2){{"Social Security"}}
                        @elseif($item->type ===3){{"Tax"}}
                        @elseif($item->type ===4){{"Loans"}}
                        @else {{'other'}}
                        @endif
                    </td>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->amount}}</td>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->date}}</td>
                </tr>
            @endforeach
            <tfoot>
                <tr>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%"></th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">{{$totalDeduction}}</th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">المجموع</th>
                </tr>
            </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-5 allownce-line"><span></span></div>
        <div class="col-2 d-flex align-item-center justify-content-center"><h4 class="m-0 align-self-end">المجموع = <span class="border p-1">{{$totalAllownce - $totalDeduction}}</span></h4></div>
        <div class="col-5 deduction-line"><span></span></div>
    </div>
    <div class="tables row">
        <div class="p-3 d-flex align-item-center justify-content-center total col-md-6 col-12 text-center">
                <h2 class="text-right align-self-end">صافي الراتب : <span class="border p-2 border-info rounded">{{$salary +$totalAllownce - $totalDeduction}}</span></h2>
        </div>
        <div class="p-3 checks-table col-md-6 col-12">
            <h2 class="text-center">الرواتب</h2>
            <table class="checks">        
            <tr>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%"> التفاصيل</th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">المبلغ</th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">التاريخ</th>
            </tr>
            @php($totalChecks=0)
            @foreach ($checks as $item)
            @php($totalChecks+=$item->value)
                <tr>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->check_details}}</td>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->value}}</td>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->date}}</td>
                </tr>
            @endforeach
            <tfoot>
                <tr>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%"></th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">{{$totalChecks}}</th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">المجموع</th>
                </tr>
            </tfoot>
            </table>
        </div>
        
</div>

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    window.onload = function() {
        var element = document.getElementById('element-to-print');
        html2pdf()
            .from(element)
            .set({
                margin: 10,
                filename: 'your-document.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            })
            .outputPdf(function(pdf) {
                var blob = pdf.output('blob');
                var url = URL.createObjectURL(blob);
                var iframe = document.createElement('iframe');
                iframe.src = url;
                iframe.style.width = '100%';
                iframe.style.height = '600px';
                document.body.appendChild(iframe);
            });
    }
</script>







