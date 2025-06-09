window.addEventListener("DOMContentLoaded", (event) => {
  // Simple-DataTables
  // https://github.com/fiduswriter/Simple-DataTables/wiki

  const datatablesSimple = document.getElementById("datatablesSimple");
  if (datatablesSimple) {
    const dataTable = new simpleDatatables.DataTable(datatablesSimple, {
      searchable: true, // Enable global search for the table
      perPage: 10, // Set the default number of rows per page
      perPageSelect: [5, 10, 25, 50, 100], // Allow users to select rows per page
      pagination: true, // Enable pagination
      responsive: true, // Make the table responsive on smaller screens
    });

    // Optional: Adding an event listener for empty state (if no data found)
    const emptyState = document.createElement("tr");
    datatablesSimple.querySelector("tbody").appendChild(emptyState);
  }
});
