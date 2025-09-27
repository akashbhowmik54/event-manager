document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("eventForm");
    if (!form) return; 

    form.addEventListener("submit", async function (e) {
        e.preventDefault();
        
        let formData = new FormData(this);

        let response = await fetch('/wp-json/uem/v1/submit-event', {
            method: 'POST',
            body: formData,
            headers: {
                'X-WP-Nonce': wpApiSettings.nonce 
            }
        });

        let result = await response.json();
        console.log(result);

        if (result.success) {
            alert('Event submitted successfully!');
            this.reset();
        } else {
            alert('Error: ' + result.message);
        }
    });
});