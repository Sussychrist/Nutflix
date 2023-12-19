<?php 
include('../config/dbcon.php');
include('../functions/myfunctions.php');
if (isset($_POST['add_genre_btn'])) 
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    // File upload handling
    $image = $_FILES['image'];
    $path = "../uploads/genre/";

    // Check for errors during file upload
    if ($image['error'] === UPLOAD_ERR_OK) 
    {
        $image_ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;

        // Limit file types and size
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $max_file_size = 10 * 1024 * 1024; // 10 MB

        
        if (in_array($image_ext, $allowed_extensions) && $image['size'] <= $max_file_size) 
        {
            // Move the uploaded file to the destination
            if (move_uploaded_file($image['tmp_name'], $path . $filename)) 
            {
                // Use a prepared statement to insert data
                $genre_query = "INSERT INTO genre (name, slug, description, img) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $genre_query);

                if ($stmt)
                {
                    mysqli_stmt_bind_param($stmt, "ssss", $name, $slug, $description, $filename);
                    $insert_success = mysqli_stmt_execute($stmt);
                    
                    if ($insert_success) 
                    {
                        // Success: Category added, and image uploaded
                        redirect("genre.php", "Genre Added Successfully");
                    } else {
                        // Database error
                        redirect("add-genre.php", "Database error: " . mysqli_error($con));
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    // Statement preparation error
                    redirect("add-genre.php", "Statement preparation error: " . mysqli_error($con));
                }
            } else {
                // Failed to move the uploaded image
                redirect("add-genre.php", "Failed to upload the image");
            }
        } else {
            // Invalid file format or size
            redirect("add-genre.php", "Invalid file format or size. Please upload a valid image (JPG, JPEG, PNG, GIF, max 10 MB).");
        }
    } else {
        // Error during file upload
        redirect("add-genre.php", "Error uploading the image: " . $image['error']);
    }
}
if (isset($_POST['update_genre_btn'])) 
{
    $genre_id = mysqli_real_escape_string($con,$_POST['genre_id']);
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $slug = mysqli_real_escape_string($con,$_POST['slug']);
    $description = mysqli_real_escape_string($con,$_POST['description'] );

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    $path = "../uploads/genre/";


    if ($new_image != "") 
    {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else 
    {
        $update_filename = $old_image;
    }

    $update_genre_query = "UPDATE genre SET name = ?, slug = ?, description = ?, img = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($con, $update_genre_query);
    
    if ($stmt) 
    {
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $slug, $description, $new_image, $genre_id);
        $update_genre_query_run = mysqli_stmt_execute($stmt);
        
        if ($update_genre_query_run) 
        {
            if ($new_image != "") 
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $new_image);
                
                if (file_exists("../uploads/genre/" . $old_image)) 
                {
                    unlink("../uploads/genre/" . $old_image);
                }
            }
            redirect("genre.php", "Genre updated successfully");
        } else {
            redirect("edit-genre.php?id=$genre_id", "Database error: " . mysqli_error($con));
        }
        
        mysqli_stmt_close($stmt);
    } else {
        redirect("edit-genre.php?id=$genre_id", "Database error: " . mysqli_error($con));
    }
}
else if (isset($_POST['delete_genre_btn'])) 
{
    $genre_id = mysqli_real_escape_string($con, $_POST['genre_id']);

    $genre_query = "SELECT img FROM genre WHERE id='$genre_id'";
    $genre_query_run = mysqli_query($con, $genre_query);

    if (mysqli_num_rows($genre_query_run) > 0) 
    {
        $genre_data = mysqli_fetch_array($genre_query_run);
        $image = $genre_data['img'];

        $delete_genre_query = "DELETE FROM genre WHERE id = '$genre_id'";
        $delete_genre_query_run = mysqli_query($con, $delete_genre_query);

        if ($delete_genre_query_run) {
            if (file_exists("../uploads/genre/" . $image)) 
            {
                unlink("../uploads/genre/" . $image);
            }
            echo 200; 
        } else {
            echo 500; 
        }
    } else {
        echo 404;
    }
}
else if (isset($_POST['add_region_btn'])) 
{
    $name = mysqli_real_escape_string($con, $_POST['name']);

    $image = $_FILES['image'];
    $path = "../uploads/flags/";

    if ($image['error'] === UPLOAD_ERR_OK) 
    {
        $image_ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;

        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $max_file_size = 10 * 1024 * 1024; // 10 MB
       
        if (in_array($image_ext, $allowed_extensions) && $image['size'] <= $max_file_size) 
        {
            if (move_uploaded_file($image['tmp_name'], $path . $filename)) 
            {
                $region_query = "INSERT INTO countries (name, flag) VALUES (?, ?)";
                $stmt = mysqli_prepare($con, $region_query);

                if ($stmt) 
                {
                    mysqli_stmt_bind_param($stmt, "ss", $name, $filename);
                    $insert_success = mysqli_stmt_execute($stmt);
                    
                    if ($insert_success) 
                    {
                        redirect("add-country.php", "Region Added Successfully");
                    } else 
                    {
                        redirect("add-country.php", "Database error: " . mysqli_error($con));
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    redirect("add-country.php", "Statement preparation error: " . mysqli_error($con));
                }
            } else {
                redirect("add-country.php", "Failed to upload the image");
            }
        } else {
            redirect("add-country.php", "Invalid file format or size. Please upload a valid image (JPG, JPEG, PNG, GIF, max 10 MB).");
        }
    } else {
        redirect("add-country.php", "Error uploading the image: " . $image['error']);
    }
}
else if (isset($_POST['delete_region_btn'])) 
{
    $region_id = mysqli_real_escape_string($con, $_POST['countries_id']);

    $region_query = "SELECT flag FROM countries WHERE id='$region_id'";
    $region_query_run = mysqli_query($con, $region_query);

    if (mysqli_num_rows($region_query_run) > 0) 
    {
        $region_data = mysqli_fetch_array($region_query_run);
        $image = $region_data['flag'];

        $delete_region_query = "DELETE FROM countries WHERE id = '$region_id'";
        $delete_region_query_run = mysqli_query($con, $delete_region_query);

        if ($delete_region_query_run) 
        {
            if (file_exists("../uploads/flags/" . $image)) 
            {
                unlink("../uploads/flags/" . $image);
            }
            echo 200; // Deletion success
        } else {
            echo 500; 
        }
    } else {
        echo 404; 
    }
}
else if (isset($_POST['add_popularity_btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);

    $popularity_query = "INSERT INTO popularity (name) VALUES (?)";
    $stmt = mysqli_prepare($con, $popularity_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $name);
        $insert_success = mysqli_stmt_execute($stmt);
        
        if ($insert_success) {
            redirect("popularity.php", "Popularity Status Added Successfully");
        } else {
            redirect("add-popularity.php", "Database error: " . mysqli_error($con));
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("add-popularity.php", "Statement preparation error: " . mysqli_error($con));
    }
}
else if (isset($_POST['update_popularity_btn'])) {
    $id = mysqli_real_escape_string($con, $_POST['popularity_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);

    $update_popularity_query = "UPDATE popularity SET name = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $update_popularity_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        $update_success = mysqli_stmt_execute($stmt);

        if ($update_success) {
            redirect("popularity.php", "Popularity status updated Successfully");
        } else {
            redirect("edit-popularity.php", "Database error: " . mysqli_error($con));
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("edit-popularity.php", "Statement preparation error: " . mysqli_error($con));
    }
}
else if (isset($_POST['delete_popularity_btn'])) 
{
    $popularity_id = mysqli_real_escape_string($con, $_POST['popularity_id']);

    $popularity_query = "SELECT name FROM popularity WHERE id='$popularity_id'";
    $popularity_query_run = mysqli_query($con, $popularity_query);

    if (mysqli_num_rows($popularity_query_run) > 0) 
    {
        $popularity_data = mysqli_fetch_array($popularity_query_run);

        $delete_popularity_query = "DELETE FROM popularity WHERE id = '$popularity_id'";
        $delete_popularity_query_run = mysqli_query($con, $delete_popularity_query);

        if ($delete_popularity_query_run) 
        {
            echo 200; 
        } else {
            echo 500; 
        }
    } else {
        echo 404; 
    }
}
else if (isset($_POST['add_movie_btn'])) 
{
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $tags = mysqli_real_escape_string($con, $_POST['tags']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $release_year = mysqli_real_escape_string($con, $_POST['release_year']);
    $actor = mysqli_real_escape_string($con, $_POST['actor']);
    $director = mysqli_real_escape_string($con, $_POST['director']);
    $subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $score = mysqli_real_escape_string($con, $_POST['score']);
    $video = mysqli_real_escape_string($con, $_POST['video']);
    $trailer = mysqli_real_escape_string($con, $_POST['trailer']);

    $content_type_id = mysqli_real_escape_string($con, $_POST['content_type_id']);
    $status_id = mysqli_real_escape_string($con, $_POST['status_id']);
    $popularity_id = mysqli_real_escape_string($con, $_POST['pop_id']);

    $quality_ids = isset($_POST['quality_id']) ? $_POST['quality_id'] : [];
    $genre_ids = isset($_POST['genre_id']) ? $_POST['genre_id'] : [];
    $country_ids = isset($_POST['countries_id']) ? $_POST['countries_id'] : [];

    $image = $_FILES['image'];
    $image_ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $image_filename = time() . '.' . $image_ext;
    $image_upload_path = "../uploads/movies_poster/" . $image_filename;

    $wallpaper = $_FILES['wallpaper'];
    $wallpaper_ext = pathinfo($wallpaper['name'], PATHINFO_EXTENSION);
    $wallpaper_filename = time() . '.' . $wallpaper_ext;
    $wallpaper_upload_path = "../uploads/wallpaper/" . $wallpaper_filename;

    $image_upload_error = $image['error'];
    $wallpaper_upload_error = $wallpaper['error'];

    if ($image_upload_error === UPLOAD_ERR_OK && $wallpaper_upload_error === UPLOAD_ERR_OK) {
        // Move the uploaded files to their respective paths
        $image_upload_success = move_uploaded_file($image['tmp_name'], $image_upload_path);
        $wallpaper_upload_success = move_uploaded_file($wallpaper['tmp_name'], $wallpaper_upload_path);
    
        if ($image_upload_success && $wallpaper_upload_success) {
            // Use prepared statements to prevent SQL injection
            $add_movie_query = "INSERT INTO content (title, slug, tags, release_year, description, actor, director, subtitle, duration, score, img, wallpaper, video_url, trailer_url, status_id, popularity_id, content_type_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($con, $add_movie_query);
            
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssssssssdsssssssi", $title, $slug, $tags, $release_year, $description, $actor, $director, $subtitle, $duration, $score, $image_filename, $wallpaper_filename, $video, $trailer, $status_id, $popularity_id, $content_type_id);
    
            $add_movie_succeed = mysqli_stmt_execute($stmt);
    
            if ($add_movie_succeed) {
                $content_id = mysqli_insert_id($con);
    
                // Use prepared statements for these queries as well
                $genre_insert_query = "INSERT INTO movie_genre (content_id, genre_id) VALUES (?, ?)";
                $country_insert_query = "INSERT INTO movie_country (content_id, country_id) VALUES (?, ?)";
                $quality_insert_query = "INSERT INTO content_quality (content_id, quality_id) VALUES (?, ?)";
    
                $stmt_genre = mysqli_prepare($con, $genre_insert_query);
                $stmt_country = mysqli_prepare($con, $country_insert_query);
                $stmt_quality = mysqli_prepare($con, $quality_insert_query);
    
                // Bind parameters for genre_insert_query
                mysqli_stmt_bind_param($stmt_genre, "ii", $content_id, $genre_id);
    
                // Bind parameters for country_insert_query
                mysqli_stmt_bind_param($stmt_country, "ii", $content_id, $country_id);
    
                // Bind parameters for quality_insert_query
                mysqli_stmt_bind_param($stmt_quality, "ii", $content_id, $quality_id);
    
                // Execute the prepared statements
                foreach ($genre_ids as $genre_id) {
                    mysqli_stmt_execute($stmt_genre);
                }
    
                foreach ($country_ids as $country_id) {
                    mysqli_stmt_execute($stmt_country);
                }
    
                foreach ($quality_ids as $quality_id) {
                    mysqli_stmt_execute($stmt_quality);
                }
    
                redirect("add-movie.php", "Movie added successfully");
            } else {
                redirect("add-movie.php", "Database error: " . mysqli_error($con));
            }
        } else {
            // Handle upload failures
            echo "Failed to upload one or both files.";
        }
    } else {
        // Handle file upload errors
        redirect("add-movie.php", "Error uploading files. Image error: $image_upload_error, Video error: $video_upload_error, Trailer error: $trailer_upload_error");
    }
}    
else if (isset($_POST['update_movie_btn'])) 
{
    $content_id = mysqli_real_escape_string($con, $_POST['content_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $tags = mysqli_real_escape_string($con, $_POST['tags']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $release_year = mysqli_real_escape_string($con, $_POST['release_year']);
    $actor = mysqli_real_escape_string($con, $_POST['actor']);
    $director = mysqli_real_escape_string($con, $_POST['director']);
    $subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $score = mysqli_real_escape_string($con, $_POST['score']);
    $video = mysqli_real_escape_string($con, $_POST['video']);
    $trailer = mysqli_real_escape_string($con, $_POST['trailer']);

    $content_type_id = mysqli_real_escape_string($con, $_POST['content_type_id']);
    $status_id = mysqli_real_escape_string($con, $_POST['status_id']);
    $popularity_id = mysqli_real_escape_string($con, $_POST['pop_id']);

    $quality_ids = isset($_POST['quality_id']) ? $_POST['quality_id'] : [];
    $genre_ids = isset($_POST['genre_id']) ? $_POST['genre_id'] : [];
    $country_ids = isset($_POST['countries_id']) ? $_POST['countries_id'] : [];

    $image = $_FILES['image'] ['name'];
    $old_image = $_POST['old_image'];
    $wallpaper = $_FILES['wallpaper'] ['name'];
    $old_wallpaper = $_POST['old_wallpaper'];

    //images
    if (!empty($image)) {
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $image_filename = time() . '.' . $image_ext;
        $image_upload_path = "../uploads/movies_poster/" . $image_filename;

        $image_upload_error = $_FILES['image']['error'];

        if ($image_upload_error === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_upload_path)) {
                $update_image_query = "UPDATE content SET img = '$image_filename' WHERE id = $content_id";
                $update_image_query_success = mysqli_query($con, $update_image_query);

                if ($update_image_query_success && $image != $old_image) {
                    if (file_exists("../uploads/movies_poster/" . $old_image)) {
                        unlink("../uploads/movies_poster/" . $old_image);
                    }
                }
            } else {
                redirect("edit-movie.php?id=$content_id", "Failed to upload the new image.");
            }
        } else {
            redirect("edit-movie.php?id=$content_id", "Error uploading the new image. Error code: $image_upload_error");
        }
    }
    //wallaper
    if (!empty($wallpaper)) {
        $wallpaper_ext = pathinfo($wallpaper, PATHINFO_EXTENSION);
        $wallpaper_filename = time() . '.' . $wallpaper_ext;
        $wallpaper_upload_path = "../uploads/wallpaper/" . $wallpaper_filename;

        $wallpaper_upload_error = $_FILES['wallpaper']['error'];

        if ($wallpaper_upload_error === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['wallpaper']['tmp_name'], $wallpaper_upload_path)) {
                $update_wallpaper_query = "UPDATE content SET wallpaper = '$wallpaper_filename' WHERE id = $content_id";
                $update_wallpaper_query_success = mysqli_query($con, $update_wallpaper_query);

                if ($update_wallpaper_query_success && $wallpaper != $old_wallpaper) {
                    if (file_exists("../uploads/wallpaper/" . $old_wallpaper)) {
                        unlink("../uploads/wallpaper/" . $old_wallpaper);
                    }
                }
            } else {
                redirect("edit-movie.php?id=$content_id", "Failed to upload the new wallpaper.");
            }
        } else {
            redirect("edit-movie.php?id=$content_id", "Error uploading the new wallpaper. Error code: $wallpaper_upload_error");
        }
    }

    $update_movie_query = "UPDATE content SET title = ?, slug = ?, tags = ?, release_year = ?, description = ?, actor = ?, director = ?, subtitle = ?, duration = ?, score = ?, status_id = ?, popularity_id = ?, content_type_id = ? WHERE id = ?";
    $stmt_update_movie = mysqli_prepare($con, $update_movie_query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt_update_movie, "sssssssssdsssi", $title, $slug, $tags, $release_year, $description, $actor, $director, $subtitle, $duration, $score, $status_id, $popularity_id, $content_type_id, $content_id);

    // Execute the prepared statement
    $update_movie_succeed = mysqli_stmt_execute($stmt_update_movie);

    if ($update_movie_succeed) {
        // Update genres
        $deleteGenresQuery = "DELETE FROM movie_genre WHERE content_id = ?";
        $stmt_delete_genres = mysqli_prepare($con, $deleteGenresQuery);
        mysqli_stmt_bind_param($stmt_delete_genres, "i", $content_id);
        mysqli_stmt_execute($stmt_delete_genres);

        // Insert new genres
        $insertGenreQuery = "INSERT INTO movie_genre (content_id, genre_id) VALUES (?, ?)";
        $stmt_insert_genre = mysqli_prepare($con, $insertGenreQuery);
        mysqli_stmt_bind_param($stmt_insert_genre, "ii", $content_id, $genre_id);

        foreach ($genre_ids as $genre_id) {
            mysqli_stmt_execute($stmt_insert_genre);
        }

        // Update countries
        $deleteCountriesQuery = "DELETE FROM movie_country WHERE content_id = ?";
        $stmt_delete_countries = mysqli_prepare($con, $deleteCountriesQuery);
        mysqli_stmt_bind_param($stmt_delete_countries, "i", $content_id);
        mysqli_stmt_execute($stmt_delete_countries);

        // Insert new countries
        $insertCountryQuery = "INSERT INTO movie_country (content_id, country_id) VALUES (?, ?)";
        $stmt_insert_country = mysqli_prepare($con, $insertCountryQuery);
        mysqli_stmt_bind_param($stmt_insert_country, "ii", $content_id, $country_id);

        foreach ($country_ids as $country_id) {
            mysqli_stmt_execute($stmt_insert_country);
        }

        // Update qualities
        $deleteQualitiesQuery = "DELETE FROM content_quality WHERE content_id = ?";
        $stmt_delete_qualities = mysqli_prepare($con, $deleteQualitiesQuery);
        mysqli_stmt_bind_param($stmt_delete_qualities, "i", $content_id);
        mysqli_stmt_execute($stmt_delete_qualities);

        // Insert new qualities
        $insertQualityQuery = "INSERT INTO content_quality (content_id, quality_id) VALUES (?, ?)";
        $stmt_insert_quality = mysqli_prepare($con, $insertQualityQuery);
        mysqli_stmt_bind_param($stmt_insert_quality, "ii", $content_id, $quality_id);

        foreach ($quality_ids as $quality_id) {
            mysqli_stmt_execute($stmt_insert_quality);
        }
        //check video existance 
        if (!empty($video)) {
            $update_video_query = "UPDATE content SET video_url = ? WHERE id = ?";
            $stmt_update_video = mysqli_prepare($con, $update_video_query);
            mysqli_stmt_bind_param($stmt_update_video, "si", $video, $content_id);
            mysqli_stmt_execute($stmt_update_video);
        }
        //check trailer existance
        if (!empty($trailer)) {
            $update_trailer_query = "UPDATE content SET trailer_url = ? WHERE id = ?";
            $stmt_update_trailer = mysqli_prepare($con, $update_trailer_query);
            mysqli_stmt_bind_param($stmt_update_trailer, "si", $trailer, $content_id);
            mysqli_stmt_execute($stmt_update_trailer);
        }
        
        redirect("edit-movie.php?id=$content_id", "Movie updated successfully");
    } else {
        // Database error during movie update
        redirect("edit-movie.php?id=$content_id", "Database error: " . mysqli_error($con));
    }
}
else if (isset($_POST['delete_movie_btn'])) {
    // Sanitize input
    $content_id = mysqli_real_escape_string($con, $_POST['content_id']);

    // Get movie data
    $movie_query = "SELECT img, wallpaper FROM content WHERE id = '$content_id'";
    $movie_query_run = mysqli_query($con, $movie_query);
    $movie_data = mysqli_fetch_assoc($movie_query_run);

    if ($movie_data) {
        // Extract data
        $image = $movie_data['img'];
        $wallpaper = $movie_data['wallpaper'];

        // Delete movie from the content table
        $delete_movie_query = "DELETE FROM content WHERE id = '$content_id'";
        $delete_movie_query_run = mysqli_query($con, $delete_movie_query);

        if ($delete_movie_query_run) {
            // File cleanup
             // If the movie was deleted successfully, proceed with cleaning up associated data
                if (file_exists("../uploads/movies_poster/" . $image)) 
                {
                    unlink("../uploads/movies_poster/" . $image);
                }
                if (file_exists("../uploads/wallpaper/" . $wallpaper)) 
                {
                    unlink("../uploads/wallpaper/" . $wallpaper);
                }

            // Remove associations from tables
            $tables_to_cleanup = ['movie_genre', 'movie_country', 'content_quality'];

            foreach ($tables_to_cleanup as $table) {
                $cleanup_query = "DELETE FROM $table WHERE content_id = $content_id";
                mysqli_query($con, $cleanup_query);
            }

            // Response code
            echo 200; // Movie deleted successfully
        } else {
            echo 500; // Error deleting the movie
        }
    } else {
        echo 404; // Movie not found
    }
}
else if (isset($_POST['add_serie_btn'])) 
{
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $tags = mysqli_real_escape_string($con, $_POST['tags']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $release_year = mysqli_real_escape_string($con, $_POST['release_year']);
    $actor = mysqli_real_escape_string($con, $_POST['actor']);
    $creator = mysqli_real_escape_string($con, $_POST['creator']);
    $subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
    $score = mysqli_real_escape_string($con, $_POST['score']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $trailer = mysqli_real_escape_string($con, $_POST['trailer']);
    
    $content_type_id = mysqli_real_escape_string($con, $_POST['content_type_id']);
    $status_id = mysqli_real_escape_string($con, $_POST['status_id']);
    $popularity_id = mysqli_real_escape_string($con, $_POST['pop_id']);
    
    $quality_ids = isset($_POST['quality_id']) ? $_POST['quality_id'] : [];
    $genre_ids = isset($_POST['genre_id']) ? $_POST['genre_id'] : [];
    $country_ids = isset($_POST['countries_id']) ? $_POST['countries_id'] : [];
    
    $image = $_FILES['image'];
    $image_ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $image_filename = time() . '.' . $image_ext;
    $image_upload_path = "../uploads/serie_poster/" . $image_filename;
    
    $wallpaper = $_FILES['wallpaper'];
    $wallpaper_ext = pathinfo($wallpaper['name'], PATHINFO_EXTENSION);
    $wallpaper_filename = time() . '.' . $wallpaper_ext;
    $wallpaper_upload_path = "../uploads/serie_wallpaper/" . $wallpaper_filename;
    
    $image_upload_error = $image['error'];
    $wallpaper_upload_error = $wallpaper['error'];
    
    if ($image_upload_error === UPLOAD_ERR_OK && $wallpaper_upload_error === UPLOAD_ERR_OK) {
        // Move the uploaded files to their respective paths
        $image_upload_success = move_uploaded_file($image['tmp_name'], $image_upload_path);
        $wallpaper_upload_success = move_uploaded_file($wallpaper['tmp_name'], $wallpaper_upload_path);
    
        if ($image_upload_success && $wallpaper_upload_success) {
            // Use prepared statements to prevent SQL injection
            $add_serie_query = "INSERT INTO series (title, slug, tags, release_year, description, actor, creator, subtitle, score, img, wallpaper, duration_per_ep, status_id, trailer_url, popularity_id, content_type_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($con, $add_serie_query);
            
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssssssssdssissii", $title, $slug, $tags, $release_year, $description, $actor, $creator, $subtitle, $score, $image_filename, $wallpaper_filename, $duration, $status_id, $trailer, $popularity_id, $content_type_id);
    
            $add_serie_succeed = mysqli_stmt_execute($stmt);
    
            if ($add_serie_succeed) {
                $series_id = mysqli_insert_id($con);
    
                // Use prepared statements for these queries as well
                $genre_insert_query = "INSERT INTO serie_genre (series_id, genre_id) VALUES (?, ?)";
                $country_insert_query = "INSERT INTO serie_country (series_id, country_id) VALUES (?, ?)";
                $quality_insert_query = "INSERT INTO serie_quality (series_id, quality_id) VALUES (?, ?)";
    
                $stmt_genre = mysqli_prepare($con, $genre_insert_query);
                $stmt_country = mysqli_prepare($con, $country_insert_query);
                $stmt_quality = mysqli_prepare($con, $quality_insert_query);
    
                // Bind parameters for genre_insert_query
                mysqli_stmt_bind_param($stmt_genre, "ii", $series_id, $genre_id);
    
                // Bind parameters for country_insert_query
                mysqli_stmt_bind_param($stmt_country, "ii", $series_id, $country_id);
    
                // Bind parameters for quality_insert_query
                mysqli_stmt_bind_param($stmt_quality, "ii", $series_id, $quality_id);
    
                // Execute the prepared statements
                foreach ($genre_ids as $genre_id) {
                    mysqli_stmt_execute($stmt_genre);
                }
    
                foreach ($country_ids as $country_id) {
                    mysqli_stmt_execute($stmt_country);
                }
    
                foreach ($quality_ids as $quality_id) {
                    mysqli_stmt_execute($stmt_quality);
                }
    
                redirect("add-series.php", "Series added successfully");
            } else {
                redirect("add-series.php", "Database error: " . mysqli_error($con));
            }
        } else {
            // Handle upload failures
            echo "Failed to upload one or both files.";
        }
    } else {
        // Handle file upload errors
        redirect("add-series.php", "Error uploading files. Image error: $image_upload_error, Wallpaper error: $wallpaper_upload_error");
    }
    
}
else if (isset($_POST['update_serie_btn'])) 
{
    $series_id = mysqli_real_escape_string($con, $_POST['serie_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $tags = mysqli_real_escape_string($con, $_POST['tags']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $release_year = mysqli_real_escape_string($con, $_POST['release_year']);
    $actor = mysqli_real_escape_string($con, $_POST['actor']);
    $creator = mysqli_real_escape_string($con, $_POST['creator']);
    $subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
    $score = mysqli_real_escape_string($con, $_POST['score']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $trailer = mysqli_real_escape_string($con, $_POST['trailer']);

    $content_type_id = mysqli_real_escape_string($con, $_POST['content_type_id']);
    $status_id = mysqli_real_escape_string($con, $_POST['status_id']);
    $popularity_id = mysqli_real_escape_string($con, $_POST['pop_id']);

    $quality_ids = isset($_POST['quality_id']) ? $_POST['quality_id'] : [];
    $genre_ids = isset($_POST['genre_id']) ? $_POST['genre_id'] : [];
    $country_ids = isset($_POST['countries_id']) ? $_POST['countries_id'] : [];

    $image = $_FILES['image'] ['name'];
    $old_image = $_POST['old_image'];
    $wallpaper = $_FILES['wallpaper'] ['name'];
    $old_wallpaper = $_POST['old_wallpaper'];
    //images
    if (!empty($image)) {
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $image_filename = time() . '.' . $image_ext;
        $image_upload_path = "../uploads/serie_poster/" . $image_filename;

        $image_upload_error = $_FILES['image']['error'];

        if ($image_upload_error === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_upload_path)) {
                $update_image_query = "UPDATE series SET img = '$image_filename' WHERE id = $series_id";
                $update_image_query_success = mysqli_query($con, $update_image_query);

                if ($update_image_query_success && $image != $old_image) {
                    if (file_exists("../uploads/serie_poster/" . $old_image)) {
                        unlink("../uploads/serie_poster/" . $old_image);
                    }
                }
            } else {
                redirect("edit-serie.php?id=$series_id", "Failed to upload the new image.");
            }
        } else {
            redirect("edit-serie.php?id=$series_id", "Error uploading the new image. Error code: $image_upload_error");
        }
    }
    //wallaper
    if (!empty($wallpaper)) {
        $wallpaper_ext = pathinfo($wallpaper, PATHINFO_EXTENSION);
        $wallpaper_filename = time() . '.' . $wallpaper_ext;
        $wallpaper_upload_path = "../uploads/serie_wallpaper/" . $wallpaper_filename;

        $wallpaper_upload_error = $_FILES['wallpaper']['error'];

        if ($wallpaper_upload_error === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['wallpaper']['tmp_name'], $wallpaper_upload_path)) {
                $update_wallpaper_query = "UPDATE series SET wallpaper = '$wallpaper_filename' WHERE id = $series_id";
                $update_wallpaper_query_success = mysqli_query($con, $update_wallpaper_query);

                if ($update_wallpaper_query_success && $wallpaper != $old_wallpaper) {
                    if (file_exists("../uploads/serie_wallpaper/" . $old_wallpaper)) {
                        unlink("../uploads/serie_wallpaper/" . $old_wallpaper);
                    }
                }
            } else {
                redirect("edit-serie.php?id=$series_id", "Failed to upload the new wallpaper.");
            }
        } else {
            redirect("edit-serie.php?id=$series_id", "Error uploading the new wallpaper. Error code: $wallpaper_upload_error");
        }
    }
    mysqli_begin_transaction($con);

    // Update the main series information
    $update_serie_query = "UPDATE series SET title = ?, slug = ?, tags = ?, release_year = ?, description = ?, actor = ?, creator = ?, subtitle = ?, score = ?, duration_per_ep =?, status_id = ?, popularity_id = ?, content_type_id = ? WHERE id = ?";
    
    $stmtUpdateSeries = mysqli_prepare($con, $update_serie_query);
    mysqli_stmt_bind_param($stmtUpdateSeries, "ssssssssdssssi", $title, $slug, $tags, $release_year, $description, $actor, $creator, $subtitle, $score, $duration, $status_id, $popularity_id, $content_type_id, $series_id);

    $update_serie_succeed = mysqli_stmt_execute($stmtUpdateSeries);

    if ($update_serie_succeed) {
        // Delete and insert genres
        $deleteGenresQuery = "DELETE FROM serie_genre WHERE series_id = ?";
        $stmtDeleteGenres = mysqli_prepare($con, $deleteGenresQuery);
        mysqli_stmt_bind_param($stmtDeleteGenres, "i", $series_id);
        mysqli_stmt_execute($stmtDeleteGenres);

        $insertGenreQuery = "INSERT INTO serie_genre (series_id, genre_id) VALUES (?, ?)";
        $stmtInsertGenre = mysqli_prepare($con, $insertGenreQuery);
        mysqli_stmt_bind_param($stmtInsertGenre, "ii", $series_id, $genre_id);

        foreach ($genre_ids as $genre_id) {
            mysqli_stmt_execute($stmtInsertGenre);
        }

        // Delete and insert countries
        $deleteCountriesQuery = "DELETE FROM serie_country WHERE series_id = ?";
        $stmtDeleteCountries = mysqli_prepare($con, $deleteCountriesQuery);
        mysqli_stmt_bind_param($stmtDeleteCountries, "i", $series_id);
        mysqli_stmt_execute($stmtDeleteCountries);

        $insertCountryQuery = "INSERT INTO serie_country (series_id, country_id) VALUES (?, ?)";
        $stmtInsertCountry = mysqli_prepare($con, $insertCountryQuery);
        mysqli_stmt_bind_param($stmtInsertCountry, "ii", $series_id, $country_id);

        foreach ($country_ids as $country_id) {
            mysqli_stmt_execute($stmtInsertCountry);
        }

        // Delete and insert qualities
        $deleteQualitiesQuery = "DELETE FROM serie_quality WHERE series_id = ?";
        $stmtDeleteQualities = mysqli_prepare($con, $deleteQualitiesQuery);
        mysqli_stmt_bind_param($stmtDeleteQualities, "i", $series_id);
        mysqli_stmt_execute($stmtDeleteQualities);

        $insertQualityQuery = "INSERT INTO serie_quality (series_id, quality_id) VALUES (?, ?)";
        $stmtInsertQuality = mysqli_prepare($con, $insertQualityQuery);
        mysqli_stmt_bind_param($stmtInsertQuality, "ii", $series_id, $quality_id);

        foreach ($quality_ids as $quality_id) {
            mysqli_stmt_execute($stmtInsertQuality);
        }
        //check trailer exists
        if (!empty($trailer)) {
            $update_trailer_query = "UPDATE content SET trailer_url = ? WHERE id = ?";
            $stmt_update_trailer = mysqli_prepare($con, $update_trailer_query);
            mysqli_stmt_bind_param($stmt_update_trailer, "si", $trailer, $content_id);
            mysqli_stmt_execute($stmt_update_trailer);
        }
        // Commit the transaction
        mysqli_commit($con);

        redirect("edit-serie.php?id=$series_id", "Serie updated successfully");
    } else {
        // Rollback the transaction on failure
        mysqli_rollback($con);

        redirect("edit-serie.php?id=$series_id", "Database error: " . mysqli_error($con));
    }
}
else if (isset($_POST['delete_serie_btn'])) {
    // Sanitize input
    $serie_id = mysqli_real_escape_string($con, $_POST['series_id']);

    // Get serie data
    $serie_query = "SELECT img, wallpaper FROM series WHERE id = '$serie_id'";
    $serie_query_run = mysqli_query($con, $serie_query);
    $serie_data = mysqli_fetch_assoc($serie_query_run);

    if ($serie_data) {
        // Extract data
        $image = $serie_data['img'];
        $wallpaper = $serie_data['wallpaper'];

        // Delete serie from the content table
        $delete_serie_query = "DELETE FROM series WHERE id = '$serie_id'";
        $delete_serie_query_run = mysqli_query($con, $delete_serie_query);

        if ($delete_serie_query_run) {
            // If the serie was deleted successfully, proceed with cleaning up associated data
            if (file_exists("../uploads/serie_poster/" . $image)) {
                unlink("../uploads/serie_poster/" . $image);
            }

            if (file_exists("../uploads/serie_wallpaper/" . $wallpaper)) {
                unlink("../uploads/serie_wallpaper/" . $wallpaper);
            }

            // Remove associations from tables
            $tables_to_cleanup = ['serie_genre', 'serie_country', 'serie_quality'];

            foreach ($tables_to_cleanup as $table) {
                $cleanup_query = "DELETE FROM $table WHERE series_id = $serie_id";
                mysqli_query($con, $cleanup_query);
            }

            // Response code
            echo 200; // Serie deleted successfully
        } else {
            echo 500; // Error deleting the serie
        }
    } else {
        echo 404; // Serie not found
    }
}
else if (isset($_POST['add_season_btn']))
{
    $series_id = mysqli_real_escape_string($con, $_POST['series_id']);
    $season_number = mysqli_real_escape_string($con, $_POST['season']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $release_year = mysqli_real_escape_string($con, $_POST['release_year']);
    $score = mysqli_real_escape_string($con, $_POST['score']);
    $season_eps = mysqli_real_escape_string($con, $_POST['season_episode']);
    $status_id = mysqli_real_escape_string($con, $_POST['status_id']);

    $image = $_FILES['image'];
    $image_ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $image_filename = time() . '.' . $image_ext;
    $image_upload_path = "../uploads/serie_poster/seasons_poster/" . $image_filename;

    $wallpaper = $_FILES['wallpaper'];
    $wallpaper_ext = pathinfo($wallpaper['name'], PATHINFO_EXTENSION);
    $wallpaper_filename = time() . '.' . $wallpaper_ext;
    $wallpaper_upload_path = "../uploads/serie_wallpaper/seasons_wallpaper/" . $wallpaper_filename;

    $image_upload_error = $image['error'];
    $wallpaper_upload_error = $wallpaper['error'];

    if ($image_upload_error === UPLOAD_ERR_OK && $wallpaper_upload_error === UPLOAD_ERR_OK) 
    {
        // Move the uploaded files to their respective paths
        $image_upload_success = move_uploaded_file($image['tmp_name'], $image_upload_path);
        $wallpaper_upload_success = move_uploaded_file($wallpaper['tmp_name'], $wallpaper_upload_path);

        if ($image_upload_success && $wallpaper_upload_success) 
        {
            // Use prepared statements to prevent SQL injection
            $add_season_query = "INSERT INTO season (series_id, season_number, season_slug, season_eps, season_release_year, season_description, season_img, season_wallpaper, season_score, season_status_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($con, $add_season_query);
            
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "iissssssdi", $series_id, $season_number, $slug, $season_eps, $release_year, $description, $image_filename, $wallpaper_filename, $score, $status_id);
            
            $add_season_succeed = mysqli_stmt_execute($stmt);

            if ($add_season_succeed) 
            {
                $season_id = mysqli_insert_id($con);

                redirect("seasons.php?id=$series_id", "Season Added Successfully");
            } else {
                redirect("add-season.php", "Database error: " . mysqli_error($con));
            }
        } else {
            // Handle upload failures
            echo "Failed to upload one or both files.";
        }
    } else {
        // Handle file upload errors
        redirect("add-season.php", "Error uploading files. Image error: $image_upload_error, Wallpaper error: $wallpaper_upload_error");
    }
}
else if (isset($_POST['update_season_btn']))
{
    $season_id = mysqli_real_escape_string($con, $_POST['season_id']);
    $series_id = mysqli_real_escape_string($con, $_POST['series_id']);
    $season_number = mysqli_real_escape_string($con, $_POST['season']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $release_year = mysqli_real_escape_string($con, $_POST['release_year']);
    $score = mysqli_real_escape_string($con, $_POST['score']);
    $season_eps = mysqli_real_escape_string($con, $_POST['season_episode']);
    $status_id = mysqli_real_escape_string($con, $_POST['status_id']);


    $image = $_FILES['image'] ['name'];
    $old_image = $_POST['old_image'];
    $wallpaper = $_FILES['wallpaper'] ['name'];
    $old_wallpaper = $_POST['old_wallpaper'];

    if (!empty($image)) {
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $image_filename = time() . '.' . $image_ext;
        $image_upload_path = "../uploads/serie_poster/seasons_poster/" . $image_filename;

        $image_upload_error = $_FILES['image']['error'];

        if ($image_upload_error === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_upload_path)) {
                $update_image_query = "UPDATE season SET season_img = '$image_filename' WHERE season_id = $season_id";
                $update_image_query_success = mysqli_query($con, $update_image_query);

                if ($update_image_query_success && $image != $old_image) {
                    if (file_exists("../uploads/serie_poster/seasons_poster/" . $old_image)) {
                        unlink("../uploads/serie_poster/seasons_poster/" . $old_image);
                    }
                }
            } else {
                redirect("edit-season.php?season_id=$season_id", "Failed to upload the new image.");
            }
        } else {
            redirect("edit-season.php?season_id=$season_id", "Error uploading the new image. Error code: $image_upload_error");
        }
    }
    //wallaper
    if (!empty($wallpaper)) {
        $wallpaper_ext = pathinfo($wallpaper, PATHINFO_EXTENSION);
        $wallpaper_filename = time() . '.' . $wallpaper_ext;
        $wallpaper_upload_path = "../uploads/serie_wallpaper/seasons_wallpaper/" . $wallpaper_filename;

        $wallpaper_upload_error = $_FILES['wallpaper']['error'];

        if ($wallpaper_upload_error === UPLOAD_ERR_OK) 
        {
            if (move_uploaded_file($_FILES['wallpaper']['tmp_name'], $wallpaper_upload_path)) 
            {
                $update_wallpaper_query = "UPDATE season SET season_wallpaper = '$wallpaper_filename' WHERE season_id = $season_id";
                $update_wallpaper_query_success = mysqli_query($con, $update_wallpaper_query);

                if ($update_wallpaper_query_success && $wallpaper != $old_wallpaper) {
                    if (file_exists("../uploads/serie_wallpaper/seasons_wallpaper/" . $old_wallpaper)) {
                        unlink("../uploads/serie_wallpaper/seasons_wallpaper/" . $old_wallpaper);
                    }
                }
            } else {
                redirect("edit-season.php?season_id=$season_id", "Failed to upload the new wallpaper.");
            }
        } else {
            redirect("edit-season.php?season_id=$season_id", "Error uploading the new wallpaper. Error code: $wallpaper_upload_error");
        }
    }
    // Update the main series information
    $update_season_query = "UPDATE season SET series_id = ?, season_number = ?, season_eps=?, season_slug = ?, season_release_year = ?, season_description = ?, season_score = ?, season_status_id = ? WHERE season_id = ?";

    $stmtUpdateSeason = mysqli_prepare($con, $update_season_query);
    mysqli_stmt_bind_param($stmtUpdateSeason, "iiisssdii", $series_id, $season_number, $season_eps, $slug, $release_year, $description, $score, $status_id, $season_id);

    $update_season_succeed = mysqli_stmt_execute($stmtUpdateSeason);

    if ($update_season_succeed) 
    {
        redirect("seasons.php?id=$series_id", "Season Updated successfully");
    } else 
    {
        redirect("edit-season.php?season_id=$season_id", "Database error: " . mysqli_error($con));
    }
}
else if (isset($_POST['delete_season_btn'])) {
    // Sanitize input
    $season_id = mysqli_real_escape_string($con, $_POST['season_id']);

    // Get serie data
    $season_query = "SELECT season_img, season_wallpaper FROM season WHERE season_id = '$season_id'";
    $season_query_run = mysqli_query($con, $season_query);
    $season_data = mysqli_fetch_assoc($season_query_run);

    if ($season_data) {
        // Extract data
        $image = $season_data['season_img'];
        $wallpaper = $season_data['season_wallpaper'];

        // Delete season from the content table
        $delete_season_query = "DELETE FROM season WHERE season_id = '$season_id'";
        $delete_season_query_run = mysqli_query($con, $delete_season_query);

        if ($delete_season_query_run) {
            if (file_exists("../uploads/serie_poster/seasons_poster/" . $image)) {
                unlink("../uploads/serie_poster/seasons_poster/" . $image);
            }

            if (file_exists("../uploads/serie_wallpaper/seasons_wallpaper/" . $wallpaper)) {
                unlink("../uploads/serie_wallpaper/seasons_wallpaper/" . $wallpaper);
            }

            echo 200; 
        } else {
            echo 500; 
        }
    } else {
        echo 404; 
    }
}
else if (isset($_POST['add_episode_btn'])) 
{
    error_log('Form submitted successfully.'); 
    $season_id = $_POST['season_id'];
    $seriesId = $_POST['series_id'];
    $episodeNumbers = $_POST['episode_number'];
    $episodeNames = $_POST['name'];
    $episodeSlugs = $_POST['slug'];
    $videoUrls = $_POST['video_url'];

    foreach ($episodeNumbers as $key => $episodeNumber) {
        $episodeName = $episodeNames[$key];
        $episodeSlug = $episodeSlugs[$key];
        $videoUrl = $videoUrls[$key];

        $addEpisodeQuery = "INSERT INTO episode (season_id, series_id, episode_number, ep_name, ep_slug, ep_url) 
                            VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($con, $addEpisodeQuery);

        mysqli_stmt_bind_param($stmt, "iissss", $season_id, $seriesId, $episodeNumber, $episodeName, $episodeSlug, $videoUrl);

        $addEpisodeSuccess = mysqli_stmt_execute($stmt);

        if (!$addEpisodeSuccess) {
            $errorMessage = mysqli_error($con);
            redirect("add-episode.php?season_id=$season_id", "Database error: $errorMessage");
        }
    }
    redirect("episode.php?season_id=$season_id", "Season updated successfully");
} 
else if (isset($_POST['update_episode_btn'])) {
    $episodeId = mysqli_real_escape_string($con, $_POST['episode_id']);
    $serieId = mysqli_real_escape_string($con, $_POST['series_id']);
    $seasonId = mysqli_real_escape_string($con, $_POST['season_id']);
    $episodeNumber = mysqli_real_escape_string($con, $_POST['episode_number']);
    $episodeName = mysqli_real_escape_string($con, $_POST['episode_name']);
    $episodeSlug = mysqli_real_escape_string($con, $_POST['episode_slug']);
    $videoUrl = mysqli_real_escape_string($con, $_POST['ep_url']);

    // Use prepared statements to prevent SQL injection
    $update_episode_query = "UPDATE episode SET series_id = ?, season_id = ?, episode_number = ?, ep_name = ?, ep_slug = ? WHERE episode_id = ?";
    
    $update_episode_stmt = mysqli_prepare($con, $update_episode_query);
    mysqli_stmt_bind_param($update_episode_stmt, "iisssi", $serieId, $seasonId, $episodeNumber, $episodeName, $episodeSlug, $episodeId);
    
    $update_episode_succeed = mysqli_stmt_execute($update_episode_stmt);

    if (!$update_episode_succeed) {
        $errorMessage = mysqli_error($con);
        redirect("edit-episode.php?episode_id=$episodeid", "Database error: $errorMessage");
    } else {
        if (!empty($videoUrl)) {
            $update_ep_query = "UPDATE episode SET ep_url = ? WHERE episode_id = ?";
            $stmt_update_ep = mysqli_prepare($con, $update_ep_query);
            mysqli_stmt_bind_param($stmt_update_ep, "si", $videoUrl, $episodeId);
            mysqli_stmt_execute($stmt_update_ep);
        }
        // Commit the transaction
        mysqli_commit($con);

        redirect("episode.php?season_id=$seasonId", "Episode Updated successfully");
    } 
}
else if (isset($_POST['delete_episode_btn'])) {
    // Sanitize input
    $episode_id = mysqli_real_escape_string($con, $_POST['episode_id']);

    // Delete season from the content table
    $delete_episode_query = "DELETE FROM episode WHERE episode_id = '$episode_id'";
    $delete_episode_query_run = mysqli_query($con, $delete_episode_query);

    if ($delete_episode_query_run) {
        echo 200; 
    } else {
        echo 500; 
    }
    } else {
    echo 404; 
    }
?>

