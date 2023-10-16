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
                        <div class="col-md-6 mb-3">

                            <div>
                                <label for="employee">Employee</label>
                                <input class="form-control " type="text" id="employee" disabled
                                    wire:model="employee" disabled>


                            </div>
                        </div>

                        <h2 class="h5 my-4">Salary @if ($this->period)
                                - {{ $this->period }}
                            @endif
                        </h2>

                    </div>
                    <div class="row align-items-center">

                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="from" class="h5 mt-5">From</label>

                                <input class="form-control datepicker-input" type="date" id="from"
                                    @if (!$this->employee || $this->noSalary) disabled @endif placeholder="From - To date"
                                    wire:model="from" disabled>


                                @error('from')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="col-md-4 mb-3">
                            <div>
                                <label for="to" class="h5 mt-5">To </label>

                                <input class="form-control datepicker-input" type="date" id="to"
                                    @if (!$this->employee || $this->noSalary) disabled @endif placeholder="To date"
                                    wire:model="to" disabled>


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
                            <div class="col-md-4 mb-4 " style="text-align:right; margin-top:auto;">

                                <div class="align-items-end d-flex justify-content-sm-around">
                                    <h3 class="h5">Total:</h3>

                                    <p class="h5">{{ $this->total }}</p>
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

</main>
