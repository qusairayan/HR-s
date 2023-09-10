<div>


    <title>Social Security </title>


    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">








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
                        <option value="" disabled selected hidden>Select Employee's Department </option>

                    </select>


                </div>
            </div>



            <div class="col col-md-6 col-lg-3 col-xl-4">
                <div class="input-group me-2 me-lg-3 fmxw-400">

                    <select class="form-select mb-0" id="user" aria-label="user select example" wire:model="user"
                        autofocus required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} </option>
                        @endforeach
                        <option value="" disabled selected hidden>Select Employee </option>

                    </select>


                </div>

            </div>










        </div>
    </div>

    <div class="card card-body border-0 shadow table-wrapper table-responsive">

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


        <table class="table table-hover">
            <thead>
                <tr>

                    <th class="border-gray-200">ID</th>
                    <th class="border-gray-200">Name</th>
                    <th class="border-gray-200">Company</th>
                    <th class="border-gray-200">Department</th>
                    <th class="border-gray-200">Position</th>
                    <th class="border-gray-200">On Emp</th>
                    <th class="border-gray-200">On comp</th>
                    <th class="border-gray-200">Amount</th>
                    <th class="border-gray-200">Date</th>
                    {{-- <th class="border-gray-200">Action</th> --}}
                </tr>
            </thead>
            <tbody>

                @if ($socialsecurity)

                    @foreach ($socialsecurity as $soc)
                        <tr>




                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ $soc->id }}
                                </span>
                            </td>
                            <td>
                                <a href="#" class="d-flex align-items-center">
                                    <span class="fw-bold">{{ $soc->user_name }}</span>
                                </a>
                            </td>




                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ $soc->comp_name }}
                                </span>
                            </td>


                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ $soc->dep_name }}
                                </span>
                            </td>

                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ $soc->position }}
                                </span>
                            </td>

                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{  ($soc->onEmployee /100)*$soc->salary  }} JD
                                </span>
                            </td>

                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ ($soc->onCompany /100)*$soc->salary }} JD
                                </span>
                            </td>

                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{(($soc->onEmployee /100)*$soc->salary)+ ($soc->onCompany /100)*$soc->salary}} JD
                                </span>
                            </td>

                            <td class="border-0 fw-bold">
                                {{ $soc->date}}

                            </td>

                            {{-- <td class="border-0 fw-bold">

                            <div class="btn-group">
                                <a class="dropdown-item"
                                    href="{{ route('promotions.edit', ['promotion' => $promo->id]) }}"><span
                                        class="fas fa-edit me-2"></span>Edit</a>

                            </div>
                        </td> --}}


                        </tr>
                        @endforeach
                    @endif

            </tbody>

        </table>


        <div class="col col-md-112 col-lg-12 col-xl-12" style="display: flex; margin-top: 33px; justify-content:center">

            <div class="btn-toolbar mb-2 mb-md-0 float-end ">
                @if ($this->add)
                    <a wire:click="addSocialSecurity" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                            </path>
                        </svg>
                        Add Socialsecurity to selected Employee
                    </a>
                @endif
            </div>
        </div>
        <div>
            {{-- {{ $users->links('vendor.pagination.custom') }} --}}
        </div>
    </div>
</div>
