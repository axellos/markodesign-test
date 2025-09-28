export function initCourierLocationListener(map, markers) {
    if (!window.Echo) {
        console.warn('Laravel Echo is not loaded yet');
        return;
    }

    window.Echo.channel('couriers')
        .listen('CourierLocationUpdated', (event) => {
            const marker = markers[event.courier_id];
            if (event.lat === null || event.lng === null) {
                if (marker) {
                    map.removeLayer(marker);
                    delete markers[event.courier_id];
                }
            } else {
                if (marker) {
                    marker.setLatLng([event.lat, event.lng]);
                } else {
                    markers[event.courier_id] = L.marker([event.lat, event.lng])
                        .addTo(map)
                        .bindPopup(`Courier ${event.courier_id}`);
                }
            }
        });
}

export function initCourierLocationDebugListener(wsLog) {
    window.Echo.channel('couriers')
        .listen('CourierLocationUpdated', (event) => {
            wsLog.innerHTML += `<div>Courier ${event.courier_id} updated: ${event.lat}, ${event.lng}</div>`;
            wsLog.scrollTop = wsLog.scrollHeight;
        });
}
