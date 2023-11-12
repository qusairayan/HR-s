<div class="public_banks">
    <title>Bank </title>
    <div class="title">
        <h1>Banks</h1>
    </div>
    <div class="create-bank row m-5">
        <div class="col-md-6 col-12">
            <input class="form-control" type="text" wire:model="bankName" name="bankName" id="bankName" placeholder="Enter Bank Name">
        </div>
        <div class="col-md-6 col-12">
            <button class="btn btn-primary w-100" wire:click="create">Create New</button>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>

                <th class="border-gray-200">ID</th>
                <th class="border-gray-200">Bank</th>
                <th class="border-gray-200">Action</th>
                <th class="border-gray-200">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banks as $item)
            <tr>
                <td class="border-0 fw-bold"><span class="fw-normal">{{$item->id}}</span></td>
                <td class="border-0 fw-bold"><span class="fw-normal">{{$item->bankName}}</span></td>
                <td class="border-0 fw-bold"><button wire:click="delete({{$item->id}})" class="btn btn-danger">Delete</button></td>
                <td class="border-0 fw-bold"><button data-bs-toggle="modal" data-bs-target="#modal-addTypeDeduction" class="btn btn-success">Edit</button></td>
            </tr>
            @endforeach
</tbody>
</table>
<div wire:ignore.self class="modal fade" id="modal-addTypeDeduction" tabindex="-1" role="dialog"
    aria-labelledby="modal-addTypeDeduction" aria-hidden="true" wire:ignore>
    <div class="modal-dialog modal-info modal-dialog-centered" role="document">
        <div class="modal-content bg-gradient-secondary" style="background: #13223d">
            <button type="button" class="btn-close theme-settings-close fs-6 ms-auto" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="modal-header">
                <p class="modal-title text-gray-200" id="modal-title-addTypeDeduction">
                    Update Bank
                </p>
            </div>            
            <div class="m-5">
                <input type="text" class="mt-4 mb-4 form-control" wire:model="bankName" name="bankNameupdade" id="bankNameupdade" value="{{$item->bankName}}">
                <button class="mt-4 mb-4 btn btn-success w-100" wire:click="update({{$item->id}})">Update Bank</button>
            </div>
        </div>
        
    </div>
</div>
</div>