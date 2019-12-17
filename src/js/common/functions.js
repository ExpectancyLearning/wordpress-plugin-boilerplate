/**
 * Functions that are common to both front and back end.
 *
 * If common functions are needed in multiple files for just the back end or just the front end,
 * use the respective `core.js` files.
 */

import Notification from './Notification.js';

function getUrlParam(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    let regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    let results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

function resetErrorNotifications() {
    let $notifications = document.querySelectorAll('.xy-notification.xy-error');
    for (let i = 0; i < $notifications.length; i++) {
        $notifications[i].querySelector('.xy-close').click();
    }
}

function resetFormErrors() {
    let $errorElements = document.querySelectorAll('input.xy-error, textarea.xy-error');
    for (let i = 0; i < $errorElements.length; i++) {
        $errorElements[i].classList.remove('xy-error');
    }
}

function displayValidationErrors(errors) {
    let errorMessages = [];
    errors.forEach(error => {
        errorMessages.push(error.message);
        document.querySelector(error.selector).classList.add('xy-error');
    });
    new Notification('error', errorMessages.join('<br>'));
}

function scrollToTop(top) {
    window.scrollTo({
        top: top || 0,
        behavior: 'smooth',
    });
}

function selectMenuOptionValues($selectMenu) {
    let options = Array.from($selectMenu.options);
    return options.map(option => parseInt(option.value));
}

function selectMenuOptionEnabledValues($selectMenu) {
    return Array.from($selectMenu.options)
        .filter(option => { return !option.disabled; } )
        .map(option => parseInt(option.value));
}

function checkedCheckboxesValues($checkboxes) {
    let checkedCheckboxes = [];

    [].forEach.call($checkboxes, el => {
        if (el.checked === true)
            checkedCheckboxes.push(el.value);
    });

    return checkedCheckboxes;
}

function clearContainer($container) {
    if ($container) {
        while ($container.firstChild) {
            $container.removeChild($container.firstChild);
        }
    }
}

export {
    getUrlParam,
    resetErrorNotifications,
    resetFormErrors,
    displayValidationErrors,
    scrollToTop,
    selectMenuOptionValues,
    selectMenuOptionEnabledValues,
    checkedCheckboxesValues,
    clearContainer,
};
