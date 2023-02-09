@if ($departments->count() > 0)
    @foreach ($departments as $department)
        <tr>
            <td>
                <span class="text-secondary text-xs font-weight-bold px-3 py-1">{{ $department->code }}</span>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0">{{ $department->name }}</p>
            </td>
            <td class="align-middle text-center text-sm">
                <span class="text-secondary text-xs font-weight-bold">{{ $department->created_at }}</span>
            </td>
            <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">{{ $department->updated_at }}</span>
            </td>
            <td class="align-middle text-center">
                <span
                    class="badge bg-gradient-success">{{ $department->status ? 'Hoạt Động' : 'Không Hoạt Động' }}</span>
            </td>
            <td class="align-middle text-center">
                <div class="mt-2">
                    <button class="btn btn-warning btn-sm me-2 edit" data-id="{{ $department->id }}">Sửa</button>
                    <button class="btn btn-danger btn-sm delete" data-id="{{ $department->id }}">Xóa</button>
                </div>
            </td>
        </tr>
    @endforeach
    <tr>
        <td class="pt-4 border-0">
            {{ $departments->links('pagination::bootstrap-4') }}
        </td>
    </tr>
@else
    <tr>
        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center" colspan="7">
            Không có dữ liệu
        </td>
    </tr>
@endif

<script>
    $('.page-link').on('click', function(e) {
        e.preventDefault();
        if ($(this).attr('href')) {
            $.get($(this).attr('href'), function(data) {
                $('#departments').empty().html(data);
            })
        }
    })
</script>
