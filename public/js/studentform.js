// ===============================
// Helpers
// ===============================
function showError(id, message) {
  const el = document.getElementById(id);
  if (el) el.textContent = message;
}

function clearError(id) {
  const el = document.getElementById(id);
  if (el) el.textContent = "";
}

function v(id) {
  const el = document.getElementById(id);
  return el ? el.value.trim() : "";
}

// ===============================
// FIELD VALIDATION (single field)
// ===============================
function validateField(field) {
  if (!field || !field.id) return true;

  const id = field.id;
  const value = v(id);
  let ok = true;

  switch (id) {
    // -------- STEP 1 --------
    case "dob": {
      if (!value) {
        showError("dob_error", "Date of birth is required.");
        ok = false;
      } else {
        const today = new Date();
        const birthDate = new Date(value);
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;

        if (isNaN(age)) {
          showError("dob_error", "Enter a valid date.");
          ok = false;
        } else if (age < 18) {
          showError("dob_error", "You must be at least 18 years old.");
          ok = false;
        } else {
          clearError("dob_error");
        }
      }
      break;
    }

    case "contact_no":
      if (!/^[0-9]{10}$/.test(value)) {
        showError(
          "contact_no_error",
          "Enter a valid 10-digit contact number."
        );
        ok = false;
      } else clearError("contact_no_error");
      break;

    case "address":
      if (!value) {
        showError("address_error", "Address is required.");
        ok = false;
      } else clearError("address_error");
      break;

    // -------- STEP 2 --------
    case "ssc_school":
      if (!value) {
        showError("ssc_school_error", "School name is required.");
        ok = false;
      } else clearError("ssc_school_error");
      break;

    case "ssc_board":
      if (!value) {
        showError("ssc_board_error", "Please select SSC board.");
        ok = false;
      } else clearError("ssc_board_error");
      break;

    case "ssc_percentage": {
      const p = parseFloat(value);
      if (isNaN(p) || p < 0 || p > 100) {
        showError(
          "ssc_percentage_error",
          "Enter SSC percentage between 0 and 100."
        );
        ok = false;
      } else clearError("ssc_percentage_error");
      break;
    }

    case "hsc_school":
      if (!value) {
        showError("hsc_school_error", "School name is required.");
        ok = false;
      } else clearError("hsc_school_error");
      break;

    case "hsc_board":
      if (!value) {
        showError("hsc_board_error", "Please select HSC board.");
        ok = false;
      } else clearError("hsc_board_error");
      break;

    case "hsc_percentage": {
      const p = parseFloat(value);
      if (isNaN(p) || p < 0 || p > 100) {
        showError(
          "hsc_percentage_error",
          "Enter HSC percentage between 0 and 100."
        );
        ok = false;
      } else clearError("hsc_percentage_error");
      break;
    }
  }

  return ok;
}

// ===============================
// LIVE VALIDATION (blur + input)
// ===============================
document.addEventListener(
  "blur",
  function (e) {
    const form = document.getElementById("student-form");
    if (!form) return;

    if (
      form.contains(e.target) &&
      ["INPUT", "SELECT", "TEXTAREA"].includes(e.target.tagName)
    ) {
      validateField(e.target);
    }
  },
  true
);

document.addEventListener("input", function (e) {
  const form = document.getElementById("student-form");
  if (!form) return;

  if (
    form.contains(e.target) &&
    ["INPUT", "SELECT", "TEXTAREA"].includes(e.target.tagName)
  ) {
    validateField(e.target);
  }
});

// ===============================
// RADIO (Gender) validation
// ===============================
document.addEventListener("change", function (e) {
  if (e.target.name === "gender") {
    clearError("gender_error");
  }
});

// ===============================
// STEP 1 VALIDATION
// ===============================
function validateStep1() {
  let valid = true;

  ["dob", "contact_no", "address"].forEach((id) => {
    const el = document.getElementById(id);
    if (el && !validateField(el)) valid = false;
  });

  const gender = document.querySelector('input[name="gender"]:checked');
  if (!gender) {
    showError("gender_error", "Please select gender.");
    valid = false;
  }

  return valid;
}

// ===============================
// STEP 2 VALIDATION
// ===============================
function validateStep2() {
  let valid = true;

  [
    "ssc_school",
    "ssc_board",
    "ssc_percentage",
    "hsc_school",
    "hsc_board",
    "hsc_percentage",
  ].forEach((id) => {
    const el = document.getElementById(id);
    if (el && !validateField(el)) valid = false;
  });

  return valid;
}

// ===============================
// STEP NAVIGATION (IMPORTANT)
// ===============================
document.addEventListener("DOMContentLoaded", function () {
  const step1 = document.getElementById("step-1");
  const step2 = document.getElementById("step-2");

  if (!step1 || !step2) return;

  step1.style.display = "block";
  step2.style.display = "none";

  document.getElementById("next-btn").onclick = function () {
    if (!validateStep1()) return; // ❌ BLOCK NEXT
    step1.style.display = "none";
    step2.style.display = "block";
  };

  document.getElementById("back-btn").onclick = function () {
    step2.style.display = "none";
    step1.style.display = "block";
  };
});

// ===============================
// FINAL SUBMIT GUARD
// ===============================
function validateStudentFormOnSubmit() {
  return validateStep1() && validateStep2();
}
