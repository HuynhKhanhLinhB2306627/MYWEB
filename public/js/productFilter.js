document.addEventListener('DOMContentLoaded', function () {
    function handleFilterChange(event) {
        event.preventDefault();
        const currentUrl = new URL(window.location.href);
        const clickedElement = event.currentTarget;
        let newParams;
        if (clickedElement.tagName === 'A') {
            newParams = new URL(clickedElement.href).searchParams;
        } else {
            newParams = new URLSearchParams();
            newParams.set('price', clickedElement.value);
        }
        newParams.forEach((value, key) => {
            if (value === 'all' || value === 'default') {
                currentUrl.searchParams.delete(key);
            } else {
                currentUrl.searchParams.set(key, value);
            }
        });
        window.location.href = currentUrl.toString();
    }
    document.querySelectorAll('.filter-control').forEach(control => {
        let eventType = (control.tagName === 'A') ? 'click' : 'change';
        control.addEventListener(eventType, handleFilterChange);
    });
});


