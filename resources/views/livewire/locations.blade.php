<div>
    <title>Locations</title>
    <a target="_blank" href="https://www.google.com/maps/d/u/0/">
        <h2>Locations</h2>
    </a>
    <div class="row">
        <div class="col-md-4 col-12">
            <label for="longitude">longitude</label>
            <input id="lan" name="lan" type="text" wire:model="lan" class="form-control">
        </div>
        <div class="col-md-4 col-12">
            <label for="latitude">latitude</label>
            <input wire:model="lat" id="lat" name="lat" type="text" class="form-control">
        </div>
        <div class="col-md-4 col-12">
            <label for="distance">distance</label>
            <input id="dis" name="dis" type="text" wire:model="dis" class="form-control">
        </div>
        <div class="col-md-6 col-12">
            <label for="location">Location Name</label>
            <input id="location" name="location" type="text" wire:model="location" class="form-control">
        </div>
        <div class="col-md-6 col-12">
            <button wire:click="create" type="submit" class="btn btn-primary w-100 mt-4">Create</button>
        </div>
    </div>

    <div class="mapouter my-4">
        <div class="gmap_canvas">
            <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?width=100%&amp;height=400&amp;hl=en&amp;q={{ $lat }},{{ $lan }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
            </iframe><a href="https://embed-googlemap.com">google maps embed</a>
        </div>
        <style>
            .mapouter {
                position: relative;
                text-align: right;
                width: 100%;
                height: 440px;
            }

            .gmap_canvas {
                overflow: hidden;
                background: none !important;
                width: 100%;
                height: 440px;
            }

            .gmap_iframe {
                width: 100% !important;
                height: 440px !important;
            }
        </style>

    </div>
    <div class="card card-body border-0 shadow table-wrapper table-responsive mt-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="border-gray-200">NO</th>
                    <th class="border-gray-200">Location</th>
                    <th class="border-gray-200">location</th>
                    <th class="border-gray-200">longitude</th>
                    <th class="border-gray-200">distance</th>
                    <th class="border-gray-200">action</th>
                    <th class="border-gray-200">action</th>
                </tr>
            <tbody>
                @php($i = count($locations) + 1)
                @foreach ($locations as $item)
                    @php($i--)
                    <tr>
                        <td style="width: 15%" class="border-0 fw-bold"><span
                                class="fw-normal">{{ $i }}</span></td>
                        <td style="width: 30%" class="border-0 fw-bold"><span
                                class="fw-normal">{{ $item->location }}</span></td>
                        <td style="width: 15%" class="border-0 fw-bold"><span
                                class="fw-normal">{{ $item->longitude }}</span></td>
                        <td style="width: 15%" class="border-0 fw-bold"><span
                                class="fw-normal">{{ $item->latitude }}</span></td>
                        <td style="width: 15%" class="border-0 fw-bold"><span
                                class="fw-normal">{{ $item->distance }}</span></td>
                        <td style="width: 8%" class="border-0 fw-bold">
                            <span class="fw-normal">
                                <button class="btn btn-success" class="col-1" type="button"
                                    wire:click="setDots('{{ $item->longitude }}', '{{ $item->latitude }}')">View
                                    Map</button>
                            </span>
                        </td>
                        <td style="width: 8%" class="border-0 fw-bold">
                            <span class="fw-normal">
                                <button class="btn btn-danger" type="button"
                                    wire:click="delete({{ $item->id }})">DELETE</button>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
