<div>
    <!--begin::Card-->
    <div class="card pt-1">
        <form id="kepatuhan-identifikasi-form">
            <input type="hidden" name="indikatorMutuId" id="indikatorMutuId" value="{{ $indikatorMutu->id }}">
            <input type="hidden" name="hasilSurveyId" id="hasilSurveyId" value="{{ $hasilSurvey->id ?? 0 }}">
            <div class="card-body">


            </div>

        </form>
        <div class="card-footer text-end mt-1 pt-4">
            <button id="btn-simpan-kepatuhan-identifikasi" class="btn btn-primary" onclick="simpanKI()">
                <span id="btn-simpan-text" class="indicator-label">
                    <i class="fas fa-save"></i>
                    Simpan
                </span>
                <span class="indicator-progress">
                    <i class="fas fa-save"></i>
                    Mohon Menunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <button id="btn-reset" onclick="resetKI()" class="btn btn-danger"><i class="fas fa-save"></i>
                Reset
            </button>
        </div>

    </div>
    <!--end::Card-->

</div>

<!-- Your component's view here -->

@push('scripts')
    @include('contents.monitoring.monitoringPasien.js.jsEmergencyResponTime')
@endpush
