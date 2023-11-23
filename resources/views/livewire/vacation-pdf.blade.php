<div>
    <!DOCTYPE html>
<html>

<head>

    <head>
        <title>vacation report</title>
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
                <p style="font-size:18px;text-align:center"><b>{{ $user['company'] }}</b></p>
            </div>
        </div>
    </div>
    <div style="color: white;background-color: #03415F;" class="row">
        <div class="column" style="padding:4px;width: 100%">
            <p style="text-align: center; font-size:18px;color: #fff;margin:0;padding:5;"><b>Vacation Report</b>
            </p>
        </div>
    </div>
    <br>
    <div class="row" style="background: #03415F; ma">
        <div class="column" style="padding:0; width:20%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">Employee :</p>
        </div>
        <div class="column" style="padding:0;margin-left:3px; width:33%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $user['name']}} -
                {{ $user["id"] }}</p>
        </div>



        <div class="column" style="padding:0; width:10%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">From :</p>
        </div>

        <div class="column" style="padding:0;margin-left:3px; width:14%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{$date}}-01-01</p>
        </div>

        <div class="column" style="padding:0; width:10%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">To :</p>
        </div>
        <div class="column" style="padding:0;margin-left:3px; width:10%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{$date}}-12-01</p>
        </div>
    </div>

    <div class="row" style="background: #03415F; ma">
        <div class="column" style="padding:0; width:20%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">Department :</p>
        </div>
        <div class="column" style="padding:0;margin-left:3px; width:33%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $user['department'] }} -
                {{ $user["position"] }}</p>
        </div>

        <div class="column" style="padding:0; width:20%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">Annual Vacation :{{ $user->annual_vacation }}</p>
        </div>
        <div class="column" style="padding:0; width:20%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">Sick Vacation :{{ $user->sick_vacation }}</p>
        </div>
    </div>
    <br>
<table id="account">
    <tr>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">Vacation Date</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">Vacation End Date</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">Period</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">Annual Vacation</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">Sick Vacation</th>
    </tr>
    @php($total_annual = 0)
    @php($total_sick = 0)
    @foreach ($vacations as $item)
        @php($total_annual += $item->type == 1 ?  $item->period : 0)
        @php($total_sick += $item->type == 0 ?  $item->period : 0)
    <tr>
        <td>{{$item->date}}</td>
        <td>{{$item->endDate}}</td>
        <td>{{$item->period}}</td>
        <td>{{$item->type == 1 ? $item->period : ""}}</td>
        <td>{{$item->type == 0 ? $item->period : ""}}</td>
    </tr>
    @endforeach
    <tfoot>
        <tr>
            <td style="background-color: #327ea3;color:white">Total</td>
            <td style="background-color: #327ea3;color:white">-</td>
            <td style="background-color: #327ea3;color:white">{{$total_annual + $total_sick}}</td>
            <td style="background-color: #327ea3;color:white">{{$total_annual}}</td>
            <td style="background-color: #327ea3;color:white">{{$total_sick}}</td>
        </tr>
    </tfoot>
</table>
</body>
</html>

</div>
