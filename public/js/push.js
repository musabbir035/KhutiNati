registerServiceWorker();

async function registerServiceWorker() {
  if (!("serviceWorker" in navigator)) {
    console.log("Service workers aren't supported in this browser.");
    return;
  }

  console.log("Loading service worker...");
  register = await navigator.serviceWorker.register("/js/worker.js");
  initialiseServiceWorker(register);
  console.log("Loaded service worker");
}

function initialiseServiceWorker(register) {
  if (!("showNotification" in ServiceWorkerRegistration.prototype)) {
    console.log("Notifications aren't supported.");
    return;
  }
  if (Notification.permission === "denied") {
    console.log("The user has blocked notifications.");
    return;
  }
  if (!("PushManager" in window)) {
    console.log("Push messaging isn't supported.");
    return;
  }

  const options = { userVisibleOnly: true };
  const vapidPublicKey =
    "BOjpdvfXD5EZ8DcTetNxP2n8XI71lDc83RGjYsC80bxI_KLHuDVYVHEt7Iiy5lIC2Ao7lrKo6a00XLibm8KZofA";

  if (vapidPublicKey) {
    options.applicationServerKey = urlBase64ToUint8Array(vapidPublicKey);
  }
  console.log("Registering push manager...");
  register.pushManager.subscribe(options).then((subscription) => {
    console.log("Registered push manager");
    updateSubscription(subscription);
  });
}

function updateSubscription(subscription) {
  console.log("Updating subscription...");
  const key = subscription.getKey("p256dh");
  const token = subscription.getKey("auth");
  const contentEncoding = (PushManager.supportedContentEncodings || [
    "aesgcm",
  ])[0];

  const data = {
    endpoint: subscription.endpoint,
    publicKey: key,
    authToken: token,
    contentEncoding,
  };
  const csrfToken = document
    .querySelector("meta[name=csrf-token]")
    .getAttribute("content");
  axios
    .post("/web-push", JSON.stringify(subscription), {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        "X-CSRF-Token": csrfToken,
      },
    })
    .then(() => {
      console.log("Subscription updated");
    });
}

function urlBase64ToUint8Array(base64String) {
  const padding = "=".repeat((4 - (base64String.length % 4)) % 4);
  const base64 = (base64String + padding).replace(/-/g, "+").replace(/_/g, "/");

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }

  return outputArray;
}
