let l1 = 0, l2 = 0;
let marker = NaN;


function initMap(){                                                 //инициализирует карту при загузке страницы
    let l1 = document.querySelector('.forData').getAttribute('lat-attr');
    let l2 = document.querySelector('.forData').getAttribute('lng-attr');
    let pos;
    if (l1 != ''){
        pos = {lat: parseFloat(l2), lng: parseFloat(l1)};
        opt = {
            center: pos,
            zoom: 16
        }
    }
    else{
        pos = {lat:48.73631734869565, lng: 31.496805299456966};
        opt = {
            center: pos,
            zoom: 4
        }
    }

    const myMap = new google.maps.Map(document.getElementById('map'), opt);

    if (l1 != '') {
        addMarker(pos, myMap)
    }
    else {
        google.maps.event.addListener(myMap, "click", (event) => {
            if (typeof marker == 'object'){                 //проверка на то есть ли уже маркер на карте
                marker.setMap(null);
            }
            addMarker(event.latLng, myMap);
            l1 = event.latLng.lat();
            l2 = event.latLng.lng();
            vm.changeLatLng();
        });
    }

    const vm = new Vue({
        el: "#latLng",
        data:{
            latitude: l2,
            longitude: l1
        },
        methods: {
            changeLatLng: function (){
                this.latitude = l2;
                this.longitude = l1;
            }

        }
    });





    // Add a marker at the center of the map.
    addMarker(setCoordinates(), myMap);

    // Adds a marker to the map.
    function addMarker(location, myMap) {
        // Add the marker at the clicked location, and add the next-available label
        // from the array of alphabetical characters.
        marker = new google.maps.Marker({
            position: location,
            map: myMap,
            draggable:true,
        });

        google.maps.event.addListener(marker, "dragend", (event) => {
            l1 = event.latLng.lat();
            l2 = event.latLng.lng();
            vm.changeLatLng();
        });
    }

}

function setCoordinates(){
    return {lat: l2, lng: l1};
}
console.log('dsfsdf');
window.initMap = initMap;