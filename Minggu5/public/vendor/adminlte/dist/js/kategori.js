$('#kategoriTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('kategori.index') }}",
    columns: [
        { data: 'id', name: 'id' },
        { data: 'kode', name: 'kode' },
        { data: 'nama', name: 'nama' },
        { data: 'created_at', name: 'created_at' },
        { data: 'updated_at', name: 'updated_at' },
        {
            data: 'id',
            name: 'action',
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
                return `
                    <a href="/kategori/${data}/edit" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                `;
            }
        }
    ]
});
