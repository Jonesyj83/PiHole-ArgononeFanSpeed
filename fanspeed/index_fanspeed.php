<div class="row">
  <div class="col-md-12">
    <div class="box" id="queries-over-time">
        <div class="box-header with-border">
          <h3 class="box-title">FanSpeed results over last <?php echo htmlspecialchars($fanspeeddays); ?></h3>
        </div>
    	   <input type="button" id="1h" class="period ui-button" value="1h" />
    	   <input type="button" id="3h" class="period ui-button" value="3h"/>
	   <input type="button" id="6h" class="period ui-button" value="6h"/>
    	   <input type="button" id="9h" class="period ui-button" value="9h"/>
    	   <input type="button" id="12h" class="period ui-button" value="12h"/>
    	   <input type="button" id="24h" class="period ui-button" value="24h"/>
        <div style="width: 100%; overflow: auto">
        <div style="height: 140">
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
