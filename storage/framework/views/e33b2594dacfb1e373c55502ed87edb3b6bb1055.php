<script>
$(function() {
  $('#example').DataTable({
      processing: true,
      serverSide: true,
      ajax: '<?php echo route('datatables.data'); ?>',
      columns: [
          { data: 'name', name: 'name' },
          { data: 'description', name: 'description' }
      ]
  });
});
</script>