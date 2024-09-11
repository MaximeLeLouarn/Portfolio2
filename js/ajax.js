jQuery(document).ready(function ($) {
  // Define AJAX URL
  const ajaxurl = "./wp-admin/admin-ajax.php";

  // Fetch content on swiper-slide click
  $(".swiper-slide").on("click", function (e) {
    e.preventDefault();

    // Get post ID from clicked element
    let skillName = $(this).data("skilln");

    // AJAX call to fetch the content
    $.ajax({
      url: ajaxurl,
      type: "POST",
      dataType: "html",
      data: {
        action: "fetch_scallop_content",
        skilln: skillName,
      },
      success: function (res) {
        // Load content into lightbox and show it
        $("#lightboxContent").html(res);
        $("#customLightbox").fadeIn();
      },
      error: function (error) {
        console.log("Error fetching content: ", error);
      },
    });
  });

  // Close lightbox when clicking on the close button
  $(".lightboxClose").on("click", function () {
    $("#customLightbox").fadeOut();
  });

  // Close lightbox when clicking outside of the content area
  $(document).on("click", function (event) {
    if (
      $(event.target).closest("#lightboxContent").length === 0 &&
      !$(event.target).hasClass("swiper-slide")
    ) {
      $("#customLightbox").fadeOut();
    }
  });

  // Initialize variables for filters and pagination
  let currentPage = 1;
  let currentProjectType = "all";
  const arrow = document.querySelectorAll(".arrow");
  const dropdownButtonTextCat = document.querySelector(
    ".dropdownButtonTextCat"
  );
  const projectTypeFilterLink = document.querySelectorAll(".projectTypeFilter");

  // Reinitialize lazy loading for new images after AJAX
  function reinitializePlugins() {
    document.querySelectorAll(".imgPostItem").forEach((img) => {
      if (
        !img.classList.contains("lazyloaded") &&
        !img.classList.contains("notLazy")
      ) {
        img.classList.add("lazyload");
      }
    });

    if (typeof lazySizes !== "undefined") {
      lazySizes.init();
    }
  }

  // Apply filters via AJAX
  function applyFilters() {
    currentPage = 1;
    console.log("Applying filters with:", {
      currentProjectType,
      currentPage,
    });

    $.ajax({
      type: "POST",
      url: ajaxurl,
      dataType: "json", // Expect JSON response for consistency
      data: {
        action: "filter_custom_posts_ajax",
        projecttype: currentProjectType,
        paged: currentPage,
      },
      success: function (res) {
        console.log("AJAX response:", res);
        $(".publicationList").html(res.html);

        if ($(".publicationList").children().length < 1) {
          $("#loadMore").hide();
        } else {
          $("#loadMore").show();
        }
        reinitializePlugins();
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      },
    });
  }

  // Function to reset the dropdown UI state
  function resetDropdowns() {
    dropdownContent.forEach((content) =>
      content.classList.remove("activeBlock")
    );
    dropdownButton.forEach((button) =>
      button.classList.remove("buttonBorderStyle")
    );
    arrow.forEach((arrow) => (arrow.innerHTML = "&#9660;"));
  }

  // Set up filter buttons click events
  projectTypeFilterLink.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      currentProjectType = event.target.dataset.projecttype;

      if (currentProjectType === "all") {
        dropdownButtonTextCat.innerHTML = `Catégorie <span class="arrow">&#9660;</span>`;
      } else {
        dropdownButtonTextCat.innerHTML = `${event.target.textContent} <span class="arrow">&#9660;</span>`;
      }

      resetDropdowns();
      applyFilters();
    });
  });

  // Load more posts when the button is clicked
  $("#loadMore").on("click", function (event) {
    event.preventDefault();
    currentPage++;

    $.ajax({
      type: "POST",
      url: ajaxurl,
      dataType: "json", // Expect JSON response
      data: {
        action: "load_more_mockups",
        projecttype: currentProjectType,
        paged: currentPage,
      },
      success: function (res) {
        console.log("Load More Response:", res);

        if (res.max && currentPage >= res.max) {
          $("#loadMore").hide();
        }
        $(".publicationList").append(res.html);
        reinitializePlugins();
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error during Load More:", status, error);
      },
    });
  });
});
