// Polyfills, just in case someone IS using IE
import './polyfills/ChildNode_remove.polyfill.js';


export default class Notification {
    constructor(type, message) {
        this.message = message;

        if (type === 'error') {
            this.displayError();
            return;
        }
        if (type === 'success') {
            this.displaySuccess();
            return;
        }
        if (type === 'success-x') {
            this.displaySuccessX();
            return;
        }
        this.displayInfo();
    }

    displayError() {
        let notice = this.create();
        notice.classList.add('notice');
        notice.classList.add('notice-error');
        this.show(notice);
    }

    displaySuccess() {
        let notice = this.create();
        notice.classList.add('notice');
        notice.classList.add('notice-success');
        this.show(notice);
        this.timeout(notice);
    }

    displaySuccessX() {
        let notice = this.create();
        notice.classList.add('notice');
        notice.classList.add('notice-success');
        this.show(notice);
    }

    displayInfo() {
        let notice = this.create();
        notice.classList.add('xy-info');
        this.show(notice);
    }

    create() {
        let notice = document.createElement('div');
        notice.classList.add('xy-notification');
        notice.appendChild(this.createMessageElement());
        notice.appendChild(this.createCloseButton());
        return notice;
    }

    createCloseButton() {
        let closeButton = document.createElement('button');
        closeButton.classList.add('xy-close');
        closeButton.addEventListener('click', this.closeNotification);
        return closeButton;
    }

    createMessageElement() {
        let elem = document.createElement('section');
        elem.innerHTML = this.message;
        return elem;
    }

    closeNotification(event) {
        event.target.parentElement.remove();
    }

    show(notice) {
        let $container = document.querySelector('.xy-notification-container');
        if ($container) {
            $container.appendChild(notice);
        }
    }

    timeout(notice) {
        setTimeout(function() { notice.remove(); }, 3000);
    }
}
