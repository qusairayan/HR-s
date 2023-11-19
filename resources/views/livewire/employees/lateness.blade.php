<div>
    <title>Employees - Lateness </title>

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
                    <li class="breadcrumb-item active" aria-current="page">Lateness</li>
                </ol>
            </nav>
            <h2 class="h4">All Lateness</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
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
                        Add Dedduction
                    </p>
                </div>




                <form wire:submit.prevent="addDeduction">
                    <div class="row p-md text-white">
                        <div class="row align-items-center ">

                            <h2 class="col-8 p-sm d-flex align-items-center  h2 px-md-1">
                                {{ $this->username }}
                            </h2>


                            <small class="col-4 d-flex align-items-center ">
                                <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $this->date }}
                            </small>
                        </div>
                        <div class=" col-6 p-sm d-flex align-items-center">
                            <div class="row">
                                <span class="col-4 p-sm d-flex align-items-center ">In:</span>
                                <div class="col-6 p-sm d-flex align-items-center">
                                    <i class="fas fa-door-closed"></i>
                                    <span class="text-white p-md-2">{{ $this->lateCheckIn }}</span>
                                </div>
                            </div>
                        </div>
                        <div class=" col-6 p-sm d-flex align-items-center">
                            <div class="row">
                                <span class="col-4 p-sm d-flex align-items-center ">Out:</span>
                                <div class="col-6 p-sm d-flex align-items-center">
                                    <i class="fas fa-door-open"></i>
                                    <span class="text-white p-md-2 ">{{ $this->lateCheckOut }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="row  align-items-center ">
                            <div class="col-6 p-sm">
                                <span class="px-md-1">Late on:</span>
                                <span class="px-md-1">{{ $this->on }}</span>
                            </div>
                            <div class="col-6 p-sm">

                                <span class="px-md-1">Late:</span>
                                <span class="badge text-white bg-danger">{{ $this->amount }} Minutes</span>
                            </div>

                        </div>




                    </div>






                    <div class="modal-body text-white">
                        <div class="py-3 text-center">

                            <h4 class="h5 py-2">Deduction Amount:</h4>

                            <div class="input-group mt-1">
                                <input type="text" class="form-control" wire:model="deduction">


                                @error('deduction')
                                    <div class="invalid-feedback"> {{ $message }} </div>
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


    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>

                    <th class="border-gray-200">Name</th>
                    <th class="border-gray-200">Department</th>
                    <th class="border-gray-200">date</th>
                    <th class="border-gray-200">On</th>
                    <th class="border-gray-200">Late</th>
                    <th class="border-gray-200">Action</th>
                </tr>
            </thead>
            <tbody>



                @foreach ($lateness as $late)
                    <tr>




                        <td>
                            <a href="#" class="d-flex align-items-center">
                                <img src="/storage/profile/{{ $late->user_image }}" class="avatar rounded-circle me-3"
                                    alt="Avatar">
                                <div class="d-block">
                                    <span class="fw-bold">{{ $late->user_name }}</span>
                                </div>
                            </a>
                        </td>






                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $late->department_name }}
                            </span>
                        </td>

                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $late->date }}
                            </span>
                        </td>

                        <td class="border-0 fw-bold">
                            <span class="fw-normal">

                                {{ $late->on == 'checkIn'
                                    ? '<span class="fw-bold text-success">Check In</span>'
                                    : '<span class="fw-bold text-danger">Check Out</span>' }}
                            </span>
                        </td>

                        <td class="border-0 fw-bold">
                            <span class="fw-normal">
                                {{ $late->amount }}
                            </span>
                        </td>

                        <td class="border-0 fw-bold">

                            @if ($late->deduction == 0)
                                <div class="btn-group">
                                    <button class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modal-notification"
                                        wire:click="viewDeduction({{ $late->id }})" type="button">Add
                                        Deduction</button>
                                </div>
                            @else
                                <span class="badge text-white bg-danger">Deduction Added</span>
                            @endif

                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>
            {{ $lateness->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
