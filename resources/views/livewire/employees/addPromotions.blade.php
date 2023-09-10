<main>

    <form wire:submit.prevent="create" action="#" method="POST">



        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">

            <h1>Add New Promotion</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">General information</h2>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="name">Company</label>
                                <select class="form-select mb-0" id="company" aria-label="company select example"
                                    wire:model="company" autofocus >
                                  
                                    <option selected>Select Employee's Company</option>
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
                        <div class="col-md-5 mb-3">
                            <div>
                                <label for="department">Department</label>
                                <select class="form-select mb-0" id="department" aria-label="department select example"
                                    wire:model="department" autofocus  {{$this->company==''?'disabled': ''}}  >

                                    <option selected>Select Employee's Department</option>


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

                        <div class="col-md-5 mb-3">
                            <div>
                                <label for="user">Employee</label>
                                <select class="form-select mb-0" {{$this->department==''?'disabled': ''}}   id="user" aria-label="user select example"
                                    wire:model="user" autofocus >
                                    <option selected>Select Employee</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }} </option>
                                    @endforeach

                                </select>
                                @error('user')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        


                        <div class="col-md-5 mb-3">
                            <label for="position">Position</label>
                            <div class="input-group">

                                <input class="form-control " type="text" id="position"
                                    placeholder="Enter Employee's position" wire:model="position" autofocus >


                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>












                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="salary">Salary</label>
                            <div class="input-group">

                                <input class="form-control datepicker-input" type="text" id="salary"
                                    placeholder="Enter Employee's salary" wire:model="salary" autofocus >
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="start_date">Start Date</label>
                            <div class="input-group">

                                <input class="form-control datepicker-input" type="date" id="from"
                                    placeholder="Enter Employee's start_date" wire:model="from" autofocus
                                    >
                                @error('from')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                    </div>








                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2"
                            wire:loading.attr="disabled">Save All</button>
                    </div>

                </div>

            </div>





        </div>
        </div>
    </form>
</main>
