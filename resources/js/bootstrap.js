window._ = require("lodash");

window.bootstrap = require("bootstrap");

var tooltipTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");

window.Echo = new Echo({
  broadcaster: "pusher",
  key: "2e925623f03530b52786",
  cluster: "ap2",
  forceTLS: true,
});

window.pusher = new Pusher("2e925623f03530b52786", {
  encrypted: true,
  cluster: "ap2",
  authEndpoint: "/broadcasting/auth",
  auth: {
    headers: {
      "X-CSRF-TOKEN": "{{ csrf_token() }}",
    },
  },
});

window.coundownTimer = (el, date = new Date().getTime()) => {
  setInterval(() => {
    let coundownDate = new Date(date).getTime();
    let now = new Date().getTime();
    let diff = coundownDate - now;

    let days = Math.floor(diff / (1000 * 60 * 60 * 24));
    let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((diff % (1000 * 60)) / 1000);

    if (diff < 0) {
      el.innerHTML = '<span class="text-danger">Expired</>';
      clearInterval(this);
    } else {
      el.innerHTML = `<span class="text-success">${days}d ${hours}h ${minutes}m ${seconds}s</span>`;
    }
  }, 1000);
};
