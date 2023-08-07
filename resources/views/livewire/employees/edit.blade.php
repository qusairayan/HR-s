<div wire:ignore.self>

    <form wire:submit.prevent="save" action="#">


        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">

            <h1>Edit Employee</h1>
        </div>
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">General information</h2>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <div>
                                <label for="id">ID</label>
                                <input class="form-control" type="text" disabled value="{{ $user->id }}">


                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div>
                                <label for="name">Name</label>
                                <input class="form-control" id="name" type="text"
                                    placeholder="Enter Employee's Name" value="{{ $user->name }}" wire:model="name">

                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <div>
                                <label for="username">Username</label>
                                <input class="form-control" id="username" type="text" wire:model="username"
                                    value="{{ $user->username }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div>

                                <label for="comapny">Company</label>
                                <select class="form-select mb-0" id="company_id" aria-label="company select example"
                                    wire:model="company_id" autofocus required>
                                    @foreach ($companies as $comp)
                                        <option value="{{ $comp->id }}"
                                            {{ $comp->id == $user->company_id ? 'selected' : '' }}>
                                            {{ $comp->name }} </option>
                                    @endforeach


                                </select>
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="name">Department</label>
                                <select class="form-select mb-0" id="department_id"
                                    aria-label="department select example" wire:model="department_id">
                                    @foreach ($departments as $dept)
                                        <option {{ $user->dept == $dept->id ? 'selected' : '' }}
                                             value="{{ $dept->id }}">
                                            {{ $dept->name }} </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="position">Position</label>
                            <div class="input-group">

                                <input class="form-control datepicker-input" type="text" id="position"
                                    value="{{ $user->position }}" placeholder="Enter Employee's Position"
                                    wire:model="position" autofocus required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>



                        <div class="col-md-6 mb-3">
                            <label for="role">Role</label>
                            <div class="input-group">


                                <select class="form-select mb-0" id="role" aria-label="role select example"
                                    wire:model="role" autofocus required>
                                   
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{$this->user->hasRole($role->name) ? ' selected':''}}>
                                            {{ $role->name }} </option>
                                    @endforeach

                                </select>


                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>



                        <div class="col-md-6 mb-3">
                            <label for="type">Employement Type</label>
                            <div class="input-group">
                                <select class="form-select mb-0" id="type"
                                aria-label="type select example" wire:model="type">
                               <option {{$this->type=='1'? 'selected':''}} value="1" >Full-Time</option>
                               <option {{$this->type=='2'? 'selected':''}} value="2" >Part-Time</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="salary">Salary</label>
                            <div class="input-group">

                                <input class="form-control datepicker-input" type="text" id="salary"
                                    value="{{ $user->salary }}" placeholder="Enter Employee's salary"
                                    wire:model="salary" autofocus required>
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>


                    </div>

                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="birthday">Birthday</label>
                            <div class="input-group">

                                <input class="form-control datepicker-input" type="date" id="birthday"
                                    value="{{ $user->birthday }}" wire:model="birthday">
                                @error('birthday')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender">Gender</label>
                            <select class="form-select mb-0" id="gender" aria-label="Gender select example"
                                wire:model="gender">
                                <option value="Male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="ID_no" autofocus required>ID Number</label>
                            <div class="input-group">

                                <input class="form-control datepicker-input" value="{{ $user->ID_no }}"
                                    type="text" id="ID_no" placeholder="Enter Employee's National ID"
                                    wire:model="ID_no">
                                @error('ID_no')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" wire:model="email"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" id="phone" type="number"
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
                                <input class="form-control" id="address" type="text"
                                    placeholder="Enter Employee's home address" wire:model="address">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
                    </div>

                </div>

            </div>



            <div class="col-12 col-xl-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card shadow border-0 text-center p-0">

                            <div class="card-body pb-5">

                                @if ($newImage)
                                    <img src="{{ $newImage }}" class="avatar-xl rounded-circle mx-auto mb-4"
                                        alt="{{ $user->name }} Profile Pic">
                                @elseif($user->image)
                                    <img src="/storage/profile/{{ $user->image }}"
                                        class="avatar-xl rounded-circle mx-auto mb-4"
                                        alt="{{ $user->name }} Profile Pic">
                                @endif


                                <h4 class="h3">{{ $user->name }}</h4>
                                <h5 class="fw-normal">{{ $user->position }}</h5>
                                <p class="text-gray mb-4">{{ $dept->name }}</p>
                                <p class="text-gray mb-4">Start Date: {{ $user->start_date }}</p>
                                <div class="col-sm-10 mb-3 ">
                                    <label for="formFile" class="form-label">upload Employee's image</label>
                                    <input class="form-control" type="file" id="image" wire:model="image">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card card-body border-0 shadow mb-4 mb-xl-0">
                            <h2 class="h5 mb-4">Activities</h2>
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom">
                                    <div>
                                        <h3 class="h6 mb-1">Active</h3>
                                        <p class="small pe-4">Employee's Account Active</p>
                                    </div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="user-notification-1"
                                                id="status" wire:model="status"
                                                {{ $user->status == 1 ? 'checked' : '' }}>
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
</div>
