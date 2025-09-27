import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import iconUrl from 'leaflet/dist/images/marker-icon.png';
import iconRetinaUrl from 'leaflet/dist/images/marker-icon-2x.png';
import shadowUrl from 'leaflet/dist/images/marker-shadow.png';

document.addEventListener('DOMContentLoaded', () => {
    window.courierMarkers = {};
    window.map = L.map('map').setView([50.4501, 30.5234], 12);

    delete L.Icon.Default.prototype._getIconUrl;

    L.Icon.Default.mergeOptions({
        iconRetinaUrl,
        iconUrl,
        shadowUrl,
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
    }).addTo(window.map);

    const waitForEcho = setInterval(() => {
        if (window.Echo) {
            clearInterval(waitForEcho);

            window.Echo.channel('couriers')
                .listen('CourierLocationUpdated', (event) => {
                    console.log('Courier updated:', event);

                    const marker = window.courierMarkers[event.courier_id];
                    if (marker) {
                        marker.setLatLng([event.lat, event.lng]);
                    } else {
                        window.courierMarkers[event.courier_id] = L.marker([event.lat, event.lng])
                            .addTo(window.map)
                            .bindPopup(`Courier ${event.courier_id}`);
                    }
                });
        }
    }, 100);
});
