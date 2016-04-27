<script>
$(function() {
  $('#events-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('datatables.data2') !!}',
      columns: [
       		{ data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'description', name: 'description' },
          { data: 'location', name: 'location' },
          { data: 'schedule', name: 'schedule' }

          //{ data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });
});
</script>

