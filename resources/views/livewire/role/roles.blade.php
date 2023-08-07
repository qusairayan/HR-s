<div>
    <title>Roles </title>

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
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                </ol>
            </nav>
            <h2 class="h4">Staff Roles</h2>

        </div>


        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-block btn-gray-800 mb-3" data-bs-toggle="modal"
                data-bs-target="#modal-notification">Add New Role</button>
        </div>
    </div>

    <!-- Modal Content -->
    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-info modal-dialog-centered" role="document">
            <div class="modal-content bg-gradient-secondary" style="background: #13223d">
                <button type="button" class="btn-close theme-settings-close fs-6 ms-auto" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-header">
                    <p class="modal-title text-gray-200" id="modal-title-notification" style="color: #fb503b;">Add New
                        Role</p>
                </div>
                <form wire:submit.prevent="addRole">
                    <div class="modal-body text-white">
                        <div class="py-3 text-center">
                            <span class="modal-icon">
                                <i class="fas fa-suitcase addNewRole-icon"></i>
                            </span>

                            <div class="input-group mt-1">
                                <input type="text" class="form-control" id="roleName" wire:model="roleName"
                                    placeholder="Role Name" aria-label="Role Name" fdprocessedid="x0f6n">
                                @error('roleName')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Add Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="card card-body border-0 shadow table-wrapper table-responsive">



        <div class="row">

            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">ID</th>
                            <th class="border-0">Name</th>
                            <th class="border-0"> </th>
                        </tr>
                    </thead>
                    <tbody>




                        @foreach ($this->roles as $role)
                            <tr>
                                <td class="fw-bold align-items-center">{{ $role->id }} </td>
                                <td class="fw-bold align-items-center">
                                    {{ $role->name }}
                                </td>

                                <td class="border-0 fw-bold">

                                    <div class="btn-group">
                                        <button
                                            class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="icon icon-sm">
                                                <span class="fas fa-ellipsis-h icon-dark"></span>
                                            </span>
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu py-0">
                                            <a class="dropdown-item"
                                                href="{{ route('permissions.role.edit', ['role' => $role->id]) }}"><span
                                                    class="fas fa-edit me-2"></span>Edit</a>
                                            <a class="dropdown-item text-danger rounded-bottom"
                                                wire:click="removeRole('{{ $role->name }}')"><span
                                                    class="fas fa-trash-alt me-2"></span>Remove</a>
                                        </div>
                                        
                                    </div>
                                </td>
                            </tr>
                            <!-- End of Item -->
                        @endforeach
                    </tbody>
                </table>

                <div>
                    {{-- {{ $this->roles->links('vendor.pagination.custom') }} --}}
                </div>
            </div>

        </div>
        <!-- End of Form -->


    </div>








</div>
</div>



</div>
