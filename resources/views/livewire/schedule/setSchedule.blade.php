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
                    <li class="breadcrumb-item active" aria-current="page">Set Schedule</li>
                </ol>
            </nav>
            <h2 class="h4">Set Staff Schedule</h2>
        </div>
    </div>
    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <div class="row">
            <div class="col-md-4 mb-4">
                <label class="my-1 me-2" for="user">Companies</label>
                <select class="form-select" id="company" aria-label="company select example" wire:model="company"
                    autofocus required>
                    @foreach ($companies as $comp)
                        <option value="{{ $comp->id }}">{{ $comp->name }} </option>
                    @endforeach
                    <option value="" disabled selected hidden>Select Employee's Company</option>
                </select>
            </div>
            @if (auth()->user()->hasPermissionTo('setSchedule'))
                <div class="col-md-4 mb-4">
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
            @endif
            <div class="col-md-4 mb-4">
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
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
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
            <div class="col-md-3 mb-4">
                <div class="mb-3">
                    <label class="my-1 me-2" for="timeFrom">Time From</label>
                    <input class="form-control" id="timeFrom" type="time" wire:model="timeFrom">
                </div>
            </div>
            <div class="col-md-3 mb-4">
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
            <div class="col-md-3 mb-4">
                <div class="mb-3">
                    <label class="my-1 me-2" for="timeto">Time To</label>
                    <input class="form-control" id="timeto" type="time" wire:model="timeTo">
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <label class="my-1 me-2" for="user">Off Day</label>
            <div class="row">
                <div class="col">
                    <label class="my-1 me-2" for="user">Sunday</label>
                    <input wire:model="offDay" type="checkbox" value="Sunday">
                </div>
                <div class="col">
                    <label class="my-1 me-2" for="user">Monday</label>
                    <input wire:model="offDay" type="checkbox"  value="Monday">
                </div>
                <div class="col">
                    <label class="my-1 me-2" for="user">Tuesday</label>
                    <input wire:model="offDay" type="checkbox" value="Tuesday">
                </div>
                <div class="col">
                    <label class="my-1 me-2" for="user">Wednesday</label>
                    <input wire:model="offDay" type="checkbox" value="Wednesday">
                </div>
                <div class="col">
                    <label class="my-1 me-2" for="user">Thursday</label>
                    <input wire:model="offDay" type="checkbox" value="Thursday">
                </div>
                <div class="col">
                    <label class="my-1 me-2" for="user">Friday</label>
                    <input wire:model="offDay" type="checkbox" value="Friday">
                </div>
                <div class="col">
                    <label class="my-1 me-2" for="user">Saturday</label>
                    <input wire:model="offDay" type="checkbox" value="Saturday">
                </div>
            </div>
        </div>
        <button type="submit" wire:click="save" class="btn btn-success">Create Schedule</button>
    </div>



    {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
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
    <form wire:submit.prevent="save" action="#" method="POST">


        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <div class="row">
                @if (auth()->user()->hasPermissionTo('setSchedule'))
                    <!-- Form -->

                    <div class="col-md-4 mb-4">
                        <label class="my-1 me-2" for="department">Department</label>
                        <select class="form-select" id="department" aria-label="Default select example">

                            <option selected>{{ auth()->user()->department->name }}</option>

                        </select>
                    </div>
                    <!-- End of Form -->
                @endif

                <!-- Form -->
                <div class="col-md-6 mb-4">
                    <label class="my-1 me-2" for="users">Staff</label>
                    <select class="form-select" id="user" wire:model="user"
                        aria-label="Default select example">
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





                <div class="col-lg-4 col-sm-6">

                    <div class="mb-3">
                        <label for="from">Week</label>
                        <div class="input-group">

                            <input class="form-control" id="week" wire:model="week" type="number"
                                placeholder="Set the number of weeks" required>
                        </div>
                    </div>

                </div>
            </div>



            @php
                $this->totalDays = 0;
            @endphp
            @for ($i = 1; $i <= $this->week; $i++)
                <div class="row">



                    @php
                        $currentDate = clone $this->today;
                        $tempTdHTML = '';

                    @endphp


                    @while ($currentDate <= $this->endOfWeek)
                        @php

                            $this->today = $currentDate;

                            $tempTdHTML .=
                                ' <tr class="vertical-allign-middle">
                                    
                                <td>' .
                                $currentDate->format('l') .
                                '<br>
                                            <small>' .
                                $currentDate->format('Y-m-d') .
                                '</small>
                                        </td>';
                            $disabled = '';
                            if (isset($this->offs[$currentDate->format('Y-m-d')])) {
                                $disabled = 'disabled';
                            }
                            $tempTdHTML .=
                                ' <td>
                                    <div class="container" ">
        <div style="position: relative">
                          <input type="time" class="form-control timePicker" id="from' .
                                $currentDate->format('Y-m-d') .
                                '" wire:model="shift.' .
                                $currentDate->format('Y-m-d') .
                                '.from" ' .
                                $disabled .
                                '>
                                                ' .
                                '</div></div></td>';

                            $tempTdHTML .=
                                ' <td>
                                    <div class="container">
        <div style="position: relative">
                          <input type="time" class="form-control timePicker" id="to' .
                                $currentDate->format('Y-m-d') .
                                '" wire:model="shift.' .
                                $currentDate->format('Y-m-d') .
                                '.to" ' .
                                $disabled .
                                '>
                                                ' .
                                '</div></div></td>';

                            $tempTdHTML .=
                                ' <td><div class="container py-4" >
                          <input type="checkbox"   wire:model.lazy="shift.' .
                                $currentDate->format('Y-m-d') .
                                '.off" class="form-check-input"/>
                                        </div></td></tr>';

                            $currentDate->modify('+1 day');
                            $this->totalDays += 1;
                        @endphp
                    @endwhile



                    <h2>Week{{ $i }}</h2>
                    <div class="card card-body border-0 shadow table-wrapper table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>Days</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Off</th>

                            </thead>
                            <tbody>
                                {!! $tempTdHTML !!}
                            </tbody>
                        </table>
                    </div>

                    @php
                        $this->endOfWeek = clone $currentDate;
                        $this->endOfWeek->modify('next Saturday');
                    @endphp


                </div>
            @endfor
            @error('shift')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror


            @if ($this->showSavedAlert)
                <div class="alert alert-success" role="alert">
                    Saved!
                </div>
            @endif

            <div class="mt-3">
                <button type="submit" class="btn btn-gray-800 m-2 animate-up-2 float-end"
                    wire:loading.attr="disabled">Save All</button>
            </div>




        </div>

    </form> --}}
</div>
