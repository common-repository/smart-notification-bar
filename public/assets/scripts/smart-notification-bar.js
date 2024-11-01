class epSmartNotificationBar {
  closeNotificationbar = (e) => {
    // remove notification bar
    document.getElementById(`ep_smart_notification_bar_root`).remove();
    // remove padding div
    document.getElementById(`ep-smart-notification-bar-padding-placeholder`).remove();

    if( ffNotificationBarPreviewId ){
      // don't set cookie on notificaiton bar preview
      return;
    }

    //set cookie if necessary
    let closedLifeTime = parseInt( e.target.dataset.lifetime ); // number of days the notification bar should stay closed
    let notificationBarId = e.target.dataset.id;
    let cookieLifeTime = 60 * 60 * 24 * 1000 * closedLifeTime;

    if( closedLifeTime ){
      let notificationBarCookieData = new Date();
      notificationBarCookieData.setTime(notificationBarCookieData.getTime() + cookieLifeTime);

      // set cookie
      document.cookie = `ep-notification-bar-cookie-${notificationBarId}=1; expires=${notificationBarCookieData.toGMTString()}; path=/; SameSite=Lax`;
    }
  }

  init = () => {
    /**
     * Check if notification bar is visible
     */
    const notificationBar = document.querySelector(`.ep-smart-notification-bar`);

    let notificationBarheight = 0;

    if( notificationBar ){
      let paddingPlaceholderAdded = false;
      let notificationBarPaddingDiv = document.getElementById(`ep-smart-notification-bar-padding-placeholder`);
      notificationBarheight = notificationBar.offsetHeight;

      if(notificationBarPaddingDiv){
        paddingPlaceholderAdded = true;
        notificationBarPaddingDiv.style.height = `${notificationBarheight}px`;
      } else {
        notificationBarPaddingDiv = document.createElement("div");
        notificationBarPaddingDiv.style.height = `${notificationBarheight}px`;
        notificationBarPaddingDiv.id = "ep-smart-notification-bar-padding-placeholder";
      }

      
      if( notificationBar.classList.contains("ep-smart-notification-bar--top") && !paddingPlaceholderAdded ){
        // create temp element an add it to the top of the body, why? to create additional padding
        document.body.prepend(notificationBarPaddingDiv);
        paddingPlaceholderAdded = true;
      }

      if( notificationBar.classList.contains("ep-smart-notification-bar--sticky") && notificationBar.classList.contains("ep-smart-notification-bar--bottom") && !paddingPlaceholderAdded ){
        // create temp element an add it to the bottom of the body, why? to create additional padding
        document.body.append(notificationBarPaddingDiv);
        paddingPlaceholderAdded = true;
      }

      const notificationBarCloseButton = document.querySelector(`.ep-smart-notification-bar__close`);
      if( notificationBarCloseButton ){
        notificationBarCloseButton.addEventListener("click", this.closeNotificationbar);
      }

    }

    // check if admin bar is visible
    const wpAdminBar = document.getElementById(`wpadminbar`);
    if( wpAdminBar && notificationBar ){
      notificationBar.style.marginTop = `${wpAdminBar.offsetHeight}px`;
    }
  }
}

const newSmartNotificationbar = new epSmartNotificationBar();

newSmartNotificationbar.init();

window.addEventListener("resize", () => {
  newSmartNotificationbar.init();
});