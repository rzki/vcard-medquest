<div>
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Contacts') }}</h2>
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
                <div class="mb-4 row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6 text-end">
                        <a href="{{ route('contacts.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> {{ __('Create New Contact') }}
                        </a>
                    </div>
                </div>
                @livewire('contacts.table.contacts-table')
            </div>
        </div>
    </div>
</div>
@if (session()->has('alert'))
@script
<script>
    const alerts = @json(session()->get('alert'));
            const title = alerts.title;
            const icon = alerts.type;
            const toast = alerts.toast;
            const position = alerts.position;
            const timer = alerts.timer;
            const progbar = alerts.progbar;
            const confirm = alerts.showConfirmButton;

            Swal.fire({
                title: title,
                icon: icon,
                toast: toast,
                position: position,
                timer: timer,
                timerProgressBar: progbar,
                showConfirmButton: confirm
            });
</script>
@endscript
@endif
