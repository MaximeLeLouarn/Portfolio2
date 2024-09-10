jQuery(document).ready(function ($) {
  $(".swiper-slide").on("click", function (e) {
    e.preventDefault();

    // Get post ID from clicked element
    let skillName = $(this).data("skilln");
    console.log($(this));
    console.log(skillName);

    // AJAX call to fetch the content
    $.ajax({
      url: "./wp-admin/admin-ajax.php",
      type: "POST",
      dataType: "html",
      data: {
        action: "fetch_scallop_content",
        skilln: skillName,
      },
      success: function (res) {
        // Load content into lightbox and show it
        console.log("Response from server:", res);
        $("#lightboxContent").html(res);
        $("#customLightbox").fadeIn();
        console.log(skillName);
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
      $(event.target).closest(".lightboxContent").length === 0 &&
      !$(event.target).hasClass("swiper-slide")
    ) {
      $("#customLightbox").fadeOut();
    }
  });
});
