require("./bootstrap");
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

import axios from "axios";
import TimeAgo from "javascript-time-ago";
import en from "javascript-time-ago/locale/en.json";

TimeAgo.addDefaultLocale(en);
const timeAgo = new TimeAgo("en-US");

window.formatDateAsTimeAgo = (date) => {
  console.log(date);
  return timeAgo.format(Date.parse(date), "round");
};

//creates notification element and populates the passed parentElement
window.createNotifElement = (
  notification,
  parentElement,
  method = "append"
) => {
  let notifItem = document.createElement("a");
  notifItem.classList.add("notification-item");
  if (!notification.read_at) {
    notifItem.classList.add("unread");
  }
  notifItem.setAttribute("href", notification.data.url);
  notifItem.setAttribute("id", notification.id);

  let notifTitle = document.createElement("div");
  notifTitle.classList.add("notification-item-title");
  notifTitle.innerText = notification.data.title || "";

  let notifMessage = document.createElement("div");
  notifMessage.classList.add("notification-item-message");
  notifMessage.innerText = notification.data.message;

  let notifTime = document.createElement("div");
  notifTime.classList.add("notification-item-time");
  notifTime.innerText = formatDateAsTimeAgo(notification.created_at);

  notifItem.append(notifTitle, notifMessage, notifTime);

  if (method == "append") {
    console.log("pp");
    parentElement.appendChild(notifItem);
  } else {
    console.log("aa");
    parentElement.prepend(notifItem);
  }
};

let notifBadges = document.querySelectorAll(".notification-badge");
window.notificationChecked = (id) => {
  if (notifBadges[0]?.innerText != "" && notifBadges[0]?.innerText > 0) {
    axios.get("/admin/notification-check/" + id);
  }
};

// reset notification badge count
window.setNotificationBadgeCount = (count, method = "reset") => {
  for (let i = 0; i < notifBadges.length; i++) {
    let curCount = Number.parseInt(notifBadges[i].innerText);

    if (method === "reset") {
      notifBadges[i].innerText = count;
    } else {
      let newCount = curCount + count;
      notifBadges[i].innerText = newCount;
    }

    notifBadges[i].style.display = "none";
    if (count > 0) {
      notifBadges[i].style.display = "inline-block";
    }
  }
};

let disableScroll = false;
const dropdownNotificatioLoading = document.querySelector(
  "#dropdownNotificatioLoading"
);
window.loadNotifications = (
  skip,
  parentElement,
  notificationAddMethod = "append"
) => {
  dropdownNotificatioLoading.style.display = "block";
  axios
    .get(`/admin/notifications?skip=${skip}`)
    .then((res) => {
      res.data.notifications.forEach((el) => {
        // populate notifications dropdown
        createNotifElement(el, parentElement, notificationAddMethod);
      });

      if (res.data.notifications.length == 0) {
        disableScroll = true;
      }

      document.querySelector("#unreadCount").innerText = res.data.unread_count;
      setNotificationBadgeCount(res.data.uncheck_count);
    })
    .finally(() => {
      dropdownNotificatioLoading.style.display = "none";
    });
};

let notifSkip = 0;
let notifDropdownBody = document.querySelector(".notification-dropdown-body");
// get notifications
loadNotifications(notifSkip, notifDropdownBody);

//load more notification on scroll down
if (notifDropdownBody) {
  notifDropdownBody.onscroll = (ev) => {
    if (!disableScroll) {
      if (
        notifDropdownBody.scrollTop >=
        Math.floor(
          notifDropdownBody.scrollHeight - notifDropdownBody.offsetHeight
        )
      ) {
        let dropdownNotifCount =
          notifDropdownBody.querySelectorAll(".notification-item").length;
        loadNotifications(dropdownNotifCount, notifDropdownBody);
      }
    }
  };
}
