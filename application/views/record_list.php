<article id="board_area">
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">날짜</th>
            <th scope="col">시간</th>
            <th scope="col">분유(ml)</th>
            <th scope="col">이유식(%)</th>
            <th scope="col">작성자</th>
        </tr>
    </thead>
    <tbody>
          <?php
            foreach ($record as $result => $entry) {
           ?>
              <tr>
                  <td>
                    <a href="/index.php/record/get/"<?=$entry->id?>><?=$entry->record_date?></a>
                  </td>
                  <td class="rb-user">
                    <a href="/index.php/record/get/"<?=$entry->id?>><?=$entry->record_time?></a>
                  </td>
                  <td class="rb-hit">
                      <a href="/index.php/record/get/"<?=$entry->id?>><?=$entry->milk?></a>
                  </td>
                  <td class="rb-time">
                      <a href="/index.php/record/get/"<?=$entry->id?>><?=$entry->rice?></a>
                  </td>
                  <td class="rb-time">
                      <a href="/index.php/record/get/"<?=$entry->id?>><?=$entry->author?></a>
                  </td>
                </tr>
          <?php
          }
           ?>
    </tbody>
    </table>
  </div>
</article>
