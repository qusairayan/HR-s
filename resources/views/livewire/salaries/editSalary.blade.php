<main>

    <form wire:submit.prevent="add" action="#" method="POST">



        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">

            <h1>Edit Salary</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">General information</h2>



                    
                    <div class="row">

                        <div class="col-md-9 mb-3">
                          
                            <div>
                                <label for="name">Employee</label>
                                <input class="form-control datepicker-input" type="text" 
                                placeholder="Enter Employee's salary" value="{{$salary->user_name}}" disabled required>

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h2 class="h5 my-4">Salary information</h2>

                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="salary">Salary</label>
                            <div class="input-group">


                                <input class="form-control datepicker-input" type="text" id="salary"
                                    placeholder="Enter Employee's salary" wire:model="salary" value="{{$salar->amount}}" autofocus required>


                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>







                        <div class="col-md-6 mb-3">
                            <label for="bank">Bank</label>
                            <div class="input-group">

                                <select class="form-select mb-0" id="bank" aria-label="bank select example"
                                    wire:model="bank" autofocus required>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}" {{$salar->bank == $bank->id ? 'selected':''}}>
                                            {{ $bank->name }} - {{ $bank->company_name }}</option>
                                    @endforeach
                                    <option value="" disabled selected hidden>Select Employee's bank
                                    </option>

                                </select>

                                @error('bank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="IBAN">IBAN</label>
                            <div class="input-group">


                                <input class="form-control datepicker-input" type="text" id="IBAN"
                                    placeholder="Enter Employee's IBAN" wire:model="IBAN" autofocus required value="{{$salary->IBAN}}">


                                @error('IBAN')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>



                    </div>









                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2"
                            wire:loading.attr="disabled">Save </button>
                    </div>

                </div>

            </div>


            <div class="col-12 col-xl-4">
                <div class="row ">
                    <div class="col-12 mb-4">
                        @if ($this->employeeName != '')
                            <div class="align-items-center card shadow border-0 text-center p-0">

                                <div class="card-body pb-5">
                                    <img src="{{ asset('storage/profile/' . $image) }}"
                                        class="avatar-xl rounded-circle mx-auto mb-4" alt="Profile Pic">
                                    <h4 class="h3">{{ $this->employeeName }}</h4>
                                    <h5 class="fw-normal">{{ $this->departmentName . ' - ' . $this->position }}</h5>

                                </div>

                                <!-- End of Form -->
                            </div>
                            @endif
                            <div class="col-12">
                                <div class="card card-body border-0 shadow mb-4 mb-xl-0">
                                    <h2 class="h5 mb-4">Salary Status</h2>
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom">
                                            <div>
                                                <h3 class="h6 mb-1">Active</h3>
                                                <p class="small pe-4">Employee's Salary Active</p>
                                            </div>
                                            <div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="user-notification-1"
                                                        id="status" wire:model="status">
                                                    <label class="form-check-label" for="user-notification-1"></label>
                                                </div>
                                            </div>
                                        </li>
                                        
        
                                    </ul>
                                </div>
                            </div>
                    </div>

                </div>
                @if ($showSavedAlert)
                    <div class="alert alert-success" role="alert">
                        Saved!
                    </div>
                @endif

                @if ($showDemoNotification)
                    <div class="alert alert-info mt-2" role="alert">
                        You cannot do that in the demo version.
                    </div>
                @endif
            </div>
        </div>
    </form>
</main>
