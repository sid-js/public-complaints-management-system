$(document).ready(function () {
  var page = 1;
  var resultsPerPage = 6; // Number of complaints per page

  // Function to fetch complaints from the server
  function fetchComplaints() {
    $.ajax({
      url: 'fetch-complaints.php',
      method: 'GET',
      data: { page: page, resultsPerPage: resultsPerPage },
      dataType: 'json',
      success: function (response) {
        $('#complaints-container').append(response.html);
        page++;
        if (!response.hasMore) {
          $('#load-more-container').hide();
        }
      },
      error: function (xhr, status, error) {
        console.error('Error fetching complaints:', error);
      },
    });
  }

  // Initial fetch of complaints when the page loads
  fetchComplaints();

  // Load more button click event
  $('#load-more-btn').click(function () {
    fetchComplaints();
  });
});
