<script>
$(function() {
  $('#buildings-table').DataTable({
  	responsive: true,
    processing: true,
    serverSide: true,
    ajax: '{!! route('datatables.data') !!}',
    columns: [
     		{ data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'description', name: 'description' },
        { data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });
});
</script>