<?php if ($section == 'add'): ?>

  <div class="forms-container">

    <div id="productForm" class="forms">

      <?php if (count($errors) > 0): ?>
        <div style="background:rgba(229, 35, 8, 0.1);padding:0.5rem 1rem;border:solid 1px rgb(229, 35, 8);color:rgb(229, 35, 8)">
          <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <h2>Select Dates and Tmes</h2>

      <form action="" method="post">

        <div class="input-group">

          <input type="datetime" name="time_started" id="time_started" onchange="updateInput2()" placeholder="Select date and time started " value="<?= isset($_POST['time_started']) ? $_POST['time_started'] : ''; ?>" style="width: 70%;padding:0.5rem;width:15rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;margin-bottom:0.5rem"><br>
          <input type="datetime" name="time_ended" placeholder="Select date and time ended" value="<?=old_value('time_ended'); ?>" style="max-width: 70%;padding:0.5rem;width:15rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;margin-bottom:0.5rem"><br>

        </div>

        <textarea name="descriptions" id="" rows="5" placeholder="Descriptions" style="max-width: 350px;padding:0.5rem;width:15rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;margin-bottom:0.5rem"></textarea>
        <input type="text" name="date_type" id="Month_of_date" style="visibility:hidden"><br>

        <div class="btn-group">
          <button type="submit" name="btn_saved" class="btn_saved" style="max-width: 350px;padding:0.5rem;width:8rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;margin-bottom:0.5rem;cursor:pointer">Save</button>&nbsp;
          <a href="" class="btn">
            <!-- <button type="button" class="">Cancel</button> -->
          </a>
        </div>

      </form>
    </div>
  </div>
<?php endif; ?>
<script>
  function updateInput2() {
    // Get the value of input1 
    var input1Value = document.getElementById("time_started").value;

    // Remove the first 4 characters from input1
    var modifiedValue = input1Value.slice(0, 10);

    // Set the modified value to input2
    document.getElementById("Month_of_date").value = modifiedValue;
  }
</script>