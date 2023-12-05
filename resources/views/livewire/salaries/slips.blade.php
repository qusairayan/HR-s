<div>
    <title>Salary Slips </title>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>


                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payroll / Salary Slips</li>
                </ol>
            </nav>
            <h2 class="h4">All slips</h2>
        </div>
        {{-- new salary --}}
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('payrolls.newSalary') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                New Salary
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div>
        {{-- new salary --}}
    </div>
    <div class="table-settings mb-4">



        <div class="row">

            <div class="col-md-3 mb-3">
                <div>
                    <label for="comapny">Company</label>
                    <select class="form-select mb-0" id="company" aria-label="company select example"
                        wire:model="company" autofocus required>

                        <option value=""selected>Select Employee's Company</option>
                        @foreach ($companies as $comp)
                            <option value="{{ $comp->id }}">
                                {{ $comp->name }} </option>
                        @endforeach


                    </select>
                    @error('company')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
            </div>




            <div class="col-md-3 mb-3">

                <div>
                    <label for="department">Department</label>
                    <select class="form-select mb-0" id="department" aria-label="department select example"
                        wire:model="department" autofocus required>
                        <option value="" selected>Select department's Department
                        </option>
                        @foreach ($departments as $dep)
                            <option value="{{ $dep->id }}">
                                {{ $dep->name }} </option>
                        @endforeach


                    </select>

                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>




            <div class="col-md-4 mb-4">

                <div>
                    <label for="employee">Employee</label>
                    <select class="form-select mb-0" id="employee" aria-label="employee select example"
                        wire:model="employee" autofocus required>
                        <option value="" selected>Select employee
                        </option>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}">
                                {{ $emp->name }} </option>
                        @endforeach


                    </select>

                    @error('employee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-4 mb-3">

                <div>
                    <label for="date">Date</label>
                    <input  class="form-control datepicker-input" type="month" id="date"
                        placeholder="Select Month and Year" wire:model="date">


                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>




            <div class="col-md-4 d-flex align-items-center justify-content-center">


                <button class="btn btn-success" style="width: 100%; margin:0 5px;" type="button" wire:click="report()">View  Slip</button>
                

            </div>


        </div>








    </div>









<div class="full-time-report">
    <h3>Full Time Report</h3>
    <div class="row">
        <div class="col-md-4 col-12"><input wire:model="from" class="form-control datepicker-input" type="month"></div>
        <div class="col-md-4 col-12"><input wire:model="to" class="form-control datepicker-input" type="month"></div>
        <div class="col-md-4 col-12"><button class="btn btn-success" style="width: 100%;" type="button" wire:click="fullTimeReport()">View  Full Time Report</button></div>
        
    </div>
    
</div>




<div class="card card-body border-0 shadow table-wrapper table-responsive mt-5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="border-gray-200">#</th>
                <th class="border-gray-200">name</th>
                <th class="border-gray-200">month</th>
                <th class="border-gray-200">salary</th>
                <th class="border-gray-200">action</th>
            </tr>
            <tbody>
                @php($i=0)
                @foreach($payrolls as $item)
                @php($i++)
                <tr>
                    <td class="border-0 fw-bold"><span class="fw-normal">{{$i}}</span></td>
                    <td class="border-0 fw-bold"><span class="fw-normal">{{$item["name"]}}</span></td>
                    <td class="border-0 fw-bold"><span class="fw-normal">{{$item["month"]}}</span></td>
                    <td class="border-0 fw-bold"><span class="fw-normal">{{$item["salary"]}}</span></td>
                   @if ($item["salaryDepositId"])
                   <td class="border-0 fw-bold"><span class="fw-normal"><a href="{{route ("payrolls.depositSalarypdf",["id"=>$item["salaryDepositId"]])}}" class="btn btn-info">View Salary Pdf</a></span></td>   
                   @else
                   <td class="border-0 fw-bold"><span class="fw-normal"><a href="{{route ("payrolls.depositsalary",["id_salary"=>$item["id"],"id"=> $item["user_id"],"salary"=>$item["salary"]])}}" class="btn btn-primary">Deposit Salary</a></span></td>   
                   @endif                    
                </tr>
                @endforeach
            </tbody>
        </thead>
    </table>
</div>
</div>
<script>
    const dss = new Date();
    let month = dss.getMonth()+1;
    let year = dss.getFullYear();
    document.getElementById("date").setAttribute("max", `${year}-${month}`);
</script>