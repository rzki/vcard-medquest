<div>
    <div class="container">
        <div class="row min-vh-100">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 d-flex justify-content-center align-items-center">
                <div class="py-5 card">
                    <div class="mb-4 text-center barcode-img">
                        <img src="{{ asset('images/logo/LOGO-MEDQUEST-HD-2020-11-27-14_56_44.png') }}" width="30%"
                            alt="">
                    </div>
                    <div class="mb-2 text-center barcode-card">
                        <div class="mb-4">
                            <img src="{{ asset('storage/'. $contact->barcode) }}" width="17%" alt="" srcset="">
                        </div>
                        <h4 class="mb-2 text-center fw-medium">{{ $contact->first_name.' '.$contact->last_name }}</h4>
                        <h6 class="mb-2 text-center fw-normal">{{ $contact->dept }}</h6>
                        <div class="mt-2 opacity-50 divider">
                            <hr width="40%" class="mx-auto mt-3">
                        </div>
                    </div>
                    <div class="mb-0 card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="participant-table d-flex justify-content-center">
                                <div class="row">
                                    <div class="text-center text-lg-end col-lg-5">
                                        <p class="pb-0 mb-0 fw-bolder h5">
                                            {{ __('Phone') }}
                                        </p>
                                    </div>
                                    <div class="mb-3 text-center text-lg-start col-lg-7">
                                        <a href="tel:{{ $contact->phone_number }}" class="text-black text-decoration-none">
                                            <p class="h5 fw-normal">{{ $contact->phone_number }}</p>
                                        </a>
                                    </div>
                                    @if ($contact->phone_number2 != null)
                                        <div class="text-center text-lg-end col-lg-5">
                                            <p class="pb-0 mb-0 fw-bolder h5">
                                                {{ __('Phone 2') }}
                                            </p>
                                        </div>
                                        <div class="mb-3 text-center text-lg-start col-lg-7">
                                        <a href="tel:{{ $contact->phone_number2 }}" class="text-black text-decoration-none">
                                            <p class="h5 fw-normal">{{ $contact->phone_number2 }}</p>
                                        </a>
                                        </div>
                                    @endif
                                    <div class="text-center text-lg-end col-lg-5">
                                        <p class="pb-0 mb-0 fw-bolder h5">
                                            {{ __('Email') }}
                                        </p>
                                    </div>
                                    <div class="mb-3 text-center text-lg-start col-lg-7">
                                        <a href="mailto:{{ $contact->email }}" class="text-black text-decoration-none">
                                        <p class="h5 fw-normal">{{ $contact->email }}</p>
                                        </a>
                                    </div>
                                    <div class="text-center text-lg-end col-lg-5">
                                        <p class="pb-0 mb-0 fw-bolder h5">
                                            {{ __('Company') }}
                                        </p>
                                    </div>
                                    <div class="mb-3 text-center text-lg-start col-lg-7">
                                        <p class="h5 fw-normal">{{ __('PT. Medquest Jaya Global') }}</p>
                                        <p class="h5 fw-normal">{{ $contact->dept }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 download-button d-grid">
                        <button class="btn btn-primary-color text-uppercase"
                            wire:click.prevent="downloadVCard('{{ $contact->contactId }}')">
                            <i class="fas fa-download me-1"></i> {{ __('save contact') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</div>
