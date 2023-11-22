<div>
    <title>vacation Balance</title>
    <div>


        <title>Promotions </title>
    
    
        <div class="table-settings mb-4">
            <div class="row align-items-center justify-content-between">
    
    
    
                <div class="col col-md-6 col-lg-3 col-xl-4">
                    <div class="input-group me-2 me-lg-3 fmxw-400">
                        <span class="input-group-text">
                            <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
    
    
            <div class="row align-items-center justify-content-between mt-4">
    
                <div class="col col-md-6 col-lg-3 col-xl-4">
                    <div class="input-group me-2 me-lg-3 fmxw-400">
    
                        <select class="form-select mb-0" id="company" aria-label="company select example"
                            wire:model="company" autofocus required>
                            @foreach ($companies as $comp)
                                <option value="{{ $comp->id }}">
                                    {{ $comp->name }} </option>
                            @endforeach
                            <option value="" disabled selected hidden>Select Employee's Company
                            </option>
    
                        </select>
    
    
                    </div>
                </div>
    
    
                <div class="col col-md-6 col-lg-3 col-xl-4">
                    <div class="input-group me-2 me-lg-3 fmxw-400">
    
                        <select class="form-select mb-0" id="department" aria-label="department select example"
                            wire:model="department" autofocus required>
                            @foreach ($departments as $dep)
                                <option value="{{ $dep->id }}">
                                    {{ $dep->name }} </option>
                            @endforeach
                            <option value="" disabled selected hidden>Select Employee's Department
                            </option>
    
                        </select>
    
    
                    </div>
                </div>
    
    
    
                    <div class="col col-md-6 col-lg-3 col-xl-4">
                        <div class="input-group me-2 me-lg-3 fmxw-400">
                            <select class="form-select mb-0" id="user" aria-label="user select example"
                                wire:model="user" autofocus required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} </option>
                                @endforeach
                                <option value="" disabled selected hidden>Select Employee
                                </option>
    
                            </select>
    
                        </div>
                    </div>
            </div>
        </div>
        <div class="card card-body border-0 shadow table-wrapper table-responsive" >
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="border-gray-200">ID</th>
                        <th class="border-gray-200">Name</th>>
                        <th class="border-gray-200">annual vacation</th>
                        <th class="border-gray-200">sick vacation</th>
                        <th class="border-gray-200">Action</th>
                        <th class="border-gray-200">Action</th>
                        <th class="border-gray-200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->annual_vacation}}</td>
                        <td>{{$user->sick_vacation}}</td>
                        <td><button class="btn btn-info" wire:click="addVacation({{$user->id}})">Add Vacation</button></td>
                        <td><button class="btn btn-success" wire:click="resetVacation({{$user->id}})">reset Vacation</button></td>
                        <td><button class="btn btn-primary" wire:click="viewPdf({{$user->id}})">view report</button></td>
                    </tr>
                    @endforeach
                   
         </table>
            <div>
                {{-- {{ $users->links('vendor.pagination.custom') }} --}}
            </div>
        </div>
    </div>
    @if($message)
    @if($message["type"] == 1)
        <script>
            Swal.fire({
            title: "success",
            text: "{{ "$message[msg]" }}",
            icon: "success"
        });
        </script>
    @else
        <script>
            Swal.fire({
                title: "error",
                text: "{{ "$message[msg]" }}",
                icon: "error"
            });
        </script>    
    @endif
@endif
</div>
