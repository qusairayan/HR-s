<style>
    div.report {
        font-family: Arial, Helvetica, sans-serif;
    }
    @page {
        margin: 10px 10px 10px 10px !important;
        padding: 10px1 0px 10px 10px !important;
    }
    .column {
        float: left;
        width: 50%;
        padding: 10px;
    }
    </style>
    <div class="report">
        <title>Report Attendence for {{$employee}}</title>
        <div style="padding:5mm; margin: bottom 25px;">
            <div class="row">
                <div class="column" style="width:20%">
                    {{-- <img src={{$image ? "/storage/company/".$image :  "https://cdn-icons-png.flaticon.com/512/3616/3616930.png"}} height="70" width="160" /> --}}
                </div>
                <div class="column" style="width:70%">
                    <p style="font-size:18px;text-align:center"><b>{{ $company }}</b></p>
                </div>
            </div>
        </div>
         <div style="color: white;background-color: #03415F;" class="row">
            <div class="column" style="padding:4px;width: 100%">
                <p style="text-align: center; font-size:18px;color: #fff;margin:0;padding:5;"><b>Attendence Report</b>
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
                <p style="font-size:12px;color: white;margin:0;padding:4;font-weight:bold">{{ $department }} - {{ $position }}</p>
            </div>
        </div>
        <br>
        <table style="width: 100%" class="">
            <tr>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:10%">Date</th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:10%">Time Work
                    <table>
                        <tr>
                            <th style="text-align: center; background-color:#fff;color: black; font-size: 12px;padding:5px">start work</th>
                            <th style="text-align: center; background-color:#fff;color: black; font-size: 12px;padding:5px">end work</th>
                        </tr>
                    </table>
                </th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:20%">Check In
                    <table>
                        <tr>
                            <th style="text-align: center; background-color:#fff;color: #000; font-size: 12px;padding:5px">attendance</th>
                            <th style="text-align: center; background-color:#fff;color: #000; font-size: 12px;padding:5px">Lateness</th>
                        </tr>
                    </table>
                </th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:20%">Check Out
                    <table>
                        <tr>
                            <th style="text-align: center; background-color:#fff;color: #000; font-size: 12px;padding:5px">Leave</th>
                            <th style="text-align: center; background-color:#fff;color: #000; font-size: 12px;padding:5px">overTime/Lateness</th>
                        </tr>
                    </table>
                </th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">Number of daily working hours</th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">The number of working hours the employee works</th>
                <th style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:10%">Detailes</th>
            </tr>
            {{-- @dd($attendanceList->count > 0) --}}
            @if(!$attendanceList->isEmpty())
             @foreach ($attendanceList as $item)
                <tr>
                    <th style="text-align: center;padding-top: 8px; width: 10%; background:#fff;">{{$item->schedule_date}}</th>
                    <td style="text-align: center;padding-top: 8px; width: 15%; background:#fff;">
                        <table>
                            <tr>
                                <th style="padding:5px;background:#fff;border-right: 2px solid black;">{{$item->off == 1 ? "--" : substr($item->start_work,0,2).  ($item->start_work < 12 ? "AM"  : "PM")}}</th>
                                <th style="padding:4px;background:#fff;">{{$item->off == 1 ? "--" : substr($item->end_work,0,2).  ($item->end_work < 12 ? "AM"  : "PM")}}</th>
                            </tr>
                        </table>
                    </td>
                 <td style="text-align: center;padding-top: 8px; width: 15%; background:#fff;">
                        <table>
                            <tr>
                                <th style="padding:4px;background:#fff;border-right: 2px solid black;">{{$item->off == 1 ? "--" : $item->check_in ?? "--"}}</th>
                                <th style="padding:4px;background:#fff;">{{$item->off == 1 ? "--" : ($item->check_in ? $item->checkIn_late ?? $item->overTimeCheckIn : "--" )}}</th>
                            </tr>
                        </table>
                    </td>
                 <td style="text-align: center;padding-top: 8px; width: 15%; background:#fff;">
                        <table>
                            <tr>
                                <th style="padding:4px;background:#fff;border-right: 2px solid black;">{{$item->off == 1 ? "--" : $item->check_out ?? "--"}}</th>
                                <th style="padding:4px;background:#fff;">{{ $item->off == 1 ? "--" : ($item->check_out ? $item->checkOut_late ?? $item->overTimeCheckOut : "--") }}</th>
                            </tr>
                        </table>
                    </td>
                    <th style="text-align: center;padding:4px;background:#fff;">{{$item->off == 1 ? "--" : $item->countHoursWork }}</th>
                    <th style="text-align: center;padding:4px;background:#fff;">{{$item->off == 1 ? "--" : $item->countHoursWorkEmployee }}</th>
                    <th style="text-align: center;padding:4px;background:#fff;">{{$item->type}}</th>
                </tr>
            @endforeach
            <tr>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">Total</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">Times</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$attendanceList->totalCheckIn}}</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$attendanceList->totalCheckOut}}</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$attendanceList->totalCountHour}}</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$attendanceList->totalCountHourEmployee}}</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$attendanceList->totalCountHour -$attendanceList->totalCountHourEmployee }}</td>
            </tr>
            @endIf
        </table>
    </div>