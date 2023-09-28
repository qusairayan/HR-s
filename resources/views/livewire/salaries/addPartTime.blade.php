<main>
    <form wire:submit.prevent="add" action="#" method="POST">



        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">

            <h1>Part time Salary</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">General information</h2>



                    <div class="row">

                        <div class="col-md-5 mb-3">
                            <div>
                                <label for="comapny">Company</label>
                                <select class="form-select mb-0" id="company" aria-label="company select example"
                                    wire:model="company" autofocus required>
                                    @foreach ($companies as $comp)
                                        <option value="{{ $comp->id }}">
                                            {{ $comp->name }} </option>
                                    @endforeach
                                    <option value="" disabled selected hidden>Select Employee's Company
                                    </option>

                                </select>
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>




                        <div class="col-md-6 mb-3">

                            <div>
                                <label for="employee">Employee</label>
                                <select {{ count($partime) == 0 ? 'disabled' : '' }} class="form-select mb-0"
                                    id="employee" aria-label="employee select example" wire:model="employee" autofocus
                                    required>
                                    @foreach ($partime as $emp)
                                        <option value="{{ $emp->id }}">
                                            {{ $emp->name }} </option>
                                    @endforeach
                                    <option value="" disabled selected hidden>Select Employee's
                                    </option>

                                </select>
                                @if ($this->noSalary)
                                    <span class="invalid-feedback"> This employee doesn't have Salary record, Add salary
                                        info</span>
                                @endif

                                @error('employee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if (count($partime) == 0)
                            <h3 class="invalid-feedback"> There are no valid Employees within this company</h2>
                        @endif
                        <h2 class="h5 my-4">Salary @if ($this->period)
                                - {{ $this->period }}
                            @endif
                        </h2>

                    </div>
                    <div class="row align-items-center">

                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="from" class="h5 mt-5">From</label>

                                <input class="form-control datepicker-input" type="date" id="from"
                                    @if (!$this->employee || $this->noSalary) disabled @endif placeholder="From - To date"
                                    wire:model="from">


                                @error('from')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="to" class="h5 mt-5">To </label>

                                <input class="form-control datepicker-input" type="date" id="to"
                                    @if (!$this->employee || $this->noSalary) disabled @endif placeholder="To date"
                                    wire:model="to">


                                @error('to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>



                        @if ($this->dateSet)
                            <span class="invalid-feedback">This date al ready set</span>
                        @endif

                        @if ($this->date_incorrect)
                            <span class="invalid-feedback">The To date must be after From date</span>
                        @endif


                        @if ($this->total)
                        <div class="row align-items-center justify-content-end">
                            <div class="col-md-3 mb-3" style="text-align:right;">
                                <h3 class="h5 my-4">Total:</h3>
                            </div>
                            <div class="col-md-3 mb-3">
                                <p style="margin: 0;">{{ $this->total }}</p>
                            </div>
                        </div>
                        @endif





                    </div>





                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2"
                            wire:loading.attr="disabled">Save </button>
                    </div>

                </div>

            </div>



        </div>
    </form>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Your JavaScript code using jQuery -->
    <!-- Your JavaScript code -->
    <script>
        $(function() {
            $('input[id="fromTo"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                // Update the Livewire component when the datepicker value changes
                @this.set('fromTo', start.format('YYYY-MM-DD') + ',' + end.format('YYYY-MM-DD'));

                // If you also need to update the 'end' date, do the same for 'to'
                // @this.set('to', end.format('YYYY-MM-DD'));
            });
        });
    </script>
</main>
