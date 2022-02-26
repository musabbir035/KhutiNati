self.addEventListener("push", (e) => {
  const data = e.data.json();
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
    switch (event.action) {
      case "view_app":
        clients.openWindow(event.notification.data.url);
        break;
    }
  },
  false
);
