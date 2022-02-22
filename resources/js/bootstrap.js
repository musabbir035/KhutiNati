window._ = require("lodash");

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

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

// window.onload = function () {
//   if (UserId) {
//     alert(UserId);
//     Echo.private(`App.User.${UserId}`).notification((notification) => {
//       //addNotifications([notification], '#notifications');
//       console.log(JSON.stringify(notification));
//     });
//   }
// };

//Pusher.logToConsole = true;

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
