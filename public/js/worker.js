self.addEventListener("push", (e) => {
  const data = e.data.json();
  console.log("Push received " + data + "  ssss");
  console.log(JSON.stringify(data));
  self.registration.showNotification(data.title, {
    body: data.body,
    icon: data.icon,
    actions: data.actions,
    data: { url: data.data.url },
  });
});

self.addEventListener(
  "notificationclick",
  function (event) {
    console.log("Notification clicked");
    console.log(JSON.stringify(event));
    switch (event.action) {
      case "view_app":
        clients.openWindow(event.notification.data.url);
        break;
    }
  },
  false
);
