<div>
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Edit Division') }}</h2>
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
                        <a href="{{ route('divisions.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left pe-1"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="mb-4 row division-form">
                    <form wire:submit="update">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3 form-group">
                                    <label for="name" class="text-black form-label fw-bold">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control" wire:model='name'>
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
