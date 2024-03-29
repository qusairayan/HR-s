<div>
    <title>PartTimes </title>
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
                    <li class="breadcrumb-item active" aria-current="page">Payroll / PartTimes</li>
                </ol>
            </nav>
            <h2 class="h4">All PartTimes</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('payrolls.add_part_time') }}"
                class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                New Parttime
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div>
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
            <div class="col-md-3 mb-3">
                <div>
                    <label for="from">From</label>
                    <input class="form-control datepicker-input" type="month" id="from" placeholder="From date"
                        wire:model="from">
                    {{-- <input class="form-control datepicker-input" type="date" id="from"
                     placeholder="From date"
                    wire:model="from"> --}}
                    @error('from')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div>
                    <label for="to">To</label>
                    <input class="form-control datepicker-input" type="month" id="to" placeholder="To date"
                        wire:model="to">
                    {{-- <input class="form-control datepicker-input" type="date" id="to"
                     placeholder="To date"
                    wire:model="to"> --}}
                    @error('from')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div style="width: 58%;">
                    {{-- <button  type="button" wire:click="report()">View Report</button> --}}
                    <a class="btn btn-success"
                        href="{{ url('payrolls/PartTime_Reports', ['id' => $employee, 'from' => $from, 'to' => $to]) }}"
                        target="_blank">View Report</a>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <div class="input-group me-2 me-lg-3 fmxw-400">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input wire:model="search" type="text" class="form-control" placeholder="Search Employee">

                </div>
            </div>
            <div class="col-4 col-md-2 col-xl-1 ps-md-0 text-end">
                <div class="dropdown">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0">
                        <span class="small ps-3 fw-bold text-dark">Show</span>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg
                                class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg></a>
                        <a class="dropdown-item fw-bold" href="#">20</a>
                        <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                    </div>
                </div>
            </div>
        </div>




    </div>









    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>

                    <th class="border-gray-200">Employee</th>
                    <th class="border-gray-200">Department</th>
                    <th class="border-gray-200">From</th>
                    <th class="border-gray-200">To</th>
                    <th class="border-gray-200">Amount </th>
                    <th class="border-gray-200">Status </th>
                    <th class="border-gray-200">Action</th>
                </tr>
            </thead>
            <tbody>



                @foreach ($partime as $pt)
                    <tr>


                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $pt->user_name }}
                            </span>
                        </td>



                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $pt->dep_name }}
                            </span>
                            <div class="d-block">
                                <div class="small text-gray">{{ $pt->position }}</div>
                            </div>
                        </td>

                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $pt->from }}
                            </span>
                        </td>


                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $pt->to }}
                            </span>
                        </td>
                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $pt->amount }}
                            </span>
                        </td>


                        <td class="border-0 fw-bold">
                            @if ($pt->status == 1)
                                <span class="fw-bold text-success">
                                    Ready
                                </span>
                            @else
                                <span class="fw-bold text-danger">
                                    Pending
                                </span>
                            @endif
                        </td>




                        <td class="border-0 fw-bold">
                            <div style="display: flex">
                                <a class="dropdown-item p-sm-2"
                                    href="{{ route('payrolls.view_part_time', ['parttime' => $pt->id]) }}">
                                    <span class="fas fa-eye me-2"></span>
                                </a>
                                @if ($pt->status == 0)
                                    <a class="dropdown-item p-sm-2"
                                        href="{{ route('payrolls.edit_part_time', ['parttime' => $pt->id]) }}">
                                        <span class="fas fa-edit me-2"></span>
                                    </a>
                                @endif
                                <a class="dropdown-item p-sm-2" wire:click="delete({{ $pt->id }})">
                                    <span class="fas fa-trash me-2"></span>
                                </a>
                            </div>
                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>
            {{ $partime->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
