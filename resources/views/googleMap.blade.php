<script type="text/javascript">
$(document).ready(function() {

  $('.fancybox').fancybox({
    beforeShow   : function() {

      $('#us3').locationpicker({
          location: {
              latitude: -8.409518,
              longitude: 115.188919
          },
          radius: 300,
          inputBinding: {
              latitudeInput: $('#us3-lat'),
              longitudeInput: $('#us3-lon'),
              radiusInput: $('#us3-radius'),
              locationNameInput: $('#us3-address')
          },
          enableAutocomplete: true,
          onchanged: function (currentLocation, radius, isMarkerDropped) {
              // Uncomment line below to show alert on each Location Changed event
              //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
          }


      });
    }
  });
});

function closedialogx(){
  $("#latmap").val($("#us3-lat").val());
  $("#lonmap").val($("#us3-lon").val());
  //$("#fancybox").load($('#fancybox').data('url')+"?lat="+$("#us3-lat").val()+"&long="+$("#us3-lon").val());
  parent.jQuery.fancybox.close();
}


</script>
<style>
  .pac-container {
      z-index: 10000 !important;
  }
</style>
<div id="inline1" style="width:100%;display: none;">

<script src="{{ URL::to('themes/dist/locationpicker.jquery.js') }}"></script>
<div class="form-horizontal" style="width: 550px">
<div class="form-group">
<label class="col-sm-2 control-label">Location:</label>

<div class="col-sm-6">
    <input type="text" class="form-control" id="us3-address" />
</div>
<div class="col-sm-2">
    <a href="#" onclick="closedialogx();" class="btn btn-primary waves-effect">Gunakan Map</a>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Radius:</label>

<div class="col-sm-5">
    <input type="text" class="form-control" id="us3-radius" style="margin-top:10px;margin-bottom: 10px;" />
</div>
</div>
<div id="us3" style="width: 550px; height: 400px;"></div>
<div class="clearfix">&nbsp;</div>
<div class="m-t-small">
<label class="p-r-small col-sm-1 control-label">Lat.:</label>

<div class="col-sm-3">
    <input type="text" class="form-control" style="width: 110px" id="us3-lat" />
</div>
<label class="p-r-small col-sm-2 control-label">Long.:</label>

<div class="col-sm-3">
    <input type="text" class="form-control" style="width: 110px" id="us3-lon" />
</div>
</div>
<div class="clearfix"></div>
<script>

</script>
<!-- #END# Tabs With Icon Title -->
</div>
</div>
