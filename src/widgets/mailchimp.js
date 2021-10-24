import { registerWidget } from "../lib/utils";

export const fadeIn = (element, speed = "normal", display, callback = null) => {
    element.style.opacity = 0;
    element.style.display = display || "block";

    const fade = () => {
        let opacity = parseFloat(element.style.opacity);

        if ((opacity += speed === "fast" ? 0.2 : 0.1) <= 1) {
            element.style.opacity = opacity;

            if (opacity === 1 && callback) {
                callback();
            }

            window.requestAnimationFrame(fade);
        }
    };

    window.requestAnimationFrame(fade);
};

export const fadeOut = (element, speed = "normal", display, callback = null) => {
    element.style.opacity = 1;
    element.style.display = display || "block";

    const fade = () => {
        let opacity = parseFloat(element.style.opacity);

        if ((opacity -= speed === "fast" ? 0.2 : 0.1) < 0) {
            element.style.display = "none";
        } else {
            element.style.opacity = opacity;

            if (opacity === 0 && callback) {
                callback();
            }

            window.requestAnimationFrame(fade);
        }
    };

    window.requestAnimationFrame(fade);
};

class Zeus_Mailchimp extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                mcForm: '.zeus-mc-form',
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            mcForm: element.querySelectorAll(selectors.mcForm),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        this.setupEventListeners();
    }

    setupEventListeners() {
        var mcForms = this.elements.mcForm;

        mcForms.forEach((form) => {
            var apiKey          = form.parentNode.getAttribute('data-api-key'),
                listID          = form.parentNode.getAttribute('data-list-id'),
                buttonText      = form.parentNode.getAttribute('data-button-text'),
                successText     = form.parentNode.getAttribute('data-success-text'),
                loadingText     = form.parentNode.getAttribute('data-loading-text');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                var btn         = form.querySelector('.zeus-mc-subscribe'),
                    btnText     = form.querySelector('.zeus-mc-subscribe span'),
                    firstName   = form.querySelector('.zeus-mc-input-fn').value.trim(),
                    lastName    = form.querySelector('.zeus-mc-input-ln').value.trim(),
                    emailAdress = form.querySelector('.zeus-mc-input-email').value.trim(),
                    msg         = form.querySelector('.zeus-mc-message');

                btn.classList.add('mc-btn-loading');
                btnText.innerHTML = loadingText;

                const formData = new FormData();
                formData.append("action", "zeus_mc_form");
                formData.append("nonce", localize.nonce);
                formData.append("apiKey", apiKey);
                formData.append("listId", listID);
                formData.append("firstname", firstName);
                formData.append("lastname", lastName);
                formData.append("email", emailAdress);
                const params = new URLSearchParams(formData);

                fetch( localize.ajax_url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Cache-Control': 'no-cache',
                    },
                    body: params
                }).then( response => {
                    return response.json();
                }).then( response => {
                    if ( response.status == 'subscribed' ) {
                        event.target.reset();

                        msg.classList.add('zeus-mc-success-text');
                        msg.style.display = 'block';
                        msg.innerHTML = '<p>' + successText + '</p>';
                    } else {
                        msg.classList.add('zeus-mc-error-text');
                        msg.style.display = 'block';
                        msg.innerHTML = '<p>' + response.status + '</p>';
                    }

                    btn.classList.remove('mc-btn-loading');
                    btnText.innerHTML = buttonText;
                }).catch( err => { 
                    msg.classList.add('zeus-mc-error-text');
                    msg.style.display = 'block';
                    msg.innerHTML = '<p>' + err.status + '</p>';

                    btn.classList.remove('mc-btn-loading');
                    btnText.innerHTML = buttonText;
                });
            });
        });
    }
}

registerWidget(Zeus_Mailchimp, "zeus-mailchimp");
