document.getElementById('edit-courier-form').addEventListener('submit', async function() {
    const form = this;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    const courierId = form.dataset.courierId;

    ['first_name','last_name','phone_number', 'is_active', 'vehicle_type','delivery_company_id'].forEach(field => {
        document.getElementById('error_' + field).textContent = '';
    });

    const response = await fetch(`/api/couriers/${courierId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    if (response.ok) {
        sessionStorage.setItem('message', 'Courier updated successfully!');
        window.location.href = '/'
    } else if (response.status === 422) {
        Object.entries(result.errors).forEach(([field, messages]) => {
            const el = document.getElementById('error_' + field);
            if (el) el.textContent = messages.join(', ');
        });
    } else {
        alert('Unexpected error occurred.');
        console.error(result);
    }
});
