require("./bootstrap");
window.bootstrap = require("bootstrap");
window.Quill = require("quill");
window.Swal = require("sweetalert2");

const body = document.body;
const sidebarToggle = document.querySelector("#sidebarToggle");
sidebarToggle?.addEventListener("click", () => {
  let windowWidth = window.innerWidth;
  if (windowWidth >= 992) {
    if (body.classList.contains("sidebar-closed")) {
      body.classList.remove("sidebar-closed");
      body.classList.add("sidebar-open");
    } else {
      body.classList.add("sidebar-closed");
      body.classList.remove("sidebar-open");
    }
  } else {
    if (body.classList.contains("sidebar-open")) {
      body.classList.remove("sidebar-open");
      body.classList.add("sidebar-closed");
    } else {
      body.classList.remove("sidebar-closed");
      body.classList.add("sidebar-open");
    }
  }
});

const sidebarClose = document.querySelector("#sidebarClose");
sidebarClose?.addEventListener("click", () => {
  body.classList.remove("sidebar-open");
  body.classList.add("sidebar-closed");
});

window.showFlashMessage = (
  title = "",
  message = "Hello",
  variant = "success"
) => {
  let msgElement = document.createElement("div");
  msgElement.classList.add("flash-message");
  msgElement.classList.add(variant);

  let msgTitle = document.createElement("div");
  msgTitle.classList.add("flash-message-title");
  msgTitle.textContent = title;

  let msgBody = document.createElement("div");
  msgBody.classList.add("flash-message-body");
  msgBody.textContent = message;

  msgElement.appendChild(msgTitle);
  msgElement.appendChild(msgBody);
  body.appendChild(msgElement);

  setTimeout(function () {
    let fadeEffect = setInterval(function () {
      if (!msgElement.style.opacity) {
        msgElement.style.opacity = 0.9;
      }
      if (msgElement.style.opacity > 0) {
        msgElement.style.opacity -= 0.01;
      } else {
        msgElement.remove();
        clearInterval(fadeEffect);
      }
    }, 20);
  }, 3000);
};

import TimeAgo from "javascript-time-ago";
import en from "javascript-time-ago/locale/en.json";

TimeAgo.addDefaultLocale(en);
const timeAgo = new TimeAgo("en-US");

window.formatDateAsTimeAgo = (date) => {
  console.log(date);
  return timeAgo.format(Date.parse(date), "round");
};

//creates notification item and populates the passed parentElement
window.createNotifElement = (notifications, parentElement) => {
  let notifItem = document.createElement("a");
  notifItem.classList.add("notification-item");
  if (!notifications.read_at) {
    notifItem.classList.add("unread");
  }
  notifItem.setAttribute("href", notifications.data.url);
  notifItem.setAttribute("id", notifications.id);

  let notifTitle = document.createElement("div");
  notifTitle.classList.add("notification-item-title");
  notifTitle.innerText = notifications.data.title || "";

  let notifMessage = document.createElement("div");
  notifMessage.classList.add("notification-item-message");
  notifMessage.innerText = notifications.data.message;

  notifItem.append(notifTitle, notifMessage);
  parentElement.prepend(notifItem);
};

window.notificationChecked = (id) => {
  axios.post("/admin/notification-check/" + id);
};

// reset notification badge count
window.setNotificationBadgeCount = (count, method = "reset") => {
  let notifBadges = document.querySelectorAll("notification-badge");
  for (let i = 0; i < notifBadges.length; i++) {
    notifBadges[i].innerText = count;

    notifBadges[i].style.display = "none";
    if (count > 0) {
      notifBadges[i].style.display = "inline-block";
    }
  }
};
