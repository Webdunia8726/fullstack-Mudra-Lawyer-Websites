<?php
include 'includes/db.php'; // Include database connection

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch blog details from the database
    $sql = "SELECT title, image, paragraph FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $image, $paragraph);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Blog not found!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Blog</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
     
     /* General page styling */

     

/* Container for the blog details */
.blog-details-container {
    background-color: #fff;

    border-radius: 8px;
    max-width: 1200px;
    margin: 40px 20px;
    padding: 20px;
    animation: fadeIn 0.7s ease-in-out;
}

/* Blog header styles */
.blog-header h1 {
    font-size: 32px;
    color: #333;
    margin-bottom: 10px;
    text-align: center;
}

.blog-meta {
    font-size: 14px;
    color: #888;
    text-align: center;
    margin-bottom: 20px;
}

/* Blog image styling */

/* Blog image styling */
.blog-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 20px;
    display: block; /* Make the image a block element */
    margin-left: auto; /* Automatically adjust the left margin */
    margin-right: auto; /* Automatically adjust the right margin */
}


/* Blog content styling */
.blog-content p {
    font-size: 18px;
    line-height: 1.6;
    color: #444;
    margin-bottom: 30px;

}

/* Blog footer with the back button */
.blog-footer {
    text-align: center;
}

.back-button {
    text-decoration: none;
    color: #fff;
    background-color: #3498db;
    padding: 12px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 16px;
}

/* Hover effect for the back button */
.back-button:hover {
    background-color: #2980b9;
}

/* Smooth fade-in animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Media query for responsive design */
@media (max-width: 768px) {
    .blog-header h1 {
        font-size: 26px;
    }

    .blog-content p {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .blog-details-container {
        margin: 20px;
        padding: 15px;
    }

    .back-button {
        font-size: 14px;
        padding: 10px 15px;
    }
}

    </style>
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">
    <img src="assets/images/logolayer.png" alt="Logo" class="img-fluid logo">
    <span class="logotext ms-2">Mudra Legal</span> <!-- Adds spacing next to the logo -->

    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
       
        
      
          
      
    </div>
  </div>
</nav>

<div class="blog-details-container">
    <div class="blog-header">
        <h1><?php echo $title; ?></h1>
        <p class="blog-meta">Published on: <?php echo date('F d, Y'); ?></p>
    </div>

    <div class="blog-image">
        <img src="uploads/<?php echo $image; ?>" alt="Blog Image">
    </div>

    <div class="blog-content">
        <p><?php echo nl2br($paragraph); ?></p>
    </div>

    <div class="blog-footer">
        <a href="blog.php" class="back-button">← Back to Blog</a>
    </div>
</div>


<!-- watsapp button start -->
 <!-- WhatsApp Button -->
 <a href="https://wa.link/ta23rp" class="whatsapp-button" target="_blank" title="Contact us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Call Button -->
<a href="tel:+91 99194 60444" class="call-button" title="Call us">
    <i class="fas fa-phone-alt"></i>
</a>

 <!-- watsapp button end -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
