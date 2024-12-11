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
                <div class="row form">
                    <div class="table-responsive">
                        <div class="row search">
                            <div class="col-lg-6">
                                <input wire:model.live.debounce.250ms='search' type="text" name="search" id="search"
                                    class="mb-3 form-control w-25" placeholder="Search...">
                            </div>
                            <div class="col-lg-6">
                            </div>
                        </div>
                        <div class="row export">
                            <div class="col">
                                <button wire:click="deleteSelected" class="btn btn-danger {{ count($selectedItems) ? '' : 'd-none' }}">{{
                                    __('Delete Selected Data (' . count($selectedItems) . ')') }}</button>
                            </div>
                        </div>
                        <table class="table text-center text-black striped-table">
                            <thead>
                                <tr>
                                    <th class="px-4">
                                        <input type="checkbox" name="selectAll" id="selectAll"
                                            wire:model.live='selectAll'>
                                    </th>
                                    <th style="width: 2em;">No</th>
                                    <th class="px-3">{{ __('First Name') }}</th>
                                    <th class="px-3">{{ __('Last Name') }}</th>
                                    <th class="px-3">{{ __('Email') }}</th>
                                    <th class="px-3">{{ __('Phone Number') }}</th>
                                    <th class="px-3">{{ __('Division/Dept') }}</th>
                                    <th class="px-3">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($contacts->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            {{ __('Data not found') }}
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($contacts as $contact)
                                    <tr>
                                        <td class="px-4"><input type="checkbox" name="selectedItems" id="selectedItems" wire:model.live="selectedItems"
                                                value="{{ $contact->id }}"></td>
                                        <td>{{ $contacts->firstItem() + $loop->index }}</td>
                                        <td>{{ $contact->first_name }}</td>
                                        <td>{{ $contact->last_name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone_number }}</td>
                                        <td>{{ $contact->dept }}</td>
                                        <td>
                                            <a href="{{ route('contacts.detail', $contact->contactId) }}" class="btn btn-info">
                                                <i class="fas fa-eye"></i>

                                            </a>
                                            <a href="{{ route('contacts.edit', $contact->contactId) }}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>

                                            </a>
                                            <button class="btn btn-danger" wire:click.prevent="deleteConfirm('{{ $contact->contactId }}')"><i
                                                    class="fas fa-trash"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-4 row">
                            <div class="col-lg-6 d-flex align-items-center">
                                <label class="mb-0 font-bold text-black form-label me-3">Record Per
                                    Page</label>
                                <select wire:model.live='perPage' class="text-black form-control per-page"
                                    style="width: 7%">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center justify-content-end">
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        window.addEventListener('delete-confirmation', event => {
            Swal.fire({
                title: "Are you sure?",
                text: "Contact will be deleted permanently!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('deleteConfirmed');
                }
            });
        })
    </script>
@endscript
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
