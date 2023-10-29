<!DOCTYPE html>
<html>

<head>

    <head>
        <title>Part Time Report - {{ $employee }}</title>
        <style>
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

<body>


    <div style="padding:5mm; margin: bottom 25px;">
        <div class="row">
            <div class="column" style="width:20%">
                {{-- <img src="/storage/company/{{ $image }}" height="70" width="160" /> --}}

            </div>
            <div class="column" style="width:70%">
                <p style="font-size:18px;text-align:center"><b>{{ $company }}</b></p>
            </div>
        </div>
    </div>



    <div style="color: white;background-color: #03415F;" class="row">
        <div class="column" style="padding:4px;width: 100%">
            <p style="text-align: center; font-size:18px;color: #fff;margin:0;padding:5;"><b>Part Times Report</b>
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
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">From :</p>
        </div>

        <div class="column" style="padding:0;margin-left:3px; width:14%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $from }}</p>
        </div>

        <div class="column" style="padding:0; width:10%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">To :</p>
        </div>
        <div class="column" style="padding:0;margin-left:3px; width:10%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $to }}</p>
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



    </div>
    <br>
<table id="account">
    <tr>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">From</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">To</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Debit</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Credit</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Balance</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Details</th>
    </tr>
    @php($total = 0)
    @php($totalDebit =0)
    @php($totalCredit =0)

    @foreach ($partTime as $pt)
    @php($total += $pt->amount)
    @php($totalDebit +=$pt->amount)
        <tr>
            <td style="text-align: center;padding-top: 8px; width: 10%">{{ $pt->from }}</td>
            <td style="text-align: center;padding-top: 8px; width: 10%">{{ $pt->to }}</td>
            <td style="text-align: center;padding-top: 8px; width: 10%">{{ $pt->amount }}</td>
            <td style="text-align: center;padding-top: 8px; width: 10%"></td>
            <td style="text-align: center;padding-top: 8px; width: 10%">{{ $total }}</td>
            <td style="text-align: center;padding-top: 8px; width: 10%; "></td>
        </tr>
        {{ $pt->id }}
    @endforeach

    @foreach ($information as $info)
    @if ($info["transaction"] =="checks" || $info["transaction"] =="allownce")
    @php($total -= $info["amount"])
    @php($totalCredit +=$info["amount"])
    @else
    @php($total +=$info["amount"])
    @php($totalDebit +=$info["amount"])
    @endif
    <tr>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $info["date"] }}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $info["type"] }}</td>
        @if ($info["transaction"] =="dedction")
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $info["amount"] }}</td>
        @else <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">-</td>
        @endif
        @if ($info["transaction"] =="checks" || $info["transaction"] =="allownce")
              <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $info["amount"] }}</td>
        @else <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">-</td>
        @endif
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $total }}
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $info["detail"] }}</td>
        </td>
    </tr>
    @endforeach
    @if ( count($partTime) > 0)
    <tr>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%"
            colspan="2">Total:</th>
            
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                {{ $totalDebit }}
            </th>
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                {{ $totalCredit }}
            </th>
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                {{ $total }}
            </th>
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
            </th>
            
    </tr>
@else
    <tr>
        <th style="text-align: center; color: #03415F; font-size: 17px; width: 11% "colspan="5"> No Records
        </th>

    </tr>
@endif
</table>








    {{-- <table id="account">
        <tr>
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">From</th>
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">To</th>
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Debit</th>
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Credit</th>
            <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Balance
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Details
            </th>
        </tr>

        @php($total = 0)
        @php($totalDebit =0)
        @php($totalCredit =0)

        @foreach ($partTime as $pt)
            @php($total += $pt->amount)
            @php($totalDebit +=$pt->amount)
            <tr>
                <td style="text-align: center;padding-top: 8px; width: 10%">{{ $pt->from }}</td>
                <td style="text-align: center;padding-top: 8px; width: 10%">{{ $pt->to }}</td>
                <td style="text-align: center;padding-top: 8px; width: 10%">{{ $pt->amount }}</td>
                <td style="text-align: center;padding-top: 8px; width: 10%"></td>
                <td style="text-align: center;padding-top: 8px; width: 10%">{{ $total }}</td>
                <td style="text-align: center;padding-top: 8px; width: 10%; "></td>

            </tr>
            {{ $pt->id }}
        @endforeach
        
        <tr>
            <td style="text-align: center;padding-top: 8px; width: 10%" colspan="5"></td>
        </tr>

        @foreach ($checks as $check)
            @php($total -= $check->Value)
            @php($totalCredit +=$check->Value)
            <tr>
                <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $check->Date }}</td>
                <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $check->Payment_Method }}</td>
                <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;"></td>
                <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $check->Value }}</td>
                <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $total }}
                <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{ $check->check_details }}</td>
                </td>
            </tr>
        @foreach ($dedction as $item)
        @php($total -=$item->amount)
        @php($totalCredit +=$item->amount)
        <tr>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->date}}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->type}}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">-</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->amount}}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$total}}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->detail}}</td> 
</tr>
@endforeach
@foreach ($allownce as $item)
@php($total +=$item->amount)
@php($totalDebit +=$item->amount)
<tr>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->date}}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->type}}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->amount}}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">-</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$total}}</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->detail}}</td>
</tr>
@endforeach 
            {{ $check->id }}
        @endforeach
        @if (count($checks) > 0 || count($partTime) > 0)
            <tr>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%"
                    colspan="2">Total:</th>
                    
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                        {{ $totalDebit }}
                    </th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                        {{ $totalCredit }}
                    </th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                        {{ $total }}
                    </th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                    </th>
                    
            </tr>
        @else
            <tr>
                <th style="text-align: center; color: #03415F; font-size: 17px; width: 11% "colspan="5"> No Records
                </th>
 
            </tr>
        @endif




    </table> --}}
</body>

</html>
