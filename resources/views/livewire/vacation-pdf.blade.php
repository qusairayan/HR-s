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
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $user['name']}} -
                {{ $user["id"] }}</p>
        </div>



        <div class="column" style="padding:0; width:10%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">From :</p>
        </div>

        <div class="column" style="padding:0;margin-left:3px; width:14%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold"></p>
        </div>

        <div class="column" style="padding:0; width:10%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">To :</p>
        </div>
        <div class="column" style="padding:0;margin-left:3px; width:10%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold"></p>
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

        <div class="column" style="padding:0; width:10%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">Salary :</p>
        </div>
        <div class="column" style="padding:0;margin-left:3px; width:10%">
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $user['salary'] }} JD -  {{$user["part_time"]}}</p>
        </div>
    </div>
    <br>
<table id="account">
    <tr>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">date</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">reason</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">period</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">total</th>
        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">detailes</th>
    </tr>
    <tr>
        <td style="text-align: center;padding-top: 8px; width: 10%"></td>
        <td style="text-align: center;padding-top: 8px; width: 10%">-</td>
        <td style="text-align: center;padding-top: 8px; width: 10%; "></td>
        <td style="text-align: center;padding-top: 8px; width: 10%">{{$user->annual_vacation + $user->sick_vacation}}</td>
        
        <td style="text-align: center;padding-top: 8px; width: 10%; ">PRE Balance</td>
    </tr>
    @php($balance =$user->annual_vacation + $user->sick_vacation)
    @foreach ($vacations as $item)
        @php($balance -= $item->period)
    <tr>
        <td>{{$item->date}}</td>
        <td>{{$item->type == 0 ? "sick vacation" : "annual vacation"}}</td>
        <td>{{$item->period}}</td>
        <td>{{$balance}}</td>
        <td></td>
    </tr>
    @endforeach

</table>
</body>
</html>

</div>
