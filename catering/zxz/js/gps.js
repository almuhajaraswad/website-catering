
	 
	function getLocation() {
	  if (navigator.geolocation) {
	  	alert('Lokasi Berhasil Di-Aktifkan');
	    navigator.geolocation.getCurrentPosition(showPosition);
	  } else { 
	    alert('Browser Tidak Mendukung Geolocation');
	  }
	}
	 
	function showPosition(position) {
	  var latitude = position.coords.latitude;
	  var longitude = position.coords.longitude;

	  // Masukkan ke form
	  document.getElementById('latitude').value = latitude;
	  document.getElementById('longitude').value = longitude;
	}