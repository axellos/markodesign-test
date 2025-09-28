import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
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
})

async function handleCourierFormSubmit(e, method, url, message, redirectUrl) {
    e.preventDefault();

    const formData = new FormData(e.currentTarget);
    const data = Object.fromEntries(formData.entries());

    // clear errors
    ['first_name','last_name','phone_number','is_active','vehicle_type','delivery_company_id']
        .forEach(field => {
            const el = document.getElementById('error_' + field);
            if (el) el.textContent = '';
        });

    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            sessionStorage.setItem('message', message);

            if (redirectUrl) {
                window.location.href = redirectUrl;
            } else {
                window.location.reload();
            }
        } else if (response.status === 422) {
            Object.entries(result.errors).forEach(([field, messages]) => {
                const el = document.getElementById('error_' + field);
                if (el) el.textContent = messages.join(', ');
            });
        } else {
            alert('Unexpected error occurred.');
            console.error(result);
        }
    } catch (err) {
        console.error('Network error:', err);
        alert('Network error occurred.');
    }
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

window.handleCourierFormSubmit = handleCourierFormSubmit;
window.deleteCourier = deleteCourier;
