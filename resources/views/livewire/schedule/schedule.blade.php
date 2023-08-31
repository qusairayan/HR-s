<div>
    <title>Schedule </title>

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
                    <li class="breadcrumb-item active" aria-current="page">Schedule</li>
                </ol>
            </nav>
            <h2 class="h4">Staff Schedule</h2>
        </div>

    </div>


    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <div class="row">
            @if (auth()->user()->hasPermissionTo('setSchedule'))
                <!-- Form -->

                <div class="col-md-5 mb-4">
                    <label class="my-1 me-2" for="department">Department</label>
                    <select class="form-select" id="department" aria-label="Default select example"
                        wire:model="department">
                        @foreach ($departments as $department)
                            <option selected value="{{ $department->id }}"
                                {{ $department->id == auth()->user()->department_id ? 'selected' : '' }}>
                                {{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- End of Form -->
            @endif

            <!-- Form -->

            <div class="col-md-5 mb-4">
                <label class="my-1 me-2" for="user">Staff</label>
                <select class="form-select" id="user" wire:model="user" aria-label="Default select example">
                    <option hidden selected value="">Select Employee</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- End of Form -->
        </div>
        <div class="row">

            <!-- Form -->
            <div class="col-md-5 mb-4">
                <div class="mb-3">
                    <label class="my-1 me-2" for="dateFrom">Date From</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <input class="form-control" id="dateFrom" type="date" wire:model="dateFrom">
                    </div>
                </div>
            </div>
            <div class="col-md-5 mb-4">
                <div class="mb-3">
                    <label class="my-1 me-2" for="dateTo">Date To</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <input class="form-control" id="dateTo" type="date" placeholder="dd/mm/yyyy"
                            wire:model="dateTo">
                    </div>
                </div>

                @error('dateFrom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @error('dateTo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0 rounded-start">Day</th>
                                <th class="border-0">Date</th>
                                <th class="border-0">From </th>
                                <th class="border-0">To </th>

                            </tr>
                        </thead>
                        <tbody>


                            <!-- Item -->.
                            @foreach ($schdules as $schdule)
                                <tr>
                                    <td class="fw-bold align-items-center">{{ $schdule->day }} </td>
                                    <td class="fw-bold align-items-center">
                                        {{ $schdule->date }}
                                    </td>
                                    @if ($schdule->from == null)
                                        <td colspan="2" class="fw-bold align-items-center text-danger">
                                            Off
                                        </td>
                                    @else
                                        <td class="fw-bold align-items-center ">

                                            {{ \Carbon\Carbon::parse($schdule->from)->format('h:i A') }}


                                        </td>
                                        <td class="fw-bold align-items-center ">

                                            {{ \Carbon\Carbon::parse($schdule->to)->format('h:i A') }}


                                        </td>
                                    @endif

                                </tr>
                                <!-- End of Item -->
                            @endforeach
                        </tbody>
                    </table>

                    <div>
                        {{ $schdules->links('vendor.pagination.custom')}}
                    </div>
                </div>

            </div>
            <!-- End of Form -->


        </div>








    </div>
</div>


