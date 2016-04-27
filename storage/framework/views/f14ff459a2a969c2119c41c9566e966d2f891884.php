          <?php foreach($events as $event): ?>
            <tr>
              <td class="text-primary"><strong><?php echo e($event->name); ?></strong></td>
              <td><?php echo e($event->description); ?></td> 
              <td><?php echo e($event->location); ?></td> 
              <td><?php echo e($event->schedule); ?></td> 
              <td></td>
            </tr>
          <?php endforeach; ?>
