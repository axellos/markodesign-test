import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import iconUrl from 'leaflet/dist/images/marker-icon.png';
import iconRetinaUrl from 'leaflet/dist/images/marker-icon-2x.png';
import shadowUrl from 'leaflet/dist/images/marker-shadow.png';
import {initCourierLocationListener} from "./echo-listeners.js";

document.addEventListener('DOMContentLoaded', async () => {
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

    const locations = await fetchCourierLocations();

    locations?.data.forEach(location => {
        if (location && location.lat && location.lng) {
            window.courierMarkers[location.courier_id] = L.marker([location.lat, location.lng])
                .addTo(window.map)
                .bindPopup(`Courier ${location.courier_id}`);
        }
    });

    const waitForEcho = setInterval(() => {
        if (window.Echo) {
            clearInterval(waitForEcho);
            initCourierLocationListener(window.map, window.courierMarkers)
        }
    }, 100);
});

async function fetchCourierLocations() {
    try {
        const response = await fetch('/api/courier-locations');
        if (response.ok) {
            return await response.json();
        }
    } catch (error) {
        console.error("Error fetching courier locations:", error);
        return [];
    }
}
