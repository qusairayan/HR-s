<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Attendence for {{$employee}}</title>
</head>
<style>
    .allownce-table{
        float: right;
        width: 50%; 
    }
    .deduction-table{
        float: left;
        width: 50%; 
    }
    .allownce-line{
    text-align: center;
    display: flex;
    justify-content: end;
    align-items: center;
}
.totalDA{
    text-align: center
}
.allownce-table h2, .deduction-table h2 ,.checks-table h2{
    text-align:right !important ;
}
.salary-total{
    float: left;
        width: 50%;
        text-align: center;
    padding: 50px 0 0 0;
    margin: 0;
}
.checks-table{
    float: left;
        width: 50%;
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
.userSocialSecurity{
    text-align:right !important;
}
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
<body>
    <div>
        <div style="padding:5mm; margin: bottom 25px;">
            <div class="row">
                <div class="column" style="width:20%">
                    <img src={{$image ? "/storage/company/".$image :  "https://cdn-icons-png.flaticon.com/512/3616/3616930.png"}} height="70" width="160" />
    
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
                <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold"> {{ $employee }} -
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
    
    
        </div>
        <br>
       
    
    
    
                <table style="width: 100%" class="">
                    <tr>
                        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;">Date</th>
                        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;">Check In</th>
                        <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;">Check Out</th>
                    </tr>
                    @foreach ($attendanceList as $item)
                        <tr>
                            <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">{{$item->date}}</td>
                            <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                                <table>
                                    <tr>
                                        <th style="text-align: center;padding-top: 8px; background:#a5a5a5;">Working time</th>
                                        <th style="text-align: center;padding-top: 8px; background:#a5a5a5;">check in</th>
                                        <th style="text-align: center;padding-top: 8px; background:#a5a5a5;">late</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">{{$item->work_from}}</td>
                                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">{{$item->check_in}}</td>
                                        <td style="text-align: center;padding-top: 8px; background:#a5a5a5;">{{$item->type_att = "cehckIn" ? $item->amount_checkin : ""}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="text-align: center;padding-top: 8px; width: 10%; background:#a5a5a5;">
                                <table>
                                    <tr>
                                        <th style="text-align: center;padding-top: 8px;  background:#a5a5a5;">Working End</th>
                                        <th style="text-align: center;padding-top: 8px;  background:#a5a5a5;">check Out</th>
                                        <th style="text-align: center;padding-top: 8px;  background:#a5a5a5;">Late</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;padding-top: 8px;  background:#a5a5a5;">{{$item->work_to}}</td>
                                        <td style="text-align: center;padding-top: 8px;  background:#a5a5a5;">{{$item->check_out}}</td>
                                        <td style="text-align: center;padding-top: 8px;  background:#a5a5a5;">{{$item->type_att = "checkout" ? $item->amount_checkout :""}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </table>
    </div>
</body>
</html>

