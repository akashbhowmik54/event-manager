document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("eventForm");
    if (!form) return; 

    const msgContainer = document.createElement("div");
    msgContainer.classList.add("ak-form-message");
    form.appendChild(msgContainer);

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

        msgContainer.textContent = result.message;
        msgContainer.style.display = "block";
        msgContainer.style.opacity = "1";

        if (result.success) {
            msgContainer.style.color = "green";
            this.reset();
        } else {
            msgContainer.style.color = "red";
        }

        setTimeout(() => {
            msgContainer.style.transition = "opacity 0.5s";
            msgContainer.style.opacity = "0";
            setTimeout(() => { msgContainer.style.display = "none"; }, 500);
        }, 3000);
    });
});