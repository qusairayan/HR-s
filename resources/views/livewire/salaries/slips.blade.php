<div>
    <title>Salary Slips </title>
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
                    <li class="breadcrumb-item active" aria-current="page">Payroll / Salary Slips</li>
                </ol>
            </nav>
            <h2 class="h4">All slips</h2>
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


            <div class="col-md-4 mb-3">

                <div>
                    <label for="date">Date</label>
                    <input  class="form-control datepicker-input" type="month" id="date"
                        placeholder="Select Month and Year" wire:model="date">


                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>




            <div class="col-md-4 d-flex align-items-center justify-content-center">


                <button class="btn btn-success" style="width: 100%;" type="button" wire:click="report()">View
                    Slip</button>

            </div>


        </div>








    </div>










</div>
<script>
    const dss = new Date();
    let month = dss.getMonth()+1;
    let year = dss.getFullYear();
    document.getElementById("date").setAttribute("max", `${year}-${month}`);
</script>