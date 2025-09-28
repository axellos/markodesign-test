import {initCourierLocationDebugListener} from './echo-listeners.js';

document.addEventListener('DOMContentLoaded', function () {
    const wsLog = document.getElementById('ws-log');

    const waitForEcho = setInterval(() => {
        if (window.Echo) {
            clearInterval(waitForEcho);
            initCourierLocationDebugListener(wsLog);
        }
    }, 100);
});

async function updateCourierLocation(courierId, lat, lng) {
    try {
        const response = await fetch(`/api/couriers/${courierId}/location`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ lat: parseFloat(lat), lng: parseFloat(lng) }),
        });

        return await response.json();
    } catch (err) {
        console.error('Error updating courier location:', err);
        throw err;
    }
}

async function handleLocationUpdateFormSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.currentTarget);
    const data = Object.fromEntries(formData.entries());

    ['lat','lng','courier_id']
        .forEach(field => {
            const el = document.getElementById('error_' + field);
            if (el) el.textContent = '';
        });

    const response = await updateCourierLocation(data.courier_id, data.lat, data.lng);

    if (! response.ok) {
        Object.entries(response.errors).forEach(([field, messages]) => {
            const el = document.getElementById('error_' + field);
            if (el) el.textContent = messages.join(', ');
        })
    }
}

window.handleLocationUpdateFormSubmit = handleLocationUpdateFormSubmit
