<div>
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Create New User') }}</h2>
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
                        <a href="{{ route('users.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left pe-1"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="mb-4 row contact-form">
                    <form wire:submit="create">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3 form-group">
                                    <label for="name" class="text-black form-label fw-bold">{{ __('Name')
                                        }}</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        wire:model='name'>
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
                                    <label for="role" class="text-black form-label fw-bold">{{ __('Role')
                                        }}</label>
                                    <select name="role" id="role" class="form-control" wire:model='role'>
                                        <option value="">{{ __('Choose option...') }}</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
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
