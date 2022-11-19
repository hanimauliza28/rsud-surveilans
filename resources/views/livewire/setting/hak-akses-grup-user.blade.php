<div>
    <form class="row row-cols-1 row-cols-md-2 row-cols-xl-3" id="hak-akses-form">
        {{ csrf_field() }}
        <input type="hidden" name="grupUserId" value="{{ $grupUserId }}" id="grupUserId">
        @foreach ($menu as $menu)
            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Card-->
                <div class="card card-flush h-md-100 m-0 p-0 mb-10">
                    <!--begin::Card header-->
                    <div class="card-header m-0 p-0">
                        <!--begin::Card title-->
                        <div class="card-title m-0 p-0">
                            <h4>
                                {{ $menu->nama_menu }}
                            </h4>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body m-0 p-0">
                        <!--begin::Permissions-->
                        <div class="d-flex flex-column text-gray-600">
                            @foreach ($menu->children as $child)
                                <div class="form-check form-check-custom form-check-solid mb-3">
                                    <input class="form-check-input form-sm me-1" name="menuId[]" type="checkbox"
                                        value="{{ $child->id }}" id="menuId{{ $child->id }}"
                                        {{ $child->grupUser->count() > 0 ? 'checked="checked"' : '' }}>
                                    <label class="form-check-label" for="menuId{{ $child->id }}">
                                        {{ $child->nama_menu }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endforeach
    </form>
</div>
