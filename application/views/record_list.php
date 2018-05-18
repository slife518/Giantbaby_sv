
<div class="span2">
    <ul class="nav nav-tabs nav-stacked">
        <?php
          foreach ($records as $result => $entry) {
         ?>
            <li><a href="/index.php/record/get/"<?=$entry->id?><?=$entry->record_date?></a></li>
        <?php
        }
         ?>
    </ul>
</div>
