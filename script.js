document.addEventListener('DOMContentLoaded', function () {
  let currentlyOpenMenu = null;

  function createToggleMenu(parentId, childId) {
    const parent = document.getElementById(parentId);
    const child = document.getElementById(childId);

    if (!parent || !child) {
      console.warn(
        `Parent or child element not found: ${parentId}, ${childId}`
      );
      return;
    }

    function showChild() {
      if (currentlyOpenMenu && currentlyOpenMenu !== child) {
        hideChild(currentlyOpenMenu);
      }
      child.style.opacity = '1';
      child.style.visibility = 'visible';
      currentlyOpenMenu = child;
    }

    function hideChild(menu = child) {
      menu.style.opacity = '0';
      menu.style.visibility = 'hidden';
      if (menu === currentlyOpenMenu) {
        currentlyOpenMenu = null;
      }
    }

    parent.addEventListener('click', function (e) {
      e.stopPropagation();
      if (child.style.opacity === '1') {
        hideChild();
      } else {
        showChild();
      }
    });

    child.addEventListener('click', function (e) {
      e.stopPropagation();
    });

    document.addEventListener('click', function (e) {
      if (!parent.contains(e.target)) {
        hideChild();
      }
    });
  }

  createToggleMenu('user', 'user-menu');
  createToggleMenu('cart', 'cart-menu');
});
