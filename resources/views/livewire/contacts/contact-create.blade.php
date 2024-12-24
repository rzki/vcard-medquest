<div>
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Create New Contact') }}</h2>
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
                    <form wire:submit="create">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="first_name" class="text-black form-label fw-bold">{{ __('First Name') }}</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" wire:model='first_name'>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="last_name" class="text-black form-label fw-bold">{{ __('Last Name') }}</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" wire:model='last_name'>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="phone_number" class="text-black form-label fw-bold">{{ __('Phone 1') }}</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" wire:model='phone_number'>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="phone_number2" class="text-black form-label fw-bold">{{ __('Phone 2 (Optional)') }}</label>
                                    <input type="text" name="phone_number2" id="phone_number2" class="form-control" wire:model='phone_number2'>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 form-group">
                                    <label for="email" class="text-black form-label fw-bold">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control" wire:model='email'>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 form-group">
                                    <label for="dept" class="text-black form-label fw-bold">{{ __('Division/Department') }}</label>
                                    <select name="dept" id="dept" wire:model='dept' class="form-control">
                                        <option value=""></option>
                                        @foreach ($divisions as $div)
                                            <option value="{{ $div->name }}">{{ $div->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 form-group">
                                    <label for="dept" class="text-black form-label fw-bold">{{ __('Position') }}</label>
                                    <input type="text" name="dept" id="dept" class="form-control" wire:model='position'>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h6 class="py-5 text-center fw-bold text-uppercase">{{ __('Company') }}</h6>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 form-group">
                                    <label for="street" class="text-black form-label fw-bold">{{ __('Street') }}</label>
                                    <textarea type="street" name="street" id="street" class="form-control" wire:model='street'></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 form-group">
                                    <label for="city" class="text-black form-label fw-bold">{{ __('City') }}</label>
                                    <input type="city" name="city" id="city" class="form-control" wire:model='city'>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-3 form-group">
                                    <label for="province" class="text-black form-label fw-bold">{{ __('Province') }}</label>
                                    <input type="province" name="province" id="province" class="form-control" wire:model='province'>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-3 form-group">
                                    <label for="postcode" class="text-black form-label fw-bold">{{ __('Postal Code') }}</label>
                                    <input type="postcode" name="postcode" id="postcode" class="form-control" wire:model='postcode'>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-3 form-group">
                                    <label for="country" class="text-black form-label fw-bold">{{ __('Country') }}</label>
                                    <input type="country" name="country" id="country" class="form-control" wire:model='country'>
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
