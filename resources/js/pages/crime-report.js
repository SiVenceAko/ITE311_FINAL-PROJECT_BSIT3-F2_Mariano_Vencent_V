import L from 'leaflet';

document.addEventListener('DOMContentLoaded', () => {
    const mapElement = document.querySelector('#report-location-map');

    if (!mapElement) {
        return;
    }

    const latitudeInput = document.querySelector('#latitude');
    const longitudeInput = document.querySelector('#longitude');
    const coordinatesOutput = document.querySelector('#selected-coordinates');
    const mapError = document.querySelector('#report-map-error');
    const reportForm = document.querySelector('#crime-report-form');

    const map = L.map(mapElement).setView([13.1733849, 121.2787746], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>',
    }).addTo(map);

    let locationMarker = null;

    const selectLocation = (latitude, longitude) => {
        latitudeInput.value = latitude.toFixed(7);
        longitudeInput.value = longitude.toFixed(7);
        coordinatesOutput.textContent =
            `${latitude.toFixed(6)}, ${longitude.toFixed(6)}`;
        mapError.hidden = true;

        if (locationMarker) {
            locationMarker.setLatLng([latitude, longitude]);
            return;
        }

        locationMarker = L.circleMarker([latitude, longitude], {
            radius: 10,
            color: '#ffffff',
            weight: 3,
            fillColor: '#dc3f3f',
            fillOpacity: 1,
        }).addTo(map);
    };

    const savedLatitude = Number.parseFloat(latitudeInput.value);
    const savedLongitude = Number.parseFloat(longitudeInput.value);

    if (Number.isFinite(savedLatitude) && Number.isFinite(savedLongitude)) {
        selectLocation(savedLatitude, savedLongitude);
        map.setView([savedLatitude, savedLongitude], 16);
    }

    map.on('click', (event) => {
        selectLocation(event.latlng.lat, event.latlng.lng);
    });

    reportForm.addEventListener('submit', (event) => {
        if (!latitudeInput.value || !longitudeInput.value) {
            event.preventDefault();
            mapError.hidden = false;
            mapElement.focus();
        }
    });

    window.setTimeout(() => map.invalidateSize(), 0);
});
