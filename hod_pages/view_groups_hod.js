// JavaScript to show/hide groups based on filter selection

document.getElementById("groupFilter").addEventListener("change", function () {
  const selectedGroup = this.value;
  const groups = document.querySelectorAll(".enrollemt");

  if (selectedGroup === "all") {
    groups.forEach((group) => (group.style.display = "block"));
  } else {
    groups.forEach((group) => (group.style.display = "none"));
    document.getElementById(selectedGroup).style.display = "block";
  }
});
