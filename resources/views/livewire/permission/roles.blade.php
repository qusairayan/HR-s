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
            <h2 class="h4">Roles</h2>
        </div>

    </div>


    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <div class="row">



            <!-- End of Form -->
        </div>
        <div class="row">

            <!-- Form -->

                

            <div class="row">

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0" style="width: 40%">Name</th>
                                <th class="border-0">Permissions </th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody class="permissionTbody">


                            <!-- Item -->.
                            @foreach ($roles as $role)

                                <tr>
                                    <td class="fw-bold align-items-center">
                                        {{ $role->name }}
                                    </td>
                                    
                                    <td>
                                        <span class="permissions-col">
                                            @foreach ($role->permissions as $permission)
                                            <span class="badge text-white" style="background-color:{{ $this->getRandomColor()}}">{{ $permission->display_name }}</span>
                                            @endforeach
                                            
                                    <td>
                                <a class="dropdown-item" href="{{ route('permissions.role.edit', ['role' => $role->id]) }}"><span class="fas fa-edit me-2"></span>Edit</a>

                                    </td>
                                    {{-- <td class="fw-bold align-items-center">
                                        <ul>
                                            @foreach ($user->getPermissionsViaRoles() as $permission)
                                                <li>{{ $permission->display_name }}</li>
                                            @endforeach
                                            @foreach ($user->getDirectPermissions() as $permission)
                                                <li>{{ $permission->display_name }}</li>
                                            @endforeach
                                        </ul>
                                    </td> --}}

                                </tr>
                                <!-- End of Item -->
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- End of Form -->


        </div>








    </div>
</div>



</div>
