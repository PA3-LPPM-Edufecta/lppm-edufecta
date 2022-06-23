<div class="box ">
  <table style="width: 100%">
    <?php foreach ($data_table as $row) {
      foreach ($data_field as $key) {
        if ($key->name != 'id' && $key->name != 'password' && $key->name != 'created_at' && $key->name != 'updated_at') { ?>
          <tr>
            <td class="text-left" style="width: 50%;">
              <?= strtoupper($key->name); ?>
            </td>
            <td style="column-width: 10%">:</td>
            <td class="text-left" style="text-align: justify;">
              &nbsp;<?= $row[$key->name]; ?>
            </td>
          </tr>
    <?php }
      }
    } ?>
  </table>
</div>