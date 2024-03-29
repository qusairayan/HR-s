<!DOCTYPE html>
<html lang="">

<head>
    <title>Part Time Report - {{ $user['name'] }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
    .allownce-table {
        float: right;
        width: 50%;
    }

    .deduction-table {
        float: left;
        width: 50%;
    }

    .allownce-line {
        text-align: center;
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .totalDA {
        text-align: center
    }

    .allownce-table h2,
    .deduction-table h2,
    .checks-table h2 {
        text-align: right !important;
    }

    .salary-total {
        float: left;
        width: 50%;
        text-align: center;
        padding: 50px 0 0 0;
        margin: 0;
    }

    .checks-table {
        float: left;
        width: 50%;
    }

    .allownce-line span {
        border-left: 3px solid green;
        height: 42px;
        border-bottom: 3px solid green;
        width: 50%;
    }

    .deduction-line {
        text-align: center;
        display: flex;
        justify-content: start;
        align-items: center;
    }

    .deduction-line span {
        border-right: 3px solid green;
        height: 42px;
        border-bottom: 3px solid green;
        width: 50%;
    }

    .userSocialSecurity {
        text-align: right !important;
    }

    .allownce-line {
        text-align: center;
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .allownce-line span {
        border-left: 3px solid green;
        height: 42px;
        border-bottom: 3px solid green;
        width: 50%;
    }

    .deduction-line {
        text-align: center;
        display: flex;
        justify-content: start;
        align-items: center;
    }

    .deduction-line span {
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
                {{-- <img src="/storage/company/{{ $user['image'] }}" height="70" width="160" /> --}}
            </div>
            <div class="column" style="width:70%">
                <p style="font-size:18px;text-align:center"><b>{{ $user['company'] }}</b></p>
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
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold"> {{ $user['name'] }} -
                {{ $user['id'] }}</p>
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
            <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $user['department'] }} -
                {{ $user['position'] }}</p>
        </div>
        <div class="column" style="padding:0; width:20%">
            <p style="font-size:15px;color: white;margin:0;padding:4;font-weight:bold">salary :{{ $user['salary'] }}
            </p>
        </div>


    </div>
    <br>
    <div class="tables row">
        <div class="p-3 allownce-table col-md-6 col-12">
            <h2 class="text-center">العلاوات</h2>
            <table class="allownce">
                <tr>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">
                        المبلغ</th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                        التاريخ</th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">
                        نوع العلاوة</th>
                </tr>
                <tr>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                        {{ $userSalary }}</td>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                        {{ $date }}</td>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                        الراتب</td>
                </tr>
                @php($totalAllownce = $userSalary)
                @foreach ($allownce as $item)
                    @php($totalAllownce += $item['amount'])
                    <tr>
                        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                            {{ $item['amount'] }}</td>
                        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                            {{ $item['date'] }}</td>
                        <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                            {{ $item['type'] }}</td>
                    </tr>
                @endforeach
                @foreach ($allownceTypes as $item)
                    <tr>
                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">0</td>
                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">0</td>
                        <td style="text-align: center;padding-top: 8px;  background:#a5a5a5;">{{ $item['name'] }}</td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <th
                            style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">
                            {{ $totalAllownce }}</th>
                        <th
                            style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">
                        </th>
                        <th
                            style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">
                            المجموع</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="p-3 deduction-table col-md-6 col-12">
            <h2 class="text-center">الخصومات</h2>
            <table class="deduction">
                <tr>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 22%">
                        المبلغ</th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width: 14%">
                        التاريخ</th>
                    <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">
                        نوع الخصم</th>
                </tr>
                @php($totalDeduction = $social ?? 0)
                @foreach ($deduction as $item)
                    @php($totalDeduction += $item['amount'])
                    <tr>
                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">{{ $item['amount'] }}</td>
                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">{{ $item['date'] }}</td>
                        <td style="text-align: center;padding-top: 8px;  background:#a5a5a5;">{{ $item['type'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">{{ $social ?? 0 }}</td>
                    <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">{{ $date }}</td>
                    <td style="text-align: center;padding-top: 8px;  background:#a5a5a5;">الضمان الاجتماعي</td>
                </tr>
                @foreach ($deductionTypes as $item)
                    <tr>
                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">0</td>
                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">0</td>
                        <td style="text-align: center;padding-top: 8px;  background:#a5a5a5;">{{ $item['name'] }}</td>
                    </tr>
                @endforeach

                <tfoot>
                    <tr>
                        <th
                            style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">
                            {{ $totalDeduction }}</th>
                        <th
                            style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">
                        </th>
                        <th
                            style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">
                            المجموع</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @php($sum = $monthly_payroll)
    <div class="tables row">
        <div class="salary-total p-3 d-flex align-item-center justify-content-center total col-md-6 col-12 text-center">
            <h3 class="align-self-center text-center">صافي الراتب : <span
                    class="border p-2 border-info rounded text-center">{{ $sum }}</span></h3>
        </div>
        <div class="salary-total p-3 d-flex align-item-center justify-content-center total col-md-6 col-12 text-center">
            <h3 class="userSocialSecurity align-self-center text-center">
                {{ $user['SocialSecurity'] ? 'اقتطاع الضمان الاجتماعي' . $user['SocialSecurity'] : 'لا يوجد بيانات ضمان اجتماعي للموظف : ' . $user['name'] }}
            </h3>
        </div>
    </div>
</body>

</html>
