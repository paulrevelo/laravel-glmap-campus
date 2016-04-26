<script>
$(function() {
  $('#example').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('datatables.data') !!}',
      columns: [
          { data: 'name', name: 'name' },
          { data: 'description', name: 'description' }
      ]
  });
});
</script>