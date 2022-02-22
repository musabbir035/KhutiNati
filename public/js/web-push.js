// initSW();

// function initSW() {
//   if (!"serviceWorker" in navigator) {
//     return;
//   }

//   if (!"PushManager" in window) {
//     return;
//   }

//   console.log("Registering service worker...");
//   navigator.serviceWorker
//     .register("../js/worker.js")
//     .then(() => {
//       console.log("Service worker registerd");
//       initPush();
//     })
//     .catch((err) => {
//       console.log(err);
//     });
// }

// function initPush() {
//   if (!navigator.serviceWorker.ready) {
//     return;
//   }

//   console.log("Requesting notification permission...");
//   new Promise(function (resolve, reject) {
//     const permissionResult = Notification.requestPermission(function (result) {
//       resolve(result);
//     });

//     if (permissionResult) {
//       permissionResult.then(resolve, reject);
//     }
//   }).then((permissionResult) => {
//     if (permissionResult !== "granted") {
//       throw new Error("We weren't granted permission.");
//     }
//     console.log("Permission granted");
//     subscribeUser();
//   });
// }

// function subscribeUser() {
//   console.log("Subscribing user...");
//   navigator.serviceWorker.ready
//     .then((registration) => {
//       const subscribeOptions = {
//         userVisibleOnly: true,
//         applicationServerKey: urlBase64ToUint8Array(
//           "BOjpdvfXD5EZ8DcTetNxP2n8XI71lDc83RGjYsC80bxI_KLHuDVYVHEt7Iiy5lIC2Ao7lrKo6a00XLibm8KZofA"
//         ),
//       };

//       return registration.pushManager.subscribe(subscribeOptions);
//     })
//     .then((pushSubscription) => {
//       console.log(
//         "Received PushSubscription: ",
//         JSON.stringify(pushSubscription)
//       );
//       storePushSubscription(pushSubscription);
//       console.log("User subscribed");
//     })
//     .catch((err) => {
//       console.log(err);
//     });
// }

// function urlBase64ToUint8Array(base64String) {
//   var padding = "=".repeat((4 - (base64String.length % 4)) % 4);
//   var base64 = (base64String + padding).replace(/\-/g, "+").replace(/_/g, "/");

//   var rawData = window.atob(base64);
//   var outputArray = new Uint8Array(rawData.length);

//   for (var i = 0; i < rawData.length; ++i) {
//     outputArray[i] = rawData.charCodeAt(i);
//   }
//   return outputArray;
// }

// function storePushSubscription(pushSubscription) {
//   const token = document
//     .querySelector("meta[name=csrf-token]")
//     .getAttribute("content");

//   fetch("/push", {
//     method: "POST",
//     body: JSON.stringify(pushSubscription),
//     headers: {
//       Accept: "application/json",
//       "Content-Type": "application/json",
//       "X-CSRF-Token": token,
//     },
//   })
//     .then((res) => {
//       return res.json();
//     })
//     .then((res) => {
//       console.log(res);
//     })
//     .catch((err) => {
//       console.log(err);
//     });
// }

/***********
 * saasdsd
 */
if ("serviceWorker" in navigator) {
  send().catch((err) => console.log(err));
}

async function send() {
  console.log("Registering service worker...");
  const register = await navigator.serviceWorker.register("../js/worker.js");
  console.log("Service worker Registered");

  console.log("Registering push");
  const subscription = await register.pushManager.subscribe({
    userVisibleOnly: true,
    applicationServerKey: urlBase64ToUint8Array(
      "BOjpdvfXD5EZ8DcTetNxP2n8XI71lDc83RGjYsC80bxI_KLHuDVYVHEt7Iiy5lIC2Ao7lrKo6a00XLibm8KZofA"
    ),
  });
  console.log("Push registered");

  console.log("Sending push...");
  const token = document
    .querySelector("meta[name=csrf-token]")
    .getAttribute("content");
  await fetch("/web-push", {
    method: "POST",
    body: JSON.stringify(subscription),
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      "X-CSRF-Token": token,
    },
  });
  console.log("Push sent");
}

function urlBase64ToUint8Array(base64String) {
  var padding = "=".repeat((4 - (base64String.length % 4)) % 4);
  var base64 = (base64String + padding).replace(/\-/g, "+").replace(/_/g, "/");

  var rawData = window.atob(base64);
  var outputArray = new Uint8Array(rawData.length);

  for (var i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}
