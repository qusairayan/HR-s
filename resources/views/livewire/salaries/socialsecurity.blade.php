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
                    <a data-bs-toggle="modal" data-bs-target="#modal-notification"
                    class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Add New Social Securety

                </a>
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
                    <th class="border-gray-200">Action</th>
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
                            <td class="border-0 fw-bold">
                                <span class="fw-normal">
                                    <button class="btn btn-danger" style="width: 100%; margin:0 5px;" type="button"
                                        wire:click="delete({{ $soc->id }})">DELETE</button>
                                </span>
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
        <div>

            <div wire:ignore.self class="modal fade" id="modal-notification" tabindex="-1" role="dialog"
            aria-labelledby="modal-notification" aria-hidden="true" wire:ignore>
            <div class="modal-dialog modal-info modal-dialog-centered" role="document">
                <div class="modal-content bg-gradient-secondary" style="background: #13223d">
                    <button type="button" class="btn-close theme-settings-close fs-6 ms-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-header">
                        <p class="modal-title text-gray-200" id="modal-title-notification">
                            Add New Social Securety
                        </p>
                    </div>
                    {{-- wire:click="addSocialSecurity" --}}
                    <div class="modal-body">
                        <form wire:submit.prevent="addSocialSecurity">
                            <label style="color: white" for="employee">Select Employee</label>
                            <div class="" style="display: flex;align-items: center;">
                                <select wire:model="user" id="employee" type="text" class="form-control mt-3 mb-3">
                                    <option value="" disabled selected hidden>Select Employee </option>
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <svg style="position: absolute;right: 1.5rem;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m18.707 12.707-1.414-1.414L13 15.586V6h-2v9.586l-4.293-4.293-1.414 1.414L12 19.414z"></path></svg>
                            </div>
                            @error('user') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="date"><label style="color: white" for="date">Select Date</label> <input wire:model="date" type="date" id="date" class="form-control mt-3 mb-3">@error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror </div>
                            <div class="salary"> <label style="color: white" for="salary">Select salary</label> <input wire:model="salary" type="text" class="form-control mt-3 mb-3">@error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror </div>
                            <div class="row">
                                <div class="sspfte col-4">   <label style="color: white" for="sspfte">on Employee</label>   <input type="text" disabled value="7.5"  class="form-control mt-3 mb-3"></div>
                                <div class="sspfte col-4">   <label style="color: white" for="sspfte">on Company</label>    <input type="text" disabled value="14.25"  class="form-control mt-3 mb-3"> </div>
                                <div class="Netsalary col-4"><label style="color: white" for="Netsalary">Net salary</label> <input wire:model="Netsalary" type="text" disabled  class="form-control mt-3 mb-3">@error('Netsalary') <div class="invalid-feedback">{{ $message }}</div> @enderror  </div>
                            </div>
                                
                                    <div class="save"> <button type="submit" class="w-100 btn btn-success mt-2 mt-2"> save </div>

                        </form>
                        <div class="check"> <button wire:click="add" class="btn btn-primary w-100 mt-2 mt-2"> check </div>
                    </div>
                </div>
            </div>
        </div>

            {{-- {{ $users->links('vendor.pagination.custom') }} --}}
        </div>
    </div>
</div>
