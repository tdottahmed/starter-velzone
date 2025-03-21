<table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
    <thead>
        <tr>
            <th scope="col" style="width: 10px;">
                <div class="form-check">
                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                </div>
            </th>
            <th>{{ __('SL No') }}</th>
            @foreach ($columns as $column)
                <th>{{ ucwords(str_replace('_', ' ', $column)) }}</th>
            @endforeach
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
            <tr>
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                    </div>
                </th>
                <td>{{ $loop->iteration }}</td>
                @foreach ($columns as $column)
                    <td>
                        @if ($column === 'created_at' || $column === 'updated_at')
                            {{ \Carbon\Carbon::parse($row->$column)->diffForHumans() }}
                        @else
                            {{ $row->$column }}
                        @endif
                    </td>
                @endforeach
                <td class="text-center">
                    <x-data-display.data-table-action :actions="$getActions($row)" />
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($columns) + 2 }}" class="text-center">
                    No data found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
    {{-- <script src="/assets/admin/js/pages/datatables.init.js"></script> --}}
    <script>
        function initializeTables() {
            new DataTable("#example"),
                new DataTable("#scroll-horizontal")
        }
        document.addEventListener("DOMContentLoaded", function() {
            initializeTables();
        });
    </script>
@endpush
