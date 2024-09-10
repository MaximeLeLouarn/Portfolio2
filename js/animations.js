// The Bubbles
function createBubble() {
  const bubbleSection = document.querySelector(".bubblesbgc");
  const createElement = document.createElement("span");
  const getTheBubbles = document.querySelectorAll(".elevateBubbles");
  // Math.random is a static ethod that returns a floating point,
  // pseudo-random number that's greater than or equal to 0 and less than 1.
  let size = Math.random() * 60;

  createElement.classList.add("elevateBubbles");
  createElement.style.width = 20 + size + "px";
  createElement.style.height = 20 + size + "px";
  createElement.style.left = Math.random() * innerWidth + "px";
  createElement.style.pointerEvents = "auto"; // Ensures bubble can be hovered over

  // Add event listener to pop bubble on mouseenter
  createElement.addEventListener("mouseenter", function () {
    // Add the pop class to trigger the explode animation
    this.classList.add("pop");

    // Remove bubble after the animation
    setTimeout(() => {
      this.remove();
    }, 1000); // Match this duration with the transition time
  });

  bubbleSection.appendChild(createElement);

  setTimeout(() => {
    createElement.remove();
  }, 12000);
}

setInterval(createBubble, 500);
