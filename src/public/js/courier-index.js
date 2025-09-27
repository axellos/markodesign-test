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
