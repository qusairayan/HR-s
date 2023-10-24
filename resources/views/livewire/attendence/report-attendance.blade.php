<title>Report</title>
<style>
    .information-user{
        background-color: hsl(0deg 0% 100%);
        /* height: 200px; */
        padding: 2rem;
        border-radius: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .user-image{
        width: 100px;
    }
</style>
<div>
    <h3>Report Attendence For :{{$user->name}} Month : {{$date}}</h3>
    <section class="information-user">
        <div class="user-image">
            <img src={{$user->image ? $user->image : "https://cdn-icons-png.flaticon.com/512/3616/3616930.png"}} alt="">
        </div>
        <div>
            <div class="user-name">
                <h4>Employee Name :{{$user->name}}</h4>
            </div>
            <div class="company-name">
                <h4>Company Name :{{$user->company_name}}</h4>
            </div>
        </div>
        <div>
            <div class="department-name">
                <h4>Department Name :{{$user->department_name}}</h4>
            </div>
            <div class="user-position">
                <h4>Position :{{$user->position}}</h4>
            </div>
        </div>
    </section>

    <section>
        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
    
                        <th class="border-gray-200">ID</th>
                        <th class="border-gray-200">Date</th>
                        <th class="border-gray-200">Check In</th>
                        <th class="border-gray-200">Check Out</th>
                    </tr>
                </thead>
                <tbody>
    
    
                    @php($i =0)
                    @foreach ($attendanceList as $item)
                    @php($i++)
                        <tr>
                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ $i }}
                                </span>
                            </td>
                            <td>
                                <a href="#" class="d-flex align-items-center">  
                                    <span class="fw-bold">{{ $item->date }}</span>
                                </a>
                            </td>
                            <td class="border-0 fw-bold">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th class="border-gray-200">Working time</th>
                                            <th class="border-gray-200">check in</th>
                                            <th class="border-gray-200">late</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->check_in }}</td>
                                            <td>{{ $item->check_in }}</td>
                                            <td>{{ $item->check_in }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="border-0 fw-bold">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th class="border-gray-200">Work end</th>
                                            <th class="border-gray-200">check out</th>
                                            <th class="border-gray-200">over time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->check_out }}</td>
                                            <td>{{ $item->check_out }}</td>
                                            <td>{{ $item->check_out }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
    
                            {{-- <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ $user->position }}
                                </span>
                            </td>
                            
                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ $user->type }}
                                </span>
                            </td>
    
                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
    
                                    {!! $user->status == 1
                                        ? '<span class="fw-bold text-success">Active</span>'
                                        : '<span class="fw-bold text-danger">Inactive</span>' !!}
                                </span>
                            </td>
    
                            <td class="border-0 fw-bold">
    
                                <div class="btn-group">
                                <a class="dropdown-item"
                                    href="{{ route('reportAttendence', ['id' => $user->id]) }}"><span
                                    class="fas fa-eye me-2"></span>View Report</a>
                                   
                                </div>
                            </td> --}}
    
    
                        </tr>
                    @endforeach
    
                </tbody>
            </table>
            <div>
                {{-- {{ $users->links('vendor.pagination.custom') }} --}}
            </div>
        </div>
    </section>
</div>
