<div class="add-new-salary">
    <form wire:submit.prevent="add" action="#" method="POST">



        <div class="d-flex justify-content-around  flex-wrap flex-md-nowrap align-items-center py-4">

            <h1>Full Time Salary</h1>
            <h1 style="padding: 4px" class="text-center border border-2 border-primary">ID : {{++$monthlyPayrollId}}</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card card-body border-0 shadow mb-4">

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex justify-content-between  flex-wrap flex-md-nowrap align-items-center">
                                <div style="margin:0 5px">
                                    <label for="id">ID</label>
                                    <input class="form-control" style="width: 30px;padding:7px;text-align:center" value="{{$user}}" disabled type="text"></div>
                                <div style="width: 100%;margin:0 5px" class="">
                                    <label for="Employee">Employee's</label>
                                <select class="form-select mb-0" id="company" aria-label="Employee select example"
                                    wire:model="user" autofocus required>
                                    <option value="" hidden="" selected="">Employee's</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }} </option>
                                    @endforeach
                                    <option value="" disabled selected hidden>Select Employee's Company
                                    </option>
                                </select>
                                @error('Employee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>


                            </div>
                        </div>
                        <div class="col-4"><label for="month">Month</label><input wire:model="date" id="month" name="month" type="month" class="form-control"></div>
                        <div class="col-md-4 mt-3">
                            <button type="submit" class="w-100 btn btn-gray-800 mt-2 animate-up-2" wire.click="add()" wire:loading.attr="disabled">Show</button>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3">
                        <div class="col-4"><label for="Dedctions">Dedctions</label><input id="Dedctions" name="Dedctions" type="text" value="{{$userDeduction}}" disabled class="form-control"></div>
                        <div class="col-4"><label for="Allownces">Allownces</label><input id="Allownces" name="Allownces" type="text" value="{{$userAllownces}}" disabled class="form-control"></div>
                        <div class="col-4"><label for="salary">Main Salary</label><input id="salary" name="salary" type="text" value="{{$userSalary}}" disabled class="form-control"></div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-6"><label for="netsalary">Net Salary</label><input id="netsalary" name="netsalary" type="text" value="{{$netSalary}}" disabled class="form-control"></div>
                        <div class="col-6"><button type="submit" wire:click="approve()" class="btn btn-primary w-100 mt-4">Approve</button>
                    </div>
                    <div class="">{{$err}}</div>






                </div>

            </div>



        </div>
    </form>
</div>
