
<div class="row">
  <div class="col-md-12">
    <div class="box" id="queries-over-time">
        <div class="box-header with-border">
          <h3 class="box-title">FanSpeed results over last <?php echo htmlspecialchars($fanspeeddays); ?></h3>
        </div>
        <div style="width: 100%; overflow: auto">
        <div style="width: 1500px; height: 140">
          <div class="box-body">
          <div class="chart">
          <canvas id="fanspeedChart" width="0" height="140"></canvas>
          </div>
    </div>
  </div>
</div>
        <div class="overlay">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
