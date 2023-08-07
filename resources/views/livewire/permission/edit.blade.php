
<div>
    <title>Edit Permissions </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4 mt--3rem">
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
                    <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                </ol>
            </nav>
            <div>
                <div class="mx-3">
                    <h3 class="h5">{{ $this->name }}</h3>
                    <div class="d-block d-sm-flex">
                        <div>
                            <h4 class="h6 fw-normal text-gray d-flex align-items-center mb-3 mb-sm-0">
                                {{ '@' . $this->username }}
                            </h4>
                        </div>
                        <span class="fw-normal text-gray mx-2"> {{ $this->department->name . ' - ' . $this->position }}
                        </span>
                        @foreach ($this->user->getRoleNames() as $role)
                            <div class="ms-sm-3 badgeEditPermission"><span
                                    class="badge super-badge bg-warning">{{ $role }} </span></div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>





    <div class="row perRoleCont py-3 card">

        <div class="col-5 px-0">
            <div class="card border-0 shadow">
                <div class="card-header pb-5">
                    <h2 class="fs-5 fw-bold mb-1">System Permissions</h2>
                    <div id="map">

                    </div>



                </div>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="text" class="form-control" id="permissionSearch" wire:model="permissionSearch"
                        placeholder="Search" aria-label="Search" fdprocessedid="x0f6n">
                </div>
                <div class="card-body py-4  fmxh-18rem">
                    @foreach ($this->allPermissions as $permission)
                        <div class="row align-items-center mb-4">



                            <div class="col">
                                <div class="progress-wrapper">
                                    <div class="progress-info">
                                        <div class="h6 mb-0">{{ $permission->display_name }} </div>
                                        <div class="small fw-bold"><span>
                                                <button
                                                    class="btn btn-icon-only btn-success d-inline-flex align-items-center"
                                                    type="button"
                                                    wire:click="addPermission('{{ $permission->name }}')">
                                                    <i class="fas fa-chevron-right"></i>
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            </span></div>
                                    </div>
                                    <div class="mb-0">
                                        <span class="text-gray-500 font-small">({{ $permission->name }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
        <div class="col-1 mid-arrows">
            {!!$this->arrows!!}
        </div>
        <div class="col-5 px-0">
            <div class="card border-0 shadow ">
                <div class="card-header pb-5">
                    <h2 class="fs-5 fw-bold mb-1">{{ Str::upper($this->name) . '`s Permissions' }}</h2>

                </div>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="text" class="form-control" id="userPermissionSearch"
                        wire:model="userPermissionSearch" placeholder="Search" aria-label="Search"
                        fdprocessedid="x0f6n">
                </div>
                <div class="card-body py-4  fmxh-18rem">


                    @foreach ($this->userAllPermissions as $permission)
                        <div class="row align-items-center mb-4">

                            <div class="col">
                                <div class="progress-wrapper">
                                    <div class="progress-info">
                                        <div class="h6 mb-0">{{ $permission->display_name }} <span
                                                class="text-gray-500 font-small">({{ $permission->name }})</span></div>
                                        <div class="small fw-bold"><span>
                                                <button
                                                    class="btn btn-icon-only btn-danger d-inline-flex align-items-center"
                                                    type="button"
                                                    wire:click="removePermission('{{ $permission->name }}')">
                                                    <i class="fas fa-user-slash"></i>

                                                </button>
                                            </span></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </div>
    </div>
</div>



