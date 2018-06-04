<article id="board_area">
<div class="main xpull">
  <a href="<?php echo base_url("record")?>" type="button" role="button" class="btn btn-primary btn-lg pull-right">기록하기</a>
  <div class="table-responsive">
  <table id="record_list" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">날짜</th>
            <th scope="col">시간</th>
            <th scope="col">분유(ml)</th>
            <th scope="col">이유식(ml)</th>
            <th scope="col">작성자</th>
            <!-- <th scope="col">남긴 글</th> -->
        </tr>
    </thead>
    <tbody>
          <?php
            foreach ($record as $result => $entry) {
           ?>
              <tr>
                  <td class="rb-time">
                    <a href="<?php echo base_url("record/index/")?><?=$entry->id?>"><?=$entry->record_date?></a>
                  </td>
                  <td class="rb-time">
                    <a href="<?php echo base_url("record/index/")?><?=$entry->id?>"><?=$entry->record_time?></a>
                  </td>
                  <td>
                    <a href="<?php echo base_url("record/index/")?><?=$entry->id?>"><?=$entry->milk?></a>
                  </td>
                  <td>
                    <a href="<?php echo base_url("record/index/")?><?=$entry->id?>"><?=$entry->rice?></a>
                  </td>
                  <td class="rb-user">
                    <a href="<?php echo base_url("record/index/")?><?=$entry->id?>"><?=$entry->nickname?></a>
                  </td>
                  <!-- <td>
                    <a href="<?php echo base_url("record/index/")?><?=$entry->id?>"><?=$entry->description?></a>
                  </td> -->
                </tr>
          <?php
          }
           ?>
    </tbody>
    </table>
  </div>
</div>
</article>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
$( function() {
    $('#record_list').DataTable({
        "ordering": false,
        "lengthChange":     false,
        "searching" : false
    });
} );

</script>
