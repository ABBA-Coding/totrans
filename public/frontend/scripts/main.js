$(document).ready(function () {
  if (document.querySelector(".header")) {
    const headerBurger = document.querySelector(".header-burger");
    const menu = document.querySelector(".menu");
    const menuClose = document.querySelector(".menu-close");

    headerBurger.addEventListener("click", () => {
      menu.classList.toggle("open");
    });

    menuClose.addEventListener("click", () => {
      menu.classList.remove("open");
    });
  }

  if (document.querySelector(".language")) {
    let intervalId;
    document.querySelectorAll(".language-toggle").forEach((e) => {
      e.addEventListener("click", (e) => {
        const menu = e.currentTarget.dataset.path;
        document.querySelectorAll(".language-list").forEach((e) => {
          if (
            !document
              .querySelector(`[data-target=${menu}]`)
              .classList.contains("open")
          ) {
            intervalId = setTimeout(() => {
              !document
                .querySelector(`[data-target=${menu}]`)
                .classList.add("open");
            }, 0);
          }
          if (
            document
              .querySelector(`[data-target=${menu}]`)
              .classList.contains("open")
          ) {
            clearTimeout(intervalId);

            intervalId = setTimeout(() => {
              document
                .querySelector(`[data-target=${menu}]`)
                .classList.remove("open");
            });
          }
          window.onclick = (e) => {
            if (
              e.target === document.querySelector(`[data-target=${menu}]`) ||
              e.target === document.querySelector(`[data-path=${menu}]`)
            ) {
              return true;
            } else {
              document
                .querySelector(`[data-target=${menu}]`)
                .classList.remove("open");
            }
          };
        });
      });
    });
  }

  if (document.querySelector(".select2_cus")) {
    let selects = document.querySelectorAll(".select2_cus");
    selects.forEach((select) => {
      $(select).select2({
        dropdownParent: select.parentNode,
        width: "100%",
      });
    });
  }
});
