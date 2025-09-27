const msg = sessionStorage.getItem('message');

if (msg) {
    const container = document.getElementById('message-container');
    container.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4';
    container.textContent = msg;
    sessionStorage.removeItem('message');

    setTimeout(() => {
        container.remove();
    }, 5000);
}

async function deleteCourier(e, courierId) {
    e.preventDefault();

    try {
        const response = await fetch(`/api/couriers/${courierId}`, {
            method: 'DELETE',
            headers: { 'Accept': 'application/json' },
        });

        if (response.ok) {
            sessionStorage.setItem('message', 'Courier deleted successfully!');
            window.location.reload();
        } else {
            const result = await response.json();
            console.error('Delete failed:', result);
            alert('Failed to delete courier.');
        }
    } catch (err) {
        console.error('Network error:', err);
        alert('Network error occurred.');
    }
}
