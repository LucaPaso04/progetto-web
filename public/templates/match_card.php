<?php
    $bg_class = '';
    if ($match['visibility'] == 'private') {
        $bg_class = 'match-private';
    } elseif ($match['visibility'] == 'public') {
        $bg_class = 'match-public';
    }
?>

<div class="col mb-4">
  <div class="card <?php echo $bg_class; ?>">
    <div class="card-body">
      <h5 class="card-title text-center"><?php echo $match['place']; ?></h5>
      <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $match['host_username']; ?></h6>
      <p class="card-text"><?php echo $match['date']; ?></p>
      <p class="card-text"><?php echo $match['hour']; ?></p>
      <p class="card-text"><?php echo $match['format']; ?></p>

      <?php 
        if ($match['id_user'] == $id_user) {
          echo '<a href="#" class="card-link">Iscritto</a>';
        } else {
          echo '<a href="#" class="card-link">Iscriviti</a>';
        }
      ?>
    </div>
  </div>
</div