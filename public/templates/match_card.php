<?php
    $bg_class = '';
    if ($match['visibility'] == 'private') {
        $bg_class = 'match-private';
    } elseif ($match['visibility'] == 'public') {
        $bg_class = 'match-public';
    }
?>

<div class="col-12 col-sm-6 col-lg-3 mb-4">
  <div class="card <?php echo $bg_class; ?>">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <h5 class="card-title text-center mb-3"><?php echo $match['place']; ?></h5>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <h6 class="card-subtitle mb-2 text-body-secondary text-center">@<?php echo $match['host_username']; ?></h6>
        </div>
      </div>

      <div class="row">
        <div class="col-6 text-center">
          <p class="card-text"><?php echo $match['date']; ?></p>
        </div>
        <div class="col-6 text-center">
          <p class="card-text"><?php echo $match['hour']; ?></p>
        </div>
      </div>
      
      <div class="row">
        <p class="card-text text-center"><?php echo $match['format']; ?></p>
      </div>

      <div class="row mt-3">
        <div class="col-12 text-center">
          <?php 
            if ($match['id_user'] == $id_user) {
              echo '<button href="#" class="btn btn-secondary">Iscritto</button>';
            } else {
              echo '<button href="#" class="btn btn-secondary">Iscriviti</button>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>