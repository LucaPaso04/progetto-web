<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $partita['place']; ?></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $partita['host_username']; ?></h6>
    <p class="card-text"><?php echo $partita['date']; ?></p>
    <p class="card-text"><?php echo $partita['hour']; ?></p>
    <?php 
      if ($partita['id_user'] == $id_user) {
        echo '<a href="#" class="card-link">Iscritto</a>';
      } else {
        echo '<a href="#" class="card-link">Iscriviti</a>';
      }
    ?>
  </div>
</div>