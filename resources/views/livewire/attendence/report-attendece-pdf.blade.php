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
            @php
             $totalCheckInLat = 0;   
             $totalCheckOutLat = 0;
             $totalCountHouer1 = 0;
             $totalCountHouer2 = 0;
             $hour =0;
             $minute =0;
             $secound=0;

            @endphp
             @foreach ($attendanceList as $item)
             @php
                   $time1 = strtotime($item->start_work);
                   $time2 = strtotime($item->check_in);
                    $time = $time2
             @endphp
                <tr>
                    <td style="text-align: center;padding-top: 8px; width: 10%; background:#fff;">{{$item->schedule_date}}</td>
                    <td style="text-align: center;padding-top: 8px; width: 15%; background:#fff;">
                        <table>
                            <tr>
                                <th style="padding:5px;background:#fff;">{{$item->off == 1 ? "" : substr($item->start_work,0,2).  ($item->start_work < 12 ? "AM"  : "PM")}}</th>
                                <th style="padding:4px;background:#fff;">{{$item->off == 1 ? "" : substr($item->end_work,0,2).  ($item->end_work < 12 ? "AM"  : "PM")}}</th>
                            </tr>
                        </table>
                    </td>
                 <td style="text-align: center;padding-top: 8px; width: 15%; background:#fff;">
                        <table>
                            <tr>
                                @php
                                  $CheckInLat = diffTime($item->check_in , $item->start_work);
                                  $totalCheckInLat +=$CheckInLat; 
                                @endphp
                                <th style="padding:4px;background:#fff;">{{$item->off == 1 ? "" :$item->check_in}}</th>
                                <th style="padding:4px;background:#fff;">{{$item->off == 1 ? "" : $CheckInLat}}</th>
                            </tr>
                        </table>
                    </td>
                 <td style="text-align: center;padding-top: 8px; width: 15%; background:#fff;">
                        <table>
                            <tr>
                                @php
                                $CheckOutLat = diffTime($item->end_work,$item->check_out);
                                $totalCheckOutLat +=$CheckOutLat;
                              @endphp
                                <th style="padding:4px;background:#fff;">{{$item->off == 1 ? "" :$item->check_out}}</th>
                                <th style="padding:4px;background:#fff;">{{ $item->off == 1 ? "" :$CheckOutLat}}</th>
                            </tr>
                        </table>
                    </td>
                    @php
                        $countHour=diffTimeToHour($item->end_work,$item->start_work);
                        $countHourEmp=diffTimeToHour($item->check_out,$item->check_in);
                        $totalCountHouer1 += $item->off != 1 ? substr($countHour,0,1) :0;
                        if($item->off != 1){
                            $time = diffTimeToHour($countHour,$countHourEmp);
                        $arr = calcHours($time,$hour,$minute,$secound);
                        $hour +=$arr[0] ;
                        $minute +=$arr[1] ;
                        $secound +=$arr[2] ;
                        }
                    @endphp
                    <td style="padding:4px;background:#fff;">{{$item->off == 1 ? "" : $countHour }}</td>
                    <td style="padding:4px;background:#fff;">{{$item->off == 1 ? "" : $countHourEmp }}</td>
                    <td style="padding:4px;background:#fff;">{{$item->off ? "weekend" : ($item->leaves_date ? "leave" : ($item->vacation_date ? "vacation" : "work"))}}</td>
                </tr>
            @endforeach
            <tr>
                {{-- @dd("xsaxas"); --}}
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">Total</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">Times</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$totalCheckInLat}}</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$totalCheckOutLat}}</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$totalCountHouer1}}</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$hour.":".$minute.":".$secound}}</td>
                {{-- <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px;width:15%">{{$totalCountHouer2}}</td> --}}
            </tr>
        </table>
    </div>
@php
function diffTime($time1,$time2){
    $time1 = new DateTime($time1);
    $time2 = new DateTime($time2);

    // Calculate the difference
    $difference = $time1->diff($time2);

    // Access the difference in hours, minutes, and seconds
    // $hours = $difference->h;
    return $difference->i;
    // $seconds = $difference->s;

    // Display the difference
    // echo "Difference: $hours hours, $minutes minutes, $seconds seconds";
}
function diffTimeToHour($time1,$time2){
    $time1 = new DateTime($time1);
    $time2 = new DateTime($time2);

    // Calculate the difference
    $difference = $time1->diff($time2);

    // Access the difference in hours, minutes, and seconds
    // $hours = $difference->h;
    return $difference->h.":".$difference->i.":".$difference->s;
    // $seconds = $difference->s;

    // Display the difference
    // echo "Difference: $hours hours, $minutes minutes, $seconds seconds";
}
function calcHours($time,$hour,$minute, $secound){
    $time = explode(":",$time);
    $hour = $time[0];
    $minute = $time[1];
    $secound = $time[2];
    if($secound >=60){
        dd($secound);
        $secound = $secound % 60;
        $minute++;
    }
    if($minute >=60){
        $minute = $minute % 60;
        $hour++;
    }
    // echo "hour=" . $hour."<br>";
    // echo "minute=" .$minute."<br>";
    // echo "secound=".$secound."<br>";
    return [$hour,$minute, $secound];
}
@endphp