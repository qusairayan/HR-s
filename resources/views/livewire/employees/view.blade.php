<div wire:ignore.self>

    <form wire:submit.prevent="save" action="#">


        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">

            <h1>View Employee</h1>
        </div>
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">General information</h2>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <div>
                                <label for="id">ID</label>
                                <input disabled class="form-control" type="text" disabled value="{{ $user->id }}">


                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div>
                                <label for="name">Name</label>
                                <input disabled class="form-control" id="name" type="text"
                                    placeholder="Enter Employee's Name" value="{{ $user->name }}" wire:model="name">

                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <div>
                                <label for="username">Username</label>
                                <input disabled class="form-control" id="username" type="text" wire:model="username"
                                    value="{{ $user->username }}">
                            
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div>

                                <label for="comapny">Company</label>
                     
                                <input disabled class="form-control" id="username" type="text" wire:model="company_name"
                                value="{{ $user->company_name }}">

                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="name">Department</label>
                       
                                <input disabled class="form-control" id="username" type="text" wire:model="department_name"
                                value="{{ $user->department_name }}">

                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="position">Position</label>
                            <div class="input-group">




                                <input disabled class="form-control" id="position" type="text" wire:model="position"
                                value="{{ $user->position }}">
                        
                            </div>
                        </div>




                        <div class="col-md-5 mb-3">
                            <label for="position">Employee Type</label>
                            <div class="input-group">

                                <input disabled class="form-control" id="type" type="text" wire:model="type"
                                value="{{ $user->type }}">

                            </div>
                        </div>


                        @if ($this->type == 'part-time')
                        <div class="col-md-5 mb-3">
                            <label for="position">Part Time Period</label>
                            <div class="input-group">

                                <input disabled class="form-control" id="part_time" type="text" wire:model="part_time"
                                value="{{ $user->part_time }}">
                             
                            </div>
                        </div>
                    @endif




                       



                        <div class="col-md-5 mb-3">
                            <label for="start_date">Start Date</label>
                            <div class="input-group">

                                <input disabled class="form-control datepicker-input" type="date" id="start_date"
                                    placeholder="Enter Employee's start_date" wire:model="start_date" autofocus
                                    required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>


                        

                    </div>



                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="birthday">Birthday</label>
                            <div class="input-group">

                                <input disabled class="form-control datepicker-input" type="date" id="birthday"
                                    value="{{ $user->birthday }}" wire:model="birthday">
                                @error('birthday')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender">Gender</label>
                        
                            <input disabled class="form-control" id="gender" type="text" wire:model="gender"
                            value="{{ $user->gender }}">

                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="ID_no" autofocus required>ID Number</label>
                            <div class="input-group">

                                <input disabled class="form-control datepicker-input" value="{{ $user->ID_no }}"
                                    type="text" id="ID_no" placeholder="Enter Employee's National ID"
                                    wire:model="ID_no">
                                @error('ID_no')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <h2 class="h5 my-4">Salar information</h2>

                        <div class="col-md-6 mb-3">
                            <label for="salary">Salary</label>
                            <div class="input-group">

                                <input disabled class="form-control datepicker-input" type="text" id="salary"
                                    placeholder="Enter Employee's salary" wire:model="salary" autofocus required>
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="bank">Bank</label>
                            <div class="input-group">

               
                            <input disabled class="form-control" id="bank" type="text" wire:model="bank"
                            value="{{ $user->bank }}">

                                @error('bank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="IBAN">IBAN</label>
                            <div class="input-group">

                                <input disabled class="form-control datepicker-input" type="text" id="IBAN"
                                    placeholder="Enter Employee's IBAN" wire:model="IBAN" autofocus required>
                                @error('IBAN')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>


                        

                    </div>




                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input disabled class="form-control" type="email" wire:model="email"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input disabled class="form-control" id="phone" type="number"
                                    placeholder="+962790000000" value="{{ $user->phone }}" wire:model="phone">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <h2 class="h5 my-4">Location</h2>
                    <div class="row">
                        <div class="col-sm-9 mb-3">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input disabled class="form-control" id="address" type="text"
                                    placeholder="Enter Employee's home address" wire:model="address">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                    </div>



                    <div class="col-12">
                        <div class="card card-body border-0 shadow mb-4 mb-xl-0">
                            <h2 class="h5 mb-4">Employment</h2>


                            
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom">
                                    <div>
                                        <h3 class="h6 mb-1">Active</h3>
                                        <p class="small pe-4">Employment / Unemployment</p>
                                    </div>

                                    

                                    <div>
                                        <div class="form-check form-switch">
                                            <input disabled class="form-check-input" type="checkbox" id="status" wire:model="status"
                                                {{ $user->status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="user-notification-1"></label>
                                        </div>
                                    </div>
                                </li>


                            </ul>


                            @if($this->status != 1)
                                    <div class="form-group">
                                        <label for="unemployment">End date</label>
                                        <input disabled class="form-control" id="unemployment" type="date"
                                            placeholder="Enter Employee's home unemployment Date" wire:model="unemployment">
                                        @error('unemployment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    @endif
                        </div>
                    </div>
                    
                  

                </div>

            </div>



            <div class="col-12 col-xl-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card shadow border-0 text-center p-0">

                            <div class="card-body pb-5">

                              @if($user->image)
                                    <img src="/storage/profile/{{ $user->image }}"
                                        class="avatar-xl rounded-circle mx-auto mb-4"
                                        alt="{{ $user->name }} Profile Pic">
                                @endif


                                <h4 class="h3">{{ $user->name }}</h4>
                                <h5 class="fw-normal">{{ $user->position }}</h5>
                                <p class="text-gray mb-4">Start Date: {{ $user->start_date }}</p>
                                

                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="card shadow border-0 text-center p-0">

                            <div class="card-body pb-5">
                                <h4 class="h3">Contract</h4>

                                @if ($this->contract)
                                    <embed src="/storage/contracts/{{ $this->contract }} type="application/pdf"
                                        width="100%" height="600px" class="avatar-xxl mx-auto" />
                                        <a class="mb-4"style="color: #3892ff;" href="{{ route('viewContract', ['filename' => $this->contract]) }}" target="_blank">open Contract in new tab</a>
                                    {{-- <a  href="/storage/contracts/{{ $this->contract }}" target="_blangk" class="mb-4"style="color: #3892ff;"> open Contract in new tab </a> --}}
                                @endif


                                


                            


                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="signedDate">Sgined date</label>
                                        <input disabled class="form-control" id="signedDate" type="date"
                                            placeholder="Enter Employee's home signedDate" wire:model="signedDate">
                                        @error('signedDate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                

                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="align-items-center card shadow border-0 text-center p-0">

                            <div class="card-body pb-5">
                                <h4 class="h3">Employee's ID card image</h4>

                                @if($user->ID_image)
                                    <img src="/storage/profile/{{ $user->ID_image }}" class="avatar-xxl mx-auto mb-4"
                                        alt="ID Image">
                                        <a href="/storage/profile/{{ $user->ID_image }}" target="_blangk"
                                            class="mb-4"style="color: #3892ff;"> open Image in new tab </a>
                                @endif




                            </div>
                            

                            <!-- End of Form -->
                        </div>
                    </div>




                    <div class="col-12 mb-3">
                        <div class="align-items-center card shadow border-0 text-center p-0">

                            <div class="card-body pb-5">

                                @if($user->license_image)
                                    <img src="/storage/profile/{{ $user->license_image }}"
                                        class="avatar-xxl mx-auto mb-4" alt="License Image">
                                        <a href="/storage/profile/{{ $user->license_image }}" target="_blangk"
                                            class="mb-4"style="color: #3892ff;"> open Image in new tab </a>
                                @endif

                                <h4 class="h3">Employee's License image</h4>

                            </div>
                           
                            <!-- End of Form -->
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
</div>
