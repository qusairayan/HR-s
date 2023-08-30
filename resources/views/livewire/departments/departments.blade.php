<div>

    <title>Departments </title>

    <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center py-4" >
        
        <div class="btn-toolbar mb-2 mb-md-0" >
            <a data-bs-toggle="modal" data-bs-target="#modal-notification"
                class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                New Department
            </a>

        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <div class="input-group me-2 me-lg-3 fmxw-400">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input wire:model="search" type="text" class="form-control" placeholder="Search Employee">

                </div>
            </div>
            <div class="col-4 col-md-2 col-xl-1 ps-md-0 text-end">
                <div class="dropdown">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0">
                        <span class="small ps-3 fw-bold text-dark">Show</span>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg
                                class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg></a>
                        <a class="dropdown-item fw-bold" href="#">20</a>
                        <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div wire:ignore.self class="modal fade" id="modal-notification" tabindex="-1" role="dialog"
        aria-labelledby="modal-notification" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-info modal-dialog-centered" role="document">
            <div class="modal-content bg-gradient-secondary" style="background: #13223d">
                <button type="button" class="btn-close theme-settings-close fs-6 ms-auto" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-header">
                    <p class="modal-title text-gray-200" id="modal-title-notification">
                        Add Department
                    </p>
                </div>




                <form wire:submit.prevent="addDepartment">

                    <div class="row p-md text-white">

                    </div>

                    <div class="modal-body text-white">
                        <div class="py-3 text-center">

                            <h4 class="h5 py-2">Name:</h4>

                            <div class="input-group mt-1">
                                <input type="text" class="form-control" placeholder="Department name"
                                    wire:model="name">


                                @error('name')
                                    <div class="invalid-feedback py-2"> {{ $message }} </div>
                                @enderror

                            </div>

                        </div>


                        <div class="py-3 text-center">

                            <h4 class="h5 py-2">Company:</h4>

                            <div class="input-group mt-1">
                                <select class="form-control" wire:model="company">

                                    <option value="" selected disabled> Select Company </option>

                                    @foreach ($companies as $comp)
                                        <option value="{{ $comp->id }}">{{ $comp->name }}</option>
                                    @endforeach
                                </select>


                                @error('company')
                                    <div class="invalid-feedback py-2"> {{ $message }} </div>
                                @enderror

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>










    <div wire:ignore.self class="modal fade" id="modal-edit" tabindex="-1" role="dialog"
        aria-labelledby="modal-edit" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-info modal-dialog-centered" role="document">
            <div class="modal-content bg-gradient-secondary" style="background: #13223d">
                <button type="button" class="btn-close theme-settings-close fs-6 ms-auto" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-header">
                    <p class="modal-title text-gray-200" id="modal-title-edit">
                        Edit Department
                    </p>
                </div>




                <form wire:submit.prevent="saveEdit">

                    <div class="row p-md text-white">

                    </div>

                    <div class="modal-body text-white">
                        <div class="py-3 text-center">

                            <h4 class="h5 py-2">Name:</h4>

                            <div class="input-group mt-1">
                                <input type="text" class="form-control" placeholder="Department name"
                                    wire:model="nameEdit">


                                @error('name')
                                    <div class="invalid-feedback py-2"> {{ $message }} </div>
                                @enderror

                            </div>

                        </div>


                        <div class="py-3 text-center">

                            <h4 class="h5 py-2">Company:</h4>

                            <div class="input-group mt-1">
                                <select class="form-control" wire:model="companyEdit">

                                    <option value="" selected disabled> Select Company </option>

                                    @foreach ($companies as $comp)
                                        <option value="{{ $comp->id }}"
                                            @if ($comp->id == $this->companyEdit) selected @endif>{{ $comp->name }}
                                        </option>
                                    @endforeach
                                </select>


                                @error('company')
                                    <div class="invalid-feedback py-2"> {{ $message }} </div>
                                @enderror

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>

                    <th class="border-gray-200">#</th>
                    <th class="border-gray-200">Name</th>
                    <th class="border-gray-200">company</th>
                    <th class="border-gray-200">Count Of employee</th>
                    <th class="border-gray-200">Action</th>
                </tr>
            </thead>
            <tbody>



                @foreach ($departments as $department)
                    <tr>




                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $department->dep_id }}
                            </span>
                        </td>







                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $department->dep_name }}
                            </span>
                        </td>

                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $department->company_name }}
                            </span>
                        </td>

                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $department->user_count }}

                            </span>
                        </td>

                        <td class="border-0 fw-bold">

                            <div class="btn-group">

                                <a class="dropdown-item" wire:click="editShow({{ $department->dep_id }})"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit"><span
                                        class="fas fa-edit me-2"></span>Edit</a>
                            </div>
                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>
            {{ $departments->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
