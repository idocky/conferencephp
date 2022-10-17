function initMap(){                                                 //инициализирует карту при загузке страницы
    let l1 = document.querySelector('.forData').getAttribute('lat-attr');
    let l2 = document.querySelector('.forData').getAttribute('lng-attr');
    let pos = {lat: parseFloat(l2), lng: parseFloat(l1)};
    console.log(pos);
    let opt = {
        center: pos,
        zoom: 16
    }
    const myMap = new google.maps.Map(document.getElementById('map'), opt);

    addMarker(pos ,myMap);
    // Adds a marker to the map.
    function addMarker(location, myMap) {
        // Add the marker at the clicked location, and add the next-available label
        // from the array of alphabetical characters.
        marker = new google.maps.Marker({
            position: location,
            map: myMap,
        });
    }

}
window.initMap = initMap;