<script>
function changeText(length)
{
 document.getElementById('lasttime').innerHTML = "FanSpeed results over last " + length;
}
</script>
<div class="row">
  <div class="col-md-12">
    <div class="box" id="queries-over-time">
        <div class="box-header with-border">
          <h3 class="box-title"><p id='lasttime'>FanSpeed results over last 24 Hours</p></h3>
        </div>
           <input type="button" onclick="changeText('1 Hour')" id="1h" class="period ui-button" value="1h" />
           <input type="button" onclick="changeText('3 Hours')" id="3h" class="period ui-button" value="3h"/>
           <input type="button" onclick="changeText('6 Hours')" id="6h" class="period ui-button" value="6h"/>
           <input type="button" onclick="changeText('9 Hours')" id="9h" class="period ui-button" value="9h"/>
           <input type="button" onclick="changeText('12 Hours')" id="12h" class="period ui-button" value="12h"/>
           <input type="button" onclick="changeText('24 Hours')" id="24h" class="period ui-button" value="24h"/>
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
