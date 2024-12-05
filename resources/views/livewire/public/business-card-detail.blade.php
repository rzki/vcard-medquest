<div>
    <div class="container">
        <div class="row min-vh-100">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="p-5 card">
                    <h2 class="text-center fw-bold">{{ __('Detail Peserta Pameran') }}</h2>
                    <!-- /.fw-bold -->
                    <div class="mb-0 card-body">
                        <div class="mb-5 text-center barcode-img">
                            
                        </div>
                        <!-- /.text-center -->
                        <div class="row d-flex justify-content-center">
                            <div class="participant-table w-50 d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Nama Lengkap') }}
                                        </p>
                                        <!-- /.mb-0 -->
                                    </div>
                                    <div class="col-lg-6">
                                        {{-- <p>{{ $participant->full_name }}</p> --}}
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Email') }}
                                        </p>
                                        <!-- /.mb-0 -->
                                    </div>
                                    <div class="col-lg-6">
                                        {{-- <p>{{ $participant->email }}</p> --}}
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Nomor Telepon') }}
                                        </p>
                                        <!-- /.mb-0 -->
                                    </div>
                                    <div class="col-lg-6">
                                        {{-- <p>{{ $participant->phone }}</p> --}}
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Asal Institusi/Perusahaan/Klinik') }}
                                        </p>
                                        <!-- /.mb-0 -->
                                    </div>
                                    <div class="col-lg-6">
                                        {{-- <p>{{ $participant->origin }}</p> --}}
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>
                                <!-- /.row -->
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->
            <!-- /.card -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
