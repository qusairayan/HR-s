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
    <form wire:submit.prevent="save" action="#" method="POST">


        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <div class="row">
                @if (auth()->user()->hasPermissionTo('setSchedule'))
                    <!-- Form -->

                    <div class="col-md-6 mb-4">
                        <label class="my-1 me-2" for="department">Department</label>
                        <select class="form-select" id="department" aria-label="Default select example" disabled>
                            <option selected>{{ auth()->user()->department->name }}</option>

                        </select>
                    </div>
                    <!-- End of Form -->
                @endif

                <!-- Form -->
                <div class="col-md-6 mb-4">
                    <label class="my-1 me-2" for="users">Staff</label>
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
                        $tempThHTML = '';
                        $tempTdHTML = '';
                        
                    @endphp


                    @while ($currentDate <= $this->endOfWeek)
                        @php
                            
                            $this->today = $currentDate;
                            
                            $tempThHTML .=
                                ' <th>' .
                                $currentDate->format('l') .
                                '<br>
                                            <small>' .
                                $currentDate->format('Y-m-d') .
                                '</small>
                                        </th>';
                            
                            $tempTdHTML .=
                                ' <td>
                          <select class="form-select" id="shift_' .
                                $currentDate->format('Y-m-d') .
                                '" wire:model="shift.' .
                                $currentDate->format('Y-m-d') .
                                '" aria-label="Default select example" >
                                                ' .
                                $this->shiftsHTML .
                                '
                       </select>
                                        </td>';
                            $currentDate->modify('+1 day');
                            $this->totalDays += 1;
                        @endphp
                    @endwhile



                    <h2>Week{{ $i }}</h2>
                    <div class="card card-body border-0 shadow table-wrapper table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="tranformedTH">Days</th>
                                    {!! $tempThHTML !!}
                                </tr>

                                <tr class="trWithoutHover">
                                    <th class="tranformedTH">Shifts</th>

                                    {!! $tempTdHTML !!}
                                </tr>
                            </thead>
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

    </form>

</div>



</div>
