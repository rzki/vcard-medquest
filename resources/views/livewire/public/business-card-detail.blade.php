<div>
    <div class="container">
        <div class="row min-vh-100">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 d-flex justify-content-center align-items-center">
                <div class="py-5 card">
                    <div class="mb-4 text-center barcode-img">
                        <img src="{{ asset('images/logo/LOGO-MEDQUEST-HD-2020-11-27-14_56_44.png') }}" width="40%" alt="">
                    </div>
                    <div class="mb-3 text-center barcode-card">
                        <h4 class="mb-4 text-center fw-bold">{{ __('Card Detail') }}</h4>
                        <img src="{{ asset('storage/'. $contact->barcode) }}" width="20%" alt="" srcset="">
                    </div>
                    <div class="mb-0 card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="participant-table d-flex justify-content-center">
                                <div class="row">
                                    <div class="text-end col-lg-5">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('First Name') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-7">
                                        <p>{{ $contact->first_name }}</p>
                                    </div>
                                    <div class="text-end col-lg-5">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Last Name') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-7">
                                        <p>{{ $contact->last_name }}</p>
                                    </div>
                                    <div class="text-end col-lg-5">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Email') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-7">
                                        <p>{{ $contact->email }}</p>
                                    </div>
                                    <div class="text-end col-lg-5">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Phone 1') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-7">
                                        <p>{{ $contact->phone_number }}</p>
                                    </div>
                                    @if ($contact->phone_number2 !=)

                                    @endif
                                    <div class="text-end col-lg-5">
                                        <p class="pb-0 mb-0 fw-bolder">
                                            {{ __('Division/Dept') }}
                                        </p>
                                    </div>
                                    <div class="col-lg-7">
                                        <p>{{ $contact->dept }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 download-button d-grid">
                        <button class="btn btn-primary-color" wire:click.prevent="downloadVCard('{{ $contact->contactId }}')">
                            <i class="fas fa-download"></i> {{ __('Download') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
