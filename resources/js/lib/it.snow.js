// Create the <style> element
const styleElement = document.createElement('style');
styleElement.textContent = `
  .snow-container {
    position: fixed;
    width: 100%;
    max-width: 100%;
    z-index: 99999;
    pointer-events: none;
    overflow: hidden;
    top: 0;
    height: 100%;
  }
  .snow {
    display: block;
    position: absolute;
    z-index: 2;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    pointer-events: none;
    -webkit-transform: translate3d(0,-100%,0);
    transform: translate3d(0,-100%,0);
    -webkit-animation: snow linear infinite;
    animation: snow linear infinite;
  }
  .snow.foreground {
    background-image: url("https://itexpress.vn/API/files/img/snow-medium.png");
    -webkit-animation-duration: 15s;
    animation-duration: 10s;
  }
  .snow.foreground.layered {
    -webkit-animation-delay: 7.5s;
    animation-delay: 7.5s;
  }
  .snow.middleground {
    background-image: url("https://itexpress.vn/API/files/img/snow-medium.png");
    -webkit-animation-duration: 20s;
    animation-duration: 15s;
  }
  .snow.middleground.layered {
    -webkit-animation-delay: 10s;
    animation-delay: 10s;
  }
  .snow.background {
    background-image: url("https://itexpress.vn/API/files/img/snow-medium.png");
    -webkit-animation-duration: 25s;
    animation-duration: 20s;
  }
  .snow.background.layered {
    -webkit-animation-delay: 12.5s;
    animation-delay: 12.5s;
  }
  @-webkit-keyframes snow {
    0% { -webkit-transform: translate3d(0,-100%,0); transform: translate3d(0,-100%,0); }
    100% { -webkit-transform: translate3d(5%,100%,0); transform: translate3d(5%,100%,0); }
  }
  @keyframes snow {
    0% { -webkit-transform: translate3d(0,-100%,0); transform: translate3d(0,-100%,0); }
    100% { -webkit-transform: translate3d(5%,100%,0); transform: translate3d(5%,100%,0); }
  }
`;

// Append the <style> element to the <head>
document.head.appendChild(styleElement);

// Create the snow container div
const snowContainer = document.createElement('div');
snowContainer.className = 'snow-container';
snowContainer.innerHTML = `
  <div class="snow foreground"></div>
  <div class="snow foreground layered"></div>
  <div class="snow middleground"></div>
  <div class="snow middleground layered"></div>
  <div class="snow background"></div>
  <div class="snow background layered"></div>
`;

// Append the snow container to the body
document.body.appendChild(snowContainer);
