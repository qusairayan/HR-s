<div>
    <title>Social Security </title>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-around mt-4">
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
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <div class="input-group me-2 me-lg-3 fmxw-400">
                    <button class="btn btn-primary" wire:click="addSocialSecurity">Add New Social Securety</button>
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
                                    {{$soc->onEmployee}}
                                    {{-- {{  ($soc->onEmployee /100)*$soc->salary  }} JD --}}
                                </span>
                            </td>

                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{$soc->onCompany}}
                                    {{-- {{ ($soc->onCompany /100)*$soc->salary }} JD --}}
                                </span>
                            </td>

                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    {{ $soc->onEmployee + $soc->onCompany }}
                                    {{-- {{(($soc->onEmployee /100)*$soc->salary)+ ($soc->onCompany /100)*$soc->salary}} JD --}}
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


        {{-- <div class="col col-md-112 col-lg-12 col-xl-12" style="display: flex; margin-top: 33px; justify-content:center">

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
        </div> --}}
        <div>
            {{-- {{ $users->links('vendor.pagination.custom') }} --}}
        </div>
    </div>
</div>
