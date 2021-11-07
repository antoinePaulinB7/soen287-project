window.addEventListener('DOMContentLoaded', (event) => {
  window.showIt = function() {
    document.querySelector("#theDetailedDescription").classList.remove("is-hidden");
  }
  window.hideIt = function() {
    document.querySelector("#theDetailedDescription").classList.add("is-hidden");
  }
});