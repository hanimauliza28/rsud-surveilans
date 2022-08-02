<div class="modal fade" id="detail-modal" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header py-4">
                <h3 class="fw-bolder modal-title" id="modal-title">Modal Title</h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body-layer modal-body py-4 px-10">
                <div class="row">
                    <div class="col-12">
                        <!--begin::API Overview-->
                        <div class="card mb-3 mb-xxl-5">
                            <!--begin::Header-->
                            <div class="card-header">
                                <!--begin::Info-->
										<div class="flex-grow-1">
											<!--begin::Title-->
											<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
												<!--begin::User-->
												<div class="d-flex flex-column">
													<!--begin::Name-->
													<div class="d-flex align-items-center mb-2">
                                                        <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
                                                        <span class="svg-icon svg-icon-2x mt-0 svg-icon-primary me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M22 19V17C22 16.4 21.6 16 21 16H8V3C8 2.4 7.6 2 7 2H5C4.4 2 4 2.4 4 3V19C4 19.6 4.4 20 5 20H21C21.6 20 22 19.6 22 19Z" fill="currentColor" />
                                                                <path d="M20 5V21C20 21.6 19.6 22 19 22H17C16.4 22 16 21.6 16 21V8H8V4H19C19.6 4 20 4.4 20 5ZM3 8H4V4H3C2.4 4 2 4.4 2 5V7C2 7.6 2.4 8 3 8Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
														<a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder mt-2 me-1" id="detail-judul">Max Smith</a>
													</div>
													<!--end::Name-->
												</div>
												<!--end::User-->
												<!--begin::Actions-->
												<div class="d-flex my-4">
													<button href="#" class="btn btn-sm btn-success me-2">

														<!--begin::Indicator-->
														<span id="detail-kategori">Kategori</span>
														<!--end::Indicator-->
													</button>
												</div>
												<!--end::Actions-->
											</div>
											<!--end::Title-->

                                            <!--begin::Wrapper-->
												<div class="d-flex flex-column flex-grow-1 pe-8">
													<!--begin::Stats-->
													<div class="d-flex flex-wrap">
														<!--begin::Stat-->
														<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
															<!--begin::Number-->
															<div class="d-flex align-items-center">
																<div class="fs-2 fw-bolder" id="detail-faktor-pengali">0</div>
															</div>
															<!--end::Number-->
															<!--begin::Label-->
															<div class="fw-bold fs-6 text-gray-400">Faktor Pengali</div>
															<!--end::Label-->
														</div>
														<!--end::Stat-->
														<!--begin::Stat-->
														<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
															<!--begin::Number-->
															<div class="d-flex align-items-center">

																<div class="fs-2 fw-bolder" id="detail-satuan">0</div>
															</div>
															<!--end::Number-->
															<!--begin::Label-->
															<div class="fw-bold fs-6 text-gray-400">Satuan</div>
															<!--end::Label-->
														</div>
														<!--end::Stat-->
														<!--begin::Stat-->
														<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
															<!--begin::Number-->
															<div class="d-flex align-items-center">

																<div class="fs-2 fw-bolder" id="detail-tipe-indikator">0</div>
															</div>
															<!--end::Number-->
															<!--begin::Label-->
															<div class="fw-bold fs-6 text-gray-400">Tipe Indikator</div>
															<!--end::Label-->
														</div>
														<!--end::Stat-->

														<!--begin::Stat-->
														<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
															<!--begin::Number-->
															<div class="d-flex align-items-center">

																<div class="fs-2 fw-bolder" id="detail-frekuensi">0</div>
															</div>
															<!--end::Number-->
															<!--begin::Label-->
															<div class="fw-bold fs-6 text-gray-400">Frekuensi</div>
															<!--end::Label-->
														</div>
														<!--end::Stat-->
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Wrapper-->

										</div>
										<!--end::Info-->

                            </div>


                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h3>Definisi Operasional</h3>
                                        <div id="detail-definisi-operasional" class="py-4">Definisi Operasional</div>
                                    </div>
                                </div>
                                <!--begin::Row-->
                                <div class="row mb-10">
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <div class=" notice bg-light-primary rounded border-primary border border-dashed p-6 h-100">
                                            <h3>Sumber Data</h3>
                                            <div id="detail-sumber-data"></div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <div class="notice bg-light-primary rounded border-primary border border-dashed p-6 h-100">
                                            <h3>Area Monitoring</h3>
                                            <div id="detail-area-monitoring"></div>
                                        </div>

                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <div class="notice bg-light-primary rounded border-primary border border-dashed p-6 h-100">
                                            <h3>Standart</h3>
                                            <div id="detail-standar"></div>
                                        </div>

                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--begin::Row-->
                                <div class="row mb-10">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <div class=" notice bg-light-primary rounded border-primary border border-dashed p-6">
                                            <h3>Kriteria Inklusi</h3>
                                            <div id="detail-kriteria-inklusi"></div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <div class="notice bg-light-primary rounded border-primary border border-dashed p-6">
                                            <h3>Kriteria Eksklusi</h3>
                                            <div id="detail-kriteria-eksklusi"></div>
                                        </div>

                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::API overview-->
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
