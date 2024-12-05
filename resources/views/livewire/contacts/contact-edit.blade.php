<div>
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Edit Contact') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">
                <div class="mb-4 row button">
                    <div class="col">
                        <a href="{{ route('contacts.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left pe-1"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="mb-4 row contact-form">
                    <form wire:submit="update">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="first_name" class="text-black form-label fw-bold">{{ __('First Name')
                                        }}</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        wire:model='first_name'>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="last_name" class="text-black form-label fw-bold">{{ __('Last Name')
                                        }}</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        wire:model='last_name'>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="phone_number" class="text-black form-label fw-bold">{{ __('Phone
                                        Number') }}</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                                        wire:model='phone_number'>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="email" class="text-black form-label fw-bold">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control" wire:model='email'>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3 form-group">
                                    <label for="dept" class="text-black form-label fw-bold">{{ __('Division/Department')
                                        }}</label>
                                    <input type="text" name="dept" id="dept" class="form-control" wire:model='dept'>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="text-white btn btn-success">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
