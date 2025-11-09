function toggleAddForm() {
  var form = document.getElementById("add_shipment_form");
  if (form.style.display === "block" || form.classList.contains("d-block")) {
    form.style.display = "none";
    form.classList.remove("d-block");
  } else {
    form.style.display = "block";
    form.classList.add("d-block");
    // Scroll to form for better UX
    form.scrollIntoView({ behavior: "smooth" });
  }
}

function toggleHistory(historyId) {
  var historyContent = document.getElementById(historyId);
  var historyHeader = historyContent.previousElementSibling;
  var icon = historyHeader.querySelector("i");

  if (
    historyContent.style.display === "block" ||
    historyContent.classList.contains("d-block")
  ) {
    historyContent.style.display = "none";
    historyContent.classList.remove("d-block");
    icon.className = "fa fa-chevron-down me-2";
  } else {
    historyContent.style.display = "block";
    historyContent.classList.add("d-block");
    icon.className = "fa fa-chevron-up me-2";
    // Scroll to history section for better UX
    historyContent.scrollIntoView({ behavior: "smooth", block: "nearest" });
  }
}

function togglePayment(paymentId) {
  var paymentContent = document.getElementById(paymentId);
  var paymentHeader = paymentContent.previousElementSibling;
  var icon = paymentHeader.querySelector("i");

  if (
    paymentContent.style.display === "block" ||
    paymentContent.classList.contains("d-block")
  ) {
    paymentContent.style.display = "none";
    paymentContent.classList.remove("d-block");
    icon.className = "fa fa-chevron-down me-2";
  } else {
    paymentContent.style.display = "block";
    paymentContent.classList.add("d-block");
    icon.className = "fa fa-chevron-up me-2";
    // Scroll to payment section for better UX
    paymentContent.scrollIntoView({ behavior: "smooth", block: "nearest" });
  }
}

function toggleWalletSection() {
  var walletContent = document.getElementById("wallet_content");
  var walletHeader = document.querySelector(".wallet-header");
  var icon = walletHeader.querySelector("i");

  if (
    walletContent.style.display === "block" ||
    walletContent.classList.contains("d-block")
  ) {
    walletContent.style.display = "none";
    walletContent.classList.remove("d-block");
    icon.className = "fa fa-chevron-down me-2";
  } else {
    walletContent.style.display = "block";
    walletContent.classList.add("d-block");
    icon.className = "fa fa-chevron-up me-2";
    // Scroll to wallet section for better UX
    document
      .getElementById("wallet_section")
      .scrollIntoView({ behavior: "smooth" });
  }
}

function editWallet(id) {
  // This would typically make an AJAX call to get wallet details
  // For now, we'll just show a placeholder implementation
  document.getElementById("wallet_form_title").textContent =
    "Edit Wallet Address";
  document.getElementById("wallet_id").value = id;

  // Scroll to the form
  document
    .getElementById("wallet_content")
    .scrollIntoView({ behavior: "smooth" });
}

function resetWalletForm() {
  document.getElementById("wallet_form_title").textContent =
    "Add New Wallet Address";
  document.getElementById("wallet_id").value = "";
  document.querySelector('form[name="wallet_form"]').reset();
}

// Make shipment cards editable on double click
document.addEventListener("DOMContentLoaded", function () {
  var cards = document.querySelectorAll(".shipment-card");
  cards.forEach(function (card) {
    card.addEventListener("dblclick", function () {
      this.classList.toggle("edit-mode");
    });
  });

  // Update progress bar when input changes
  var progressInputs = document.querySelectorAll('input[name="perc"]');
  progressInputs.forEach(function (input) {
    input.addEventListener("input", function () {
      var progressBar = this.parentNode.querySelector(".shipment-progress-bar");
      if (progressBar) {
        progressBar.style.width = this.value + "%";
      }
    });
  });

  // Additional fix for mobile devices
  if (
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
      navigator.userAgent
    )
  ) {
    document.querySelectorAll("select").forEach(function (select) {
      select.addEventListener("focus", function () {
        // On mobile, ensure the dropdown doesn't resize the page
        document.body.style.overflow = "hidden";
      });

      select.addEventListener("blur", function () {
        document.body.style.overflow = "";
      });
    });
  }
});
