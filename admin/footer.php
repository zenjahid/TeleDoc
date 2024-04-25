<div style="position: fixed; top: 20px; right: 20px;">
    <button id="darkModeToggle" class="btn btn-secondary">Dark Mode</button>
    <div class="mt-2">
    <a href="profile.php" class="btn btn-primary d-block mb-2">Home</a>    
    <a href="add_doc.php" class="btn btn-primary d-block mb-2">Add Doctor</a>
        <a href="doc_list.php" class="btn btn-success d-block">Doctor List</a>
        
    </div>
</div>

<script>
    // Dark mode toggle functionality
    document.getElementById('darkModeToggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
</script>
</body>
</html>
