
<div>
        <form wire:submit.prevent="save" method="POST">
            @csrf
                <div class="row">
                <div class="col-md-4 mb-4">
                    <label for="id">name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="username" id="name" placeholder='{{$username}}' disabled>
                    </div>  
                </div>
                <div class="col-md-4 mb-4">
                    <label for="salary">salary</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="salary" id="salary" placeholder="{{$salary}}" disabled>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="salary">Date</label>
                    <div class="input-group">
                        <input type="text" class="form-control"  name="date"   id="Date" placeholder="{{$date}}" disabled>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="bank">Bank Name</label>
                    <div class="input-group">
                        <input type="text" wire:model="userbank" class="form-control" name="userbank" id="bank" placeholder="{{$userbank}}" >
                    </div>  
                    @error('userbank') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-4">
                    <label for="company">Company Name</label>
                    <div class="input-group">
                        <input type="text" wire:model="company" class="form-control" name="company"  id="Date" placeholder="{{$company}}">
                    </div>  
                    @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-4">
                    <label for="month">month</label>
                    <div class="input-group">
                        <input wire:model='month' type="month" class="form-control" id="month" name="month" >
                    </div>  
                    @error('month') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
    
                <div class="col-md-4 mb-4">
                    <label for="account_number">Account Number</label>
                    <div class="input-group">
                        <input  wire:model="accountNo" type="text" class="form-control" name="accountNo" id="accountNo" placeholder="Account Number" >
                    </div>  
                    @error('accountNo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-4">
                    <label for="amount_written">The amount is written</label>
                    <div class="input-group">
                        <input wire:model='amount_written' type="text" class="form-control" name="amount_written" id="amount_written" placeholder="The amount is written" >
                    </div>  
                    @error('amount_written') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-4">
                    <label>
                        Managers Signatures
                    </label>
                    <select class="form-control" wire:model="signatures" id="signatures" name="signatures[]" multiple>
                        @foreach ($signaturesName as $item)
                            <option value={{$item->id}}>{{$item->signature}}</option>                            
                        @endforeach

                    </select>
                    <p class="text-danger">{{$err}}</p>
    
    
                </div>
                    <div class="d-grid">
                    <button type="submit" class="btn btn-gray-800">Deposit Salary</button>
                </div>
    
            </div>
        </form>
        <form wire:submit.prevent="addsignatures" method="POST">
            @csrf
                <div style="margin: 50px 0" class="row">
                <div style="margin: 0 !important" class="col-md-6 mb-6">
                    <label for="Signatures">Signatures</label>
                    <div class="input-group">
                        <input wire:model="addseg" type="text" class="form-control" name="Signatures" id="name" placeholder='Signatures'>
                    </div>  
                </div>
                    <div style="margin: 0 !important"  class="col-md-6 mb-6">
                    <button style="    margin: 23px 0 0 0;" type="submit" class="w-100 btn btn-gray-800">Add Signatures</button>
                </div>
            </div>
        </form>
    </div>

