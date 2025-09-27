document.addEventListener('DOMContentLoaded', () => {
    const map = L.map('map').setView([50.4501, 30.5234], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
});
