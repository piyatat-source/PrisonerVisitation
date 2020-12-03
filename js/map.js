var marker = null;
var map;
function initMap() {
    var location = { lat: 16.454982386590594, lng: 103.51984376956334 };
    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 18,
      center: location,
      streetViewControl: false,
      mapTypeControl: false
    });
    
    new google.maps.Marker({
      position: location,
      map
    });
}
