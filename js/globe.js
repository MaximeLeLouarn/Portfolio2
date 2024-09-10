document.addEventListener("DOMContentLoaded", function () {
  const jsonUrl = "wp-content/themes/portfoliomax/customgeo.json";
  const globeContainer = document.getElementById("globe-container");

  // Utility function to generate a valid hex color code
  function getRandomHexColor() {
    return `#${Math.floor(Math.random() * 0xffffff)
      .toString(16)
      .padStart(6, "0")}`;
  }

  // Utility function to calculate great-circle distance between two points
  function greatCircleDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Earth radius in km
    const dLat = ((lat2 - lat1) * Math.PI) / 180;
    const dLon = ((lon2 - lon1) * Math.PI) / 180;
    const a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos((lat1 * Math.PI) / 180) *
        Math.cos((lat2 * Math.PI) / 180) *
        Math.sin(dLon / 2) *
        Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
  }

  // Generate random arcs with start and end positions, ensuring they are within the constraints
  function generateRandomArcs(numArcs) {
    const arcs = [];
    const maxDistance = 20000; // Maximum distance in km, approx half the Earth's circumference

    for (let i = 0; i < numArcs; i++) {
      let startLat, startLng, endLat, endLng, distance;

      do {
        startLat = Math.random() * 180 - 90;
        startLng = Math.random() * 360 - 180;
        endLat = Math.random() * 180 - 90;
        endLng = Math.random() * 360 - 180;
        distance = greatCircleDistance(startLat, startLng, endLat, endLng);
      } while (distance > maxDistance);

      arcs.push({
        startLat,
        startLng,
        endLat,
        endLng,
        color: getRandomHexColor(),
        label: `Arc ${i + 1}`,
        altitude: Math.random() * 0.3 + 0.1, // Limit altitude between 0.1 and 0.4
        arcDashLength: 0, // Initially no dash visible
        arcDashInitialGap: 1, // Initially full gap (no arc visible)
      });
    }
    return arcs;
  }

  // Animate arcs by progressively revealing them
  function animateArcsDrawing(world, arcs, duration) {
    let startTime = Date.now();

    function animate() {
      let elapsedTime = Date.now() - startTime;
      let t = Math.min(elapsedTime / duration, 1); // Normalize t to be in range [0, 1]

      // Update arcs with interpolated dash length and altitude
      const newArcs = arcs.map((arc) => ({
        ...arc,
        arcDashLength: 0.35, // Show only the desired length of the arc at a time
        arcDashInitialGap: (1 - t) * 0.75, // Move the gap, making the arc seem to progress
        arcAltitude: Math.sin(t * Math.PI) * arc.altitude, // Smoothly increase altitude (peak at halfway)
      }));

      world.arcsData(newArcs);

      if (t < 1) {
        requestAnimationFrame(animate);
      } else {
        // Restart animation with new random arcs
        setTimeout(() => {
          animateArcsDrawing(world, generateRandomArcs(3), duration);
        }, 1000); // Wait for 1 second before restarting
      }
    }

    animate();
  }

  // Initialize globe with animated arcs
  function initializeGlobe() {
    fetch(jsonUrl)
      .then((res) => {
        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.json();
      })
      .then((countries) => {
        const world = Globe()
          .globeImageUrl(null) // Transparent background
          .backgroundColor("rgba(0,0,0,0)") // Transparent background
          .hexPolygonsData(countries.features)
          .hexPolygonResolution(3)
          .hexPolygonMargin(0.3)
          .hexPolygonUseDots(true)
          .hexPolygonColor(() => {
            const purpleShades = ["#8e44ad", "#9b59b6", "#6f42c1", "#af7ac5"];
            return purpleShades[
              Math.floor(Math.random() * purpleShades.length)
            ];
          })
          .arcsData(generateRandomArcs(3)) // Add initial random arcs
          .arcColor((arc) => arc.color)
          .arcAltitude((arc) => arc.altitude) // Control the arc height
          .arcDashLength((arc) => arc.arcDashLength)
          .arcDashGap(4) // Set dash gap size
          .arcDashInitialGap((arc) => arc.arcDashInitialGap)
          .arcStroke(0.5) // Set arc thickness
          .arcDashAnimateTime(5000) // Set dash animation time
          .arcCurveResolution(32) // Ensure smoother curves
          .arcLabel((arc) => arc.label)(globeContainer);

        // Animate arcs
        animateArcsDrawing(world, generateRandomArcs(3), 5000); // x arcs and x seconds duration for each animation

        // Set canvas size dynamically
        const canvas = globeContainer.querySelector("canvas");
        canvas.style.position = "absolute";
        canvas.style.overflow = "visible";

        function resizeCanvas() {
          const aspectRatio = 1; // For a square canvas, or adjust accordingly
          const width = globeContainer.offsetWidth;
          const height = width / aspectRatio;

          canvas.style.width = width + "px";
          canvas.style.height = height + "px";
        }

        resizeCanvas();
        window.addEventListener("resize", resizeCanvas);
      })
      .catch((error) => {
        console.error("Error loading or parsing JSON:", error);
      });
  }

  // Initialize globe
  initializeGlobe();
});
