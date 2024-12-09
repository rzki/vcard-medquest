<div>
    <div class="container">
        <div class="row min-vh-100">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <div class="py-5 card">
                    <div class="mb-4 text-center barcode-img">
                        <img src="{{ asset('images/logo/LOGO-MEDQUEST-HD-2020-11-27-14_56_44.png') }}" width="50%"
                            alt="">
                    </div>
                    <div class="mb-3 text-center barcode-card">
                        <h4 class="mb-4 text-center fw-bold">{{ __('Card Detail') }}</h4>
                        <img src="{{ asset('storage/'. $contact->barcode) }}" width="25%" alt="" srcset="">
                    </div>
                    <div class="mb-0 card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="participant-table d-flex justify-content-center">
                                <div class="row">
                                    <div class="text-end col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('First Name') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{ $contact->first_name }}</p>
                                    </div>
                                    <div class="text-end col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Last Name') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{ $contact->last_name }}</p>
                                    </div>
                                    <div class="text-end col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Email') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{ $contact->email }}</p>
                                    </div>
                                    <div class="text-end col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Phone') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{ $contact->phone_number }}</p>
                                    </div>
                                    @if ($contact->phone_number2 != null)
                                        <div class="text-end col-lg-6">
                                            <p class="pb-0 mb-0 fw-bolder">
                                                {{ __('Phone 2') }}
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>{{ $contact->phone_number2 }}</p>
                                        </div>
                                    @endif
                                    <div class="text-end col-lg-6">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Division/Dept') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{ $contact->dept }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 download-button d-grid">
                        <button class="btn btn-primary-color text-uppercase"
                            wire:click.prevent="downloadVCard('{{ $contact->contactId }}')">
                            <i class="fas fa-download me-1"></i> {{ __('Download') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>
