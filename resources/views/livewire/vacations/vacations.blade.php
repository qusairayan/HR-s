<div>
    <title>Vacations</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Vacations</li>
                </ol>
            </nav>
            <h2 class="h4">All Vacations</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
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
                        <a class="dropdown-item d-flex align-items-center fw-bold" wire:click="$set('perPage', 10)"
                            href="#">10 <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg></a>
                        <a class="dropdown-item fw-bold rounded-bottom" wire:click="$set('perPage', 30)"
                            href="#">30</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="border-gray-200"></th>
                    <th class="border-gray-200">Name</th>
                    <th class="border-gray-200">Department</th>
                    <th class="border-gray-200">Period</th>
                    <th class="border-gray-200">Date</th>
                    <th class="border-gray-200">File</th>
                    <th class="border-gray-200">Reason</th>
                    <th class="border-gray-200">Status</th>
                    <th class="border-gray-200">Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($vacations as $vacation)
                    <tr>
                        <td>
                            <div class="form-check dashboard-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="vacationCheck{{ $vacation->id }}">
                                <label class="form-check-label" for="vacationCheck{{ $vacation->id }}">
                                </label>
                            </div>
                        </td>
                        <td class="border-0 fw-bold"><span class="fw-normal">{{ $vacation->user_name }}</span></td>
                        <td class="border-0 fw-bold"><span class="fw-normal">{{ $vacation->department_name }}</span></td>
                        <td class="border-0 fw-bold"><span class="fw-normal">{{ $vacation->period }}</span></td>
                        <td class="border-0 fw-bold"><span class="fw-normal">{{ $vacation->date }}</span></td>
                        <td class="border-0 fw-bold"><span class="fw-normal">
                            @if($vacation->asset)
                                <img src="/storage/vacation/{{$vacation->asset}}" alt="img">
                                @endif
                            </span></td>
                        <td class="border-0 fw-bold"><span class="fw-normal">{{ $vacation->reason }}</span></td>
                        <td class="border-0 fw-bold"><span class="fw-normal">
                                {!! $vacation->status == 1
                                    ? '<span class="fw-bold text-success">Approved</span>'
                                    : ($vacation->status == 0
                                        ? '<span class="fw-bold text-warning">Pending</span>'
                                        : '<span class="fw-bold text-danger">Rejected</span>') !!}
                            </span></td>
                        <td class="border-0 fw-bold">
                            <div class="btn-group">
                                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="icon icon-sm">
                                        <span class="fas fa-ellipsis-h icon-dark"></span>
                                    </span>
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu py-0">
                                    {{-- <a class="dropdown-item text-success"
                                        href="{{ route('vacations.approve', ['vacation' => $vacation->id,"type"=>$vacation->type,"user_id"=>$vacation->user_id]) }}"><span
                                            class="fas fa-check-circle me-2"></span>Approve</a> --}}

                                    <a wire:click="approve({{$vacation->id}})" class="dropdown-item text-success"><span class="fas fa-check-circle me-2"></span>Approve</a>
                                            
                                    {{-- <a class="dropdown-item text-danger rounded-bottom"
                                        href="{{ route('vacations.reject', ['vacation' => $vacation->id]) }}"><span
                                            class="fas fa-times-circle me-2"></span>Reject</a> --}}

                                    <a wire:click="reject({{$vacation->id}})" class="dropdown-item text-danger rounded-bottom"><span class="fas fa-times-circle me-2"></span>Reject</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <button class="dedc" style="display: none" wire:click="click({{$vacation ?? "" }})">click</button>
            </tbody>
        </table>
        <div>
            {{ $vacations->links('vendor.pagination.custom')}}
        </div>
    </div>
    @if($message)
        @if($message["type"] == 1)
        <script>
            console.log("object");
            Swal.fire({
            title: "success",
            text: "{{ "$message[msg]" }}",
            icon: "success"
        });
        </script>
        @else
        <script>
            Swal.fire({
            title: "The operation failed",
            text: "{{ "$message[msg]" }}",
            icon: "error",
            showCancelButton: true,
            confirmButtonText:"dedction"
        }).then((result) => {
      if (result.isConfirmed) {
        $(".dedc").click();
      }
    });
        </script>
        @endif
        @else
    @endif
</div>