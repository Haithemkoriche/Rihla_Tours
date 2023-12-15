</div>
   
   <!-- Include Bootstrap JS, Popper.js, and Custom JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Toggle sidebar when the menu icon is clicked
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').removeClass('active');
            });
            
            // Close the sidebar when the close button is clicked
            $('#closeSidebar').on('click', function() {
                $('#sidebar').removeClass('active');
                $('#content').toggleClass('active');
            });
        });
    </script>
</body>

</html>
